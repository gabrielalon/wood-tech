<?php

namespace Components\Accounts\Adapters\Infrastructure\ORM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * @property int    $id
 * @property string $user_id
 * @property string $role_id
 */
final class UserRole extends Eloquent
{
    use HasFactory;

    /** @var bool */
    public $timestamps = false;

    /** @var string */
    protected $table = 'user_role';

    /** @var array */
    protected $guarded = [];
}
