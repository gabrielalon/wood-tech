<?php

namespace Components\Contents\Adapters\Infrastructure\Entity;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * @property int    $id
 * @property string $page_id
 * @property string $locale
 * @property string $name
 * @property string $lead
 * @property string $description
 */
final class PageTranslation extends Eloquent
{
    /** @var bool */
    public $timestamps = false;

    /** @var string */
    protected $table = 'page_translation';

    /** @var array */
    protected $guarded = [];
}
