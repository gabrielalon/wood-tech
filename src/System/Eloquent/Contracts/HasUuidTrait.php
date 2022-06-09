<?php

namespace System\Eloquent\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * @method static Builder byUuid(string $uuid)
 */
trait HasUuidTrait
{
    public static function bootHasUuidTrait(): void
    {
        static::creating(function ($model) {
            $uuidFieldName = $model->getUuidFieldName();
            if (empty($model->$uuidFieldName)) {
                $model->$uuidFieldName = static::generateUuid();
            }
        });
    }

    public static function generateUuid(): string
    {
        return Str::uuid()->toString();
    }

    public static function findByUuid(string $uuid): ?Model
    {
        return static::query()->byUuid($uuid)->first();
    }

    public function scopeByUuid(Builder $query, string $uuid): Builder
    {
        return $query->where($this->getUuidFieldName(), $uuid);
    }

    public function getUuidFieldName(): string
    {
        if (!empty($this->uuidFieldName)) {
            return $this->uuidFieldName;
        }

        return $this->getKeyName();
    }
}
