<?php

namespace Components\Accounts\Adapters\Infrastructure\Entity;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use System\Eloquent\Contracts\HasTranslation;
use System\Eloquent\Contracts\HasTranslationTrait;
use System\Eloquent\Contracts\HasUuid;
use System\Eloquent\Contracts\HasUuidTrait;
use System\Enum\RoleEnum;

/**
 * @property string     $id
 * @property string     $type
 * @property string     $guard
 * @property bool       $is_active
 * @property int        $level
 * @property Collection $users
 * @property Collection $permissions
 */
final class Role extends Eloquent implements HasUuid, HasTranslation
{
    use HasUuidTrait;
    use HasTranslationTrait;

    /** @var string[] */
    public array $translatedAttributes = ['description'];

    /** @var bool */
    public $timestamps = false;

    /** @var bool */
    public $incrementing = false;

    /** @var string */
    protected $table = 'role';

    /** @var string */
    protected $keyType = 'string';

    /** @var array */
    protected $guarded = [];

    /** @var string[] */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(
            User::class,
            'user_role',
            'role_id',
            'user_id'
        );
    }

    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            Permission::class,
            'role_permission',
            'role_id',
            'permission_id'
        );
    }

    /**
     * @return string[]
     */
    public function permissionTypes(): array
    {
        return $this->permissions()
            ->where('is_active', true)
            ->pluck('type')
            ->toArray()
        ;
    }

    public function descriptions(): array
    {
        return $this->translationsArray('description');
    }

    public static function getOrCreateByType(RoleEnum $type): Role|Eloquent
    {
        return self::query()->firstOrCreate(['type' => $type->value]);
    }
}
