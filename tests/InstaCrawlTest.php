<?php

namespace DW\InstaCrawl;

use DW\InstaCrawl\AbstractTestCase;
use DW\InstaCrawl\Exceptions\InvalidUsername;
use DW\InstaCrawl\InstaCrawl;

class InstaCrawlTest extends AbstractTestCase
{
    /** @test */
    public function it_should_thrown_an_exception_when_using_invalid_characters_in_username()
    {
        $this->expectException(InvalidUsername::class);
        $ic = new InstaCrawl();
        $ic->getId('*');
    }

    /** @test */
    public function it_should_thrown_an_exception_when_using_too_many_characters_in_username()
    {
        $this->expectException(InvalidUsername::class);
        $ic = new InstaCrawl();
        $ic->getId('1234567890123456789012345678901');
    }

    /** @test */
    public function it_should_fetch_a_users_amount_of_followers()
    {
        $ic = new InstaCrawl();
        $followers = $ic->getAmountOfFollowers('xxxibgdrgn');
        $this->assertTrue($followers > 10000000);
    }

    /** @test */
    public function it_should_fetch_a_users_amount_of_follows()
    {
        $ic = new InstaCrawl();
        $followers = $ic->getAmountOfFollows('xxxibgdrgn');
        $this->assertTrue($followers == 0);
    }

    /** @test */
    public function it_should_fetch_a_users_amount_of_posts()
    {
        $ic = new InstaCrawl();
        $posts = $ic->getAmountOfPosts('xxxibgdrgn');
        $this->assertTrue($posts > 1500);
    }

    /** @test */
    public function it_should_fetch_a_users_biography()
    {
        $ic = new InstaCrawl();
        $bio = $ic->getBiography('_parkbogum');
        $fixture = 'all rights own by blossomenter';
        $this->assertEquals($bio, $fixture);
    }

    /** @test */
    public function it_should_fetch_a_users_full_name()
    {
        $ic = new InstaCrawl();
        $fullName = $ic->getFullName('xxxibgdrgn');
        $fixture = 'G-DRAGON';
        $this->assertEquals($fullName, $fixture);
    }

    /** @test */
    public function it_should_fetch_a_users_id()
    {
        $ic = new InstaCrawl();
        $id = $ic->getId('you_r_love');
        $this->assertEquals($id, 2232871341);
    }

    /** @test */
    public function it_should_fetch_a_users_profile_pic()
    {
        $ic = new InstaCrawl();
        $profilePic = $ic->getProfilePic('kbsworldtv');
        $fixture = 'https://scontent-arn2-1.cdninstagram.com/t51.2885-19/10413994_296704910499028_1814010879_a.jpg';
        $this->assertEquals($profilePic, $fixture);
    }

    /** @test */
    public function it_should_fetch_the_username_from_an_url()
    {
        $ic = new InstaCrawl();
        $username = $ic->getUsernameFromUrl('https://www.instagram.com/xxxibgdrgn/');
        $fixture = 'xxxibgdrgn';
        $this->assertEquals($username, $fixture);
    }

    /** @test */
    public function it_should_fetch_a_users_recent_media()
    {
        $ic = new InstaCrawl();
        $media = $ic->getRecentMedia('you_r_love');
        $this->assertTrue(is_array($media));
        $this->assertTrue(array_key_exists('likes', $media[0]));
    }
}
