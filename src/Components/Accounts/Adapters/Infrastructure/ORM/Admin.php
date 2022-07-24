<?php

namespace Components\Accounts\Adapters\Infrastructure\ORM;

use Database\Factories\AdminFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use Spatie\Image\Exceptions\InvalidManipulation;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use System\Eloquent\Contracts\HasMedia;
use System\Eloquent\Contracts\HasMediaTrait;
use System\Eloquent\Contracts\HasUuid;
use System\Eloquent\Contracts\HasUuidTrait;
use System\Spatie\Media\MediaEnum;

/**
 * @mixin Builder
 *
 * @method static Builder|static query()
 * @method static static make(array $attributes = [])
 * @method static static create(array $attributes = [])
 * @method static static forceCreate(array $attributes)
 * @method Admin firstOrNew(array $attributes = [], array $values = [])
 * @method Admin firstOrFail(array $columns = ['*'])
 * @method Admin firstOrCreate(array $attributes, array $values = [])
 * @method Admin firstOr(array $columns = ['*'], \Closure $callback = null)
 * @method Admin firstWhere(array $column, string|null $operator = null, string|null $value = null, string|null $boolean = 'and')
 * @method Admin updateOrCreate(array $attributes, array $values = [])
 * @method null|static first(array $columns = ['*'])
 * @method static static findOrFail(string $id, array $columns = ['*'])
 * @method static static findOrNew(string $id, array $columns = ['*'])
 * @method static null|static find(string $id, array $columns = ['*'])
 *
 * @property string $id
 * @property string $first_name
 * @property string $last_name
 * @property string $user_id
 * @property User   $user
 *
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read Carbon $deleted_at
 *
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

    /** @var string[] */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

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
