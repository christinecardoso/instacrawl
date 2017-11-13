<?php

namespace DW\InstaCrawl;

use DW\InstaCrawl\Exceptions\EmptyHtml;
use DW\InstaCrawl\Exceptions\InvalidUsername;

class InstaCrawl
{
    /**
     * @param string $username
     *
     * @return int
     */
    public function getAmountOfFollowers($username)
    {
        return $this->multiArraySearch($this->getData($username), config('instacrawl.indexes.follower_count'))['count'];
    }

    /**
     * @param string $username
     *
     * @return int
     */
    public function getAmountOfFollows($username)
    {
        return $this->multiArraySearch($this->getData($username), config('instacrawl.indexes.follows_count'))['count'];
    }

    /**
     * @param string $username
     *
     * @return int
     */
    public function getAmountOfPosts($username)
    {
        return $this->multiArraySearch($this->getData($username), config('instacrawl.indexes.posts_count'))['count'];
    }

    /**
     * @param string $username
     *
     * @return string
     */
    public function getBiography($username)
    {
        return $this->multiArraySearch($this->getData($username), config('instacrawl.indexes.user'))['biography'];
    }

    /**
     * @param string $username
     *
     * @return string
     */
    public function getFullName($username)
    {
        return $this->multiArraySearch($this->getData($username), config('instacrawl.indexes.user'))['full_name'];
    }

    /**
     * @param string $username
     *
     * @return string
     */
    public function getId($username)
    {
        return $this->multiArraySearch($this->getData($username), config('instacrawl.indexes.user'))['id'];
    }

    /**
     * @param string $username
     *
     * @return string
     */
    public function getProfilePic($username)
    {
        return $this->multiArraySearch($this->getData($username), config('instacrawl.indexes.user'))['profile_pic_url'];
    }

    /**
     * @param string $url
     *
     * @return string
     */
    public function getUsernameFromUrl($url)
    {
        $username = substr($url, strpos($url, 'instagram.com/') + strlen('instagram.com/'));
        if (strpos($username, '/')) {
            $username = substr($username, 0, (strlen($username) - (strpos($username, '/'))) * -1);
        }

        return $username;
    }

    /**
     * @param string $username
     *
     * @return array
     */
    public function getRecentMedia($username)
    {
        return $this->multiArraySearch($this->getData($username), config('instacrawl.indexes.media'));
    }

    /**
     * @param string $username
     *
     * @return array
     */
    private function getData($username)
    {
        $this->validateUsername($username);
        return json_decode($this->processHtml($this->crawlUrl('https://www.instagram.com/'.$username.'/')), true);
    }

    /**
     * @param string $username
     *
     * @throws InvalidUsername
     */
    private function validateUsername($username)
    {
        if (preg_match('/[^A-Za-z0-9.\\_]/', $username)|| strlen($username) > 30) {
            throw new InvalidUsername();
        }
    }

    /**
     * @param string $url
     *
     * @return string
     */
    private function crawlUrl($url)
    {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    /**
     * @param string $html
     *
     * @return string
     * @throws EmptyHtml
     */
    private function processHtml($html)
    {
        if (strlen($html) <= 0) {
            throw new EmptyHtml();
        }

        $html = substr($html, strpos($html, config('instacrawl.start')) + strlen(config('instacrawl.start')));
        $html = substr($html, 0, strpos($html, config('instacrawl.stop')));

        return $html;
    }

    /**
     * @param array $array
     * @param int|string $item
     *
     * @return array|int|null|string
     */
    private function multiArraySearch($array, $item)
    {
        $result = null;

        foreach ($array as $key => $value) {
            if ($key === $item) {
                $result = $value;
                break;
            } elseif (is_array($value)) {
                $search = $this->multiArraySearch($value, $item);
                if ($search) {
                    $result = $search;
                    break;
                }
            }
        }

        return $result;
    }
}
