<?php 

namespace DW\InstaCrawl\Exceptions;

use Exception;

class EmptyHtml extends Exception
{
    public function __construct()
    {
        parent::__construct("Empty html input, confirm that the username/url is correct.");
    }
}
