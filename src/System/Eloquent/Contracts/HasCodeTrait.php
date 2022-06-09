<?php

namespace System\Eloquent\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait HasCodeTrait
{
    public static function findByCode(string $code): ?Model
    {
        return static::query()->byCode($code)->first();
    }

    public function scopeByCode(Builder $query, string $code): Builder
    {
        return $query->where($this->getCodeFieldName(), $code);
    }

    public function getCodeFieldName(): string
    {
        if (!empty($this->codeFieldName)) {
            return $this->codeFieldName;
        }

        return $this->getKeyName();
    }
}
