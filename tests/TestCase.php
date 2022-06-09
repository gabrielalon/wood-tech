<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use System\Messaging\MessageBus;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use TruncateDatabase;
    use IdGenerator;
    use WithFaker;

    protected function setUpTraits()
    {
        $uses = parent::setUpTraits();

        if (isset($uses[TruncateDatabase::class])) {
            $this->truncateDatabase();
        }

        return $uses;
    }

    protected function getMessageBus(): MessageBus
    {
        return $this->app->get(MessageBus::class);
    }
}
