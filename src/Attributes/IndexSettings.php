<?php

declare(strict_types=1);

namespace Imdhemy\EsSugar\Attributes;

use Attribute;
use Imdhemy\EsSugar\ValueObjects\ArrayObject;

#[Attribute]
final class IndexSettings extends ArrayObject
{
    /**
     * List of static index settings
     * These settings are applied to the index at the time of creation only.
     * They cannot be changed after the index is created
     */
    public const STATIC_SETTINGS = [
        'number_of_shards',
        'number_of_routing_shards',
        'codec',
        'routing_partition_size',
        'soft_deletes.enabled',
        'soft_deletes.retention_lease.period',
        'load_fixed_bitset_filters_eagerly',
        'shard.check_on_startup',
    ];
}
