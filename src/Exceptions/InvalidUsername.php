<?php 

namespace DW\InstaCrawl\Exceptions;

use Exception;

class InvalidUsername extends Exception
{
    public function __construct()
    {
        parent::__construct('Invalid username. A username may only contain letters, numbers, periods and underscores. Max length 30.');
    }
}
