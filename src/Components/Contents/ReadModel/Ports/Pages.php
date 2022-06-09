<?php declare(strict_types=1);

namespace Components\Contents\ReadModel\Ports;

use Components\Contents\ReadModel\Model\Page;

interface Pages
{
    public function getPageByType(string $type): Page;

    public function getHomePage(): Page;
}
