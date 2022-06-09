<?php

namespace Components\Accounts\Adapters\Infrastructure\Entity;

use Database\Factories\AdminFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use System\Eloquent\Contracts\HasMedia;
use System\Eloquent\Contracts\HasMediaTrait;
use System\Eloquent\Contracts\HasUuid;
use System\Eloquent\Contracts\HasUuidTrait;
use System\Spatie\Media\MediaEnum;

/**
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property string $user_id
 * @property User   $user
 *
 * @method Admin|Builder newQuery()
 * @method static Admin|null findByUuid(string $uuid)
 */
final class Admin extends Eloquent implements HasUuid, HasMedia
{
    use HasFactory;
    use HasUuidTrait;
    use HasMediaTrait;
    use SoftDeletes;

    /** @var bool */
    public $incrementing = false;

    /** @var string */
    protected $table = 'admin';

    /** @var string */
    protected $keyType = 'string';

    /** @var array */
    protected $guarded = [];

    /**
     * {@inheritdoc}
     */
    protected static function newFactory(): AdminFactory
    {
        return AdminFactory::new();
    }

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(
            User::class,
            'id',
            'user_id'
        );
    }

    /**
     * @param Media|null $media
     *
     * @throws InvalidManipulation
     */
    public function registerMediaConversions(Media $media = null): void
    {
        /* @phpstan-ignore-next-line */
        $this
            ->addMediaConversion(MediaEnum::AVATAR->value)
            ->quality(80)
            ->withResponsiveImages()
        ;
    }
}
