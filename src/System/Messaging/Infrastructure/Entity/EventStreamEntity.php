<?php

namespace System\Messaging\Infrastructure\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $event_id
 * @property string $event_name
 * @property int    $version
 * @property string $payload
 * @property string $metadata
 * @property string $user_uuid
 */
final class EventStreamEntity extends Model
{
    /** @var string */
    protected $table = 'event_storage';

    /** @var array */
    protected $guarded = [];
}
