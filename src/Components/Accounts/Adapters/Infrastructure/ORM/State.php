<?php

namespace Components\Accounts\Adapters\Infrastructure\ORM;

use Illuminate\Database\Eloquent\Model as Eloquent;
use System\Eloquent\Contracts\HasTranslation;
use System\Eloquent\Contracts\HasTranslationTrait;
use System\Eloquent\Contracts\HasUuid;
use System\Eloquent\Contracts\HasUuidTrait;
use System\Enum\StateEnum;

/**
 * @property string $id
 * @property string $type
 */
final class State extends Eloquent implements HasUuid, HasTranslation
{
    use HasUuidTrait;
    use HasTranslationTrait;

    /** @var string[] */
    public array $translatedAttributes = ['name'];

    /** @var bool */
    public $timestamps = false;

    /** @var bool */
    public $incrementing = false;

    /** @var string */
    protected $table = 'state';

    /** @var string */
    protected $keyType = 'string';

    /** @var array */
    protected $guarded = [];

    public static function getOrCreateByType(StateEnum $type): State|Eloquent
    {
        return self::query()->firstOrCreate(['type' => $type->value]);
    }
}
