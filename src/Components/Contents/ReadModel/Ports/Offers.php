<?php declare(strict_types=1);

namespace Components\Contents\ReadModel\Ports;

use Components\Contents\ReadModel\Model\Offer;
use Components\Contents\ReadModel\Model\OffersPaginated;

interface Offers
{
    /**
     * @return array<Offer>
     */
    public function getOffers(): array;

    public function getOffersPaginated(int $start, int $length = 10, array $options = []): OffersPaginated;

    public function findOffer(string $id): Offer;
}
