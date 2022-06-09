<?php declare(strict_types=1);

namespace Components\Contents\ReadModel\Model;

final class OffersPaginated
{
    public function __construct(
        public readonly array $offers,
        public readonly int $total,
        public readonly int $perPage,
        public readonly int $currentPage,
        public readonly array $options = [],
    ) {
    }
}
