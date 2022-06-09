<?php

namespace Components\Sites\ReadModel\Ports;

use Components\Sites\ReadModel\Model\Language;

interface Languages
{
    /**
     * @return array<Language>
     */
    public function getActiveLanguages(): array;
}
