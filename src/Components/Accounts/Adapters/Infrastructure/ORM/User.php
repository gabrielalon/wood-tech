<?php

namespace Components\Accounts\Adapters\Infrastructure\ORM;

use Database\Factories\UserFactory;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;
use System\Eloquent\Contracts\HasUuid;
use System\Eloquent\Contracts\HasUuidTrait;
use System\Enum\RoleEnum;
use System\Enum\StateEnum;
use function locale;

/**
 * @mixin Builder
 *
 * @method static Builder|static query()
 * @method static static make(array $attributes = [])
 * @method static static create(array $attributes = [])
 * @method static static forceCreate(array $attributes)
 * @method User firstOrNew(array $attributes = [], array $values = [])
 * @method User firstOrFail(array $columns = ['*'])
 * @method User firstOrCreate(array $attributes, array $values = [])
 * @method User firstOr(array $columns = ['*'], \Closure $callback = null)
 * @method User firstWhere(array $column, string|null $operator = null, string|null $value = null, string|null $boolean = 'and')
 * @method User updateOrCreate(array $attributes, array $values = [])
 * @method null|static first(array $columns = ['*'])
 * @method static static findOrFail(string $id, array $columns = ['*'])
 * @method static static findOrNew(string $id, array $columns = ['*'])
 * @method static null|static find(string $id, array $columns = ['*'])
 *
 * @property string      $id
 * @property State       $state
 * @property string      $state_id
 * @property string      $login
 * @property string      $password
 * @property string      $email
 * @property Carbon|null $email_verified_at
 * @property string      $phone
 * @property Carbon|null $phone_verified_at
 * @property string      $remember_token
 * @property string      $locale
 * @property Collection  $roles
 * @property Collection  $permissions
 *
 * @property-read Carbon $created_at
 * @property-read Carbon $updated_at
 * @property-read Carbon $deleted_at
 *
 * @method static User|null findByUuid(string $uuid)
 */
final class User extends Eloquent implements HasUuid
{
    use HasFactory;
    use HasUuidTrait;
    use SoftDeletes;

    /** @var bool */
    public $incrementing = false;

    /** @var string */
    protected $table = 'user';

    /** @var string */
    protected $keyType = 'string';

    /** @var array */
    protected $guarded = [];

    /** @var string[] */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
    ];

    /**
     * {@inheritdoc}
     */
    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }

    /**
     * @return HasOne
     */
    public function state(): HasOne
    {
        return $this->hasOne(
            State::class,
            'id',
            'state_id'
        );
    }

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(
            Role::class,
            'user_role',
            'user_id',
            'role_id'
        );
    }

    /**
     * @return HasMany
     */
    public function userRoles(): HasMany
    {
        return $this->hasMany(
            UserRole::class,
            'user_id',
            'id'
        );
    }

    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(
            Permission::class,
            'user_permission',
            'user_id',
            'permission_id'
        );
    }

    /**
     * @return string[]
     */
    public function roleTypes(): array
    {
        return $this->roles()
            ->where('is_active', true)
            ->orderBy('level')
            ->pluck('type')
            ->toArray()
        ;
    }

    /**
     * @param RoleEnum $role
     *
     * @return bool
     */
    public function hasRole(RoleEnum $role): bool
    {
        return $this->roles()->where('type', '=', $role->getValue())->exists();
    }

    /**
     * @param array<RoleEnum> $roles
     */
    public function assignRoles(array $roles): void
    {
        $this->userRoles()->delete();
        foreach ($roles as $role) {
            $this->userRoles()->create([
                'role_id' => Role::getOrCreateByType($role)->id,
            ]);
        }
    }

    /**
     * @return string[]
     */
    public function permissionTypes(): array
    {
        $permission = $this->permissions()
            ->where('is_active', true)
            ->pluck('type')
            ->toArray()
        ;

        /** @var Role $role */
        foreach ($this->roles()->where('is_active', true)->get() as $role) {
            $permission = array_merge($permission, $role->permissionTypes());
        }

        return array_unique($permission);
    }

    /**
     * @param string $email
     * @param string $password
     *
     * @return User
     *
     * @throws BindingResolutionException
     */
    public static function createFromEmail(string $email, string $password): User
    {
        $entity = self::query()->create([
            'state_id' => State::getOrCreateByType(StateEnum::INACTIVE())->id,
            'login' => $email,
            'email' => $email,
            'email_verified_at' => null,
            'password' => $password,
            'locale' => locale()->current(),
        ]);

        assert($entity instanceof self);

        return $entity;
    }
}
