<?php declare(strict_types=1);

namespace Components\Contents\Adapters\Infrastructure\Database;

use Components\Contents\Adapters\Infrastructure\Entity\Offer as OfferEntity;
use Components\Contents\Domain\Exceptions\OfferNotFound;
use Components\Contents\ReadModel\Model\Offer;
use Components\Contents\ReadModel\Model\OffersPaginated;
use Components\Contents\ReadModel\Ports\Offers;
use Illuminate\Support\Arr;
use System\Valuing\Intl\Language\Contents;
use System\Valuing\Intl\Language\Texts;

final class DBOffers implements Offers
{
    public function __construct(
        private readonly OfferEntity $db,
    ) {
    }

    public function getOffers(): array
    {
        return $this->db->newQuery()->get()
            ->map(fn (OfferEntity $entity): Offer => $this->convert($entity))
            ->all();
    }

    public function getOffersPaginated(int $start, int $length = 10, array $options = []): OffersPaginated
    {
        $query = $this->db->newQuery()->selectRaw('offer.*')
            ->join('offer_translation', 'offer_translation.offer_id', '=', 'offer.id')
            ->orderBy('offer.created_at')
            ->groupBy('offer.id');

        foreach (Arr::get($options, 'filter') as $field => $value) {
            if ('name' === $field) {
                /* @phpstan-ignore-next-line */
                $query->orWhereLike('offer_translation.name', $value)
                    ->orWhereLike('offer_translation.lead', $value)
                    ->orWhereLike('offer_translation.description', $value);
            }
        }

        $totalCount = $query->count();
        $offers = $query->offset($start * $length)->limit($length)->get()
            ->map(fn (OfferEntity $entity): Offer => $this->convert($entity))
            ->all();

        return new OffersPaginated($offers, $totalCount, $length, $start + 1, $options);
    }

    public function findOffer(string $id): Offer
    {
        $entity = OfferEntity::findByUuid($id);

        if ($entity === null) {
            throw OfferNotFound::forId($id);
        }

        return $this->convert($entity);
    }

    private function convert(OfferEntity $entity): Offer
    {
        return new Offer(
            $entity->id,
            $entity->type,
            Texts::fromArray($entity->names()),
            Texts::fromArray($entity->leads()),
            Contents::fromArray($entity->descriptions()),
        );
    }
}
