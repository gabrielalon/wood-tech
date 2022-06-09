<?php

namespace Components\Sites\Adapters\Infrastructure\Entity;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * @property int    $id
 * @property string $country_code
 * @property string $locale
 * @property string $name
 */
final class CountryTranslation extends Eloquent
{
    /** @var bool */
    public $timestamps = false;

    /** @var string */
    protected $table = 'country_translation';

    /** @var array */
    protected $guarded = [];
}
