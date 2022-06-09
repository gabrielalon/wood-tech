<?php declare(strict_types=1);

namespace Components\Contents\Domain\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class OfferNotFound extends NotFoundHttpException
{
    public static function forId(string $id): self
    {
        return new self("Offer not found for id: " . $id);
    }
}
