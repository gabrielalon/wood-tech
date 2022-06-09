<?php

namespace Components\Sites\ReadModel\Model;

final class Language
{
    public function __construct(
        public readonly string $code,
        public readonly string $nativeName,
    ) {
    }
}
