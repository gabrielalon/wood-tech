<?php declare(strict_types=1);

namespace Components\Contents\Adapters\UI\Http\Admin\Offer;

use Components\Contents\Adapters\UI\Http\Admin\Offer\Request\OfferCreateRequest;
use Illuminate\Http\RedirectResponse;

final class OfferCreateHandler
{
    public function __invoke(OfferCreateRequest $request): RedirectResponse
    {
        [$name, $lead, $description] = [
            $request->input('name'),
            $request->input('lead'),
            $request->input('description'),
        ];

        $this->content->createBlogEntry($name, $lead, $description);

        flash()->success(__('form.flash.success'));

        return redirect()->route('admin.contents.offer.list');
    }
}
