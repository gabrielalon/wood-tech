<?php declare(strict_types=1);

namespace Components\Contents\Adapters\Infrastructure\Entity;

use Components\Contents\Domain\Enum\PageTypeEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
use System\Eloquent\Contracts\HasTranslation;
use System\Eloquent\Contracts\HasTranslationTrait;
use System\Eloquent\Contracts\HasUuid;
use System\Eloquent\Contracts\HasUuidTrait;

/**
 * @property string $id
 * @property string $type
 *
 * @method static Page|null findByUuid(string $id)
 * @method static Builder byType(PageTypeEnum $type)
 */
final class Page extends Eloquent implements HasTranslation, HasUuid
{
    use HasTranslationTrait, HasUuidTrait, SoftDeletes;

    /** @var string[] */
    public $translatedAttributes = ['name', 'lead', 'description'];

    /** @var bool */
    public $incrementing = false;

    /** @var string */
    protected $table = 'page';

    /** @var string */
    protected $keyType = 'string';

    /** @var array */
    protected $guarded = [];

    public function names(): array
    {
        return $this->translationsArray('name');
    }

    public function leads(): array
    {
        return $this->translationsArray('lead');
    }

    public function descriptions(): array
    {
        return $this->translationsArray('description');
    }

    public static function findByType(PageTypeEnum $type): Model|self|null
    {
        return self::byType($type)->first();
    }

    public function scopeByType(Builder $query, PageTypeEnum $type): Builder
    {
        return $query->where('type', $type->value);
    }
}
