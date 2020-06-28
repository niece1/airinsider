<?php

namespace Tests\Feature;

use Tests\TestCase;
use Tests\Traits\DashboardAccess;

abstract class FeatureTestCase extends TestCase
{
    use DashboardAccess;
}
