<?php

namespace System\Messaging\Aggregate;

interface AggregateId
{
    public function toString(): string;
}
