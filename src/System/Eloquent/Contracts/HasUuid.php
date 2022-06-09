<?php

namespace System\Eloquent\Contracts;

interface HasUuid
{
    /**
     * @return string
     */
    public function getUuidFieldName(): string;
}
