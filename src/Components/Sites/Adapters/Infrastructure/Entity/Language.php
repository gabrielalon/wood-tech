<?php

namespace Components\Sites\Adapters\Infrastructure\Entity;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model as Eloquent;
use System\Eloquent\Contracts\HasCode;
use System\Eloquent\Contracts\HasCodeTrait;

/**
 * @property string $code
 * @property string $native_name
 *
 * @method static Language|null findByCode(string $code)
 * @method static Builder active()
 */
final class Language extends Eloquent implements HasCode
{
    use HasCodeTrait;

    /** @var bool */
    public $timestamps = false;

    /** @var bool */
    public $incrementing = false;

    /** @var string */
    protected $table = 'language';

    /** @var string */
    protected $primaryKey = 'code';

    /** @var string */
    protected $keyType = 'string';

    /** @var array */
    protected $guarded = [];

    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }
}
