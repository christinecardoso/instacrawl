<?php

namespace DW\InstaCrawl;

class Facade extends \Illuminate\Support\Facades\Facade
{
    protected static function getFacadeAccessor()
    {
        return 'instacrawl';
    }
}
