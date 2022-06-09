<?php declare(strict_types=1);

namespace Components\Contents\Adapters\Infrastructure\Entity;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\SoftDeletes;
use System\Eloquent\Contracts\HasTranslation;
use System\Eloquent\Contracts\HasTranslationTrait;
use System\Eloquent\Contracts\HasUuid;
use System\Eloquent\Contracts\HasUuidTrait;

/**
 * @property string $id
 *
 * @method static Faq|null findByUuid(string $id)
 */
final class Faq extends Eloquent implements HasTranslation, HasUuid
{
    use HasTranslationTrait, HasUuidTrait, SoftDeletes;

    /** @var string[] */
    public $translatedAttributes = ['question', 'answer'];

    /** @var bool */
    public $incrementing = false;

    /** @var string */
    protected $table = 'faq';

    /** @var string */
    protected $keyType = 'string';

    /** @var array */
    protected $guarded = [];

    public function answers(): array
    {
        return $this->translationsArray('answer');
    }

    public function questions(): array
    {
        return $this->translationsArray('question');
    }
}
