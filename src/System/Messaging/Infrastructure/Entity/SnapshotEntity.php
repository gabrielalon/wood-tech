<?php

namespace System\Messaging\Infrastructure\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $aggregate_id
 * @property string $aggregate_type
 * @property string $aggregate
 * @property int    $last_version
 */
final class SnapshotEntity extends Model
{
    /** @var string */
    protected $table = 'snapshot_storage';

    /** @var bool */
    public $timestamps = false;

    /** @var array */
    protected $guarded = [];
}
