<?php

namespace DW\InstaCrawl;

use GrahamCampbell\TestBench\AbstractPackageTestCase;

class AbstractTestCase extends AbstractPackageTestCase
{
    protected function getServiceProviderClass($app)
    {
        return ServiceProvider::class;
    }
}