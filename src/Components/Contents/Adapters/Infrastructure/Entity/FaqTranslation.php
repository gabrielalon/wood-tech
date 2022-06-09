<?php

namespace Components\Contents\Adapters\Infrastructure\Entity;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * @property int    $id
 * @property string $faq_id
 * @property string $locale
 * @property string $value
 */
final class FaqTranslation extends Eloquent
{
    /** @var bool */
    public $timestamps = false;

    /** @var string */
    protected $table = 'faq_translation';

    /** @var array */
    protected $guarded = [];
}
