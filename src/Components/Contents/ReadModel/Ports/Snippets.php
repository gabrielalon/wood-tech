<?php declare(strict_types=1);

namespace Components\Contents\ReadModel\Ports;

use Components\Contents\ReadModel\Model\Snippet;

interface Snippets
{
    public function getSnippetByType(string $type): Snippet;
}
