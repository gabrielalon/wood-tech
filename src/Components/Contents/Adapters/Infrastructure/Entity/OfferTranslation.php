<?php

namespace Components\Contents\Adapters\Infrastructure\Entity;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * @property int    $id
 * @property string $offer_id
 * @property string $locale
 * @property string $name
 * @property string $lead
 * @property string $description
 */
final class OfferTranslation extends Eloquent
{
    /** @var bool */
    public $timestamps = false;

    /** @var string */
    protected $table = 'offer_translation';

    /** @var array */
    protected $guarded = [];
}
