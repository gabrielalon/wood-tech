<?php declare(strict_types=1);

namespace Components\Contents\Adapters\UI\Http\Admin\Offer;

use Components\Contents\Adapters\UI\Http\Admin\Offer\Request\OfferPaginatedListRequest;
use Components\Contents\ReadModel\Ports\Offers;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\LengthAwarePaginator;

final class OfferPaginatedListHttpAdapter
{
    public function __construct(
        private readonly Offers $offers,
        private readonly Factory $viewFactory,
    ) {
    }

    public function __invoke(OfferPaginatedListRequest $request): View
    {
        $offersPaginated = $this->offers->getOffersPaginated($request->start(), $request->length(), [
            'path' => route('admin.contents.offer.list', ['length' => $request->length(), 'filter' => $request->filter()]),
            'filter' => $request->filter(),
        ]);

        return $this->viewFactory->make('admin.contents.offer.list', [
            'offer_paginator' => new LengthAwarePaginator(
                $offersPaginated->offers,
                $offersPaginated->total,
                $offersPaginated->perPage,
                $offersPaginated->currentPage,
                $offersPaginated->options,
            ),
        ]);
    }
}
