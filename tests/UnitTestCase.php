<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class UnitTestCase extends BaseTestCase
{
    use CreatesApplication;
    use IdGenerator;
    use WithFaker;
}
