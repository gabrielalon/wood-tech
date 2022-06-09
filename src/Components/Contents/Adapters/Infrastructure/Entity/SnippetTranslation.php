<?php

namespace Components\Contents\Adapters\Infrastructure\Entity;

use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * @property int    $id
 * @property string $snippet_id
 * @property string $locale
 * @property string $value
 */
final class SnippetTranslation extends Eloquent
{
    /** @var bool */
    public $timestamps = false;

    /** @var string */
    protected $table = 'snippet_translation';

    /** @var array */
    protected $guarded = [];
}
