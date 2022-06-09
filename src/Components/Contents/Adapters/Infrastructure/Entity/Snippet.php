<?php declare(strict_types=1);

namespace Components\Contents\Adapters\Infrastructure\Entity;

use Components\Contents\Domain\Enum\SnippetTypeEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Model as Eloquent;
use System\Eloquent\Contracts\HasTranslation;
use System\Eloquent\Contracts\HasTranslationTrait;
use System\Eloquent\Contracts\HasUuid;
use System\Eloquent\Contracts\HasUuidTrait;

/**
 * @property string $id
 * @property string $type
 *
 * @method static Snippet|null findByUuid(string $id)
 * @method static Builder byType(SnippetTypeEnum $type)
 */
final class Snippet extends Eloquent implements HasTranslation, HasUuid
{
    use HasTranslationTrait, HasUuidTrait;

    /** @var string[] */
    public $translatedAttributes = ['value'];

    /** @var bool */
    public $incrementing = false;

    /** @var string */
    protected $table = 'snippet';

    /** @var string */
    protected $keyType = 'string';

    /** @var array */
    protected $guarded = [];

    public function values(): array
    {
        return $this->translationsArray('value');
    }

    public static function findByType(SnippetTypeEnum $type): Model|self|null
    {
        return self::byType($type)->first();
    }

    public function scopeByType(Builder $query, SnippetTypeEnum $type): Builder
    {
        return $query->where('type', $type->value);
    }
}
