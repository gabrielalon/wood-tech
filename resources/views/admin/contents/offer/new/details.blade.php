<div class="col-md-3">
    <ul class="list-group">
        <li class="list-group-item text-muted"><i class="fa fa-dashboard"></i> {{ __('admin.contents.offer.details') }}</li>
        <a href="{{ route('admin.contents.offer.new', ['locale' => $locale->getValue()]) }}"
           class="list-group-item list-group-item-action disabled">
            {{ __('admin.contents.offer.new') }}
        </a>

        @foreach(Loc::supported() as $loc)
            <a href="{{ route('admin.contents.offer.new', ['locale' => $loc]) }}"
               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center
                     @if (Route::is('admin.contents.offer.new') && $loc === $locale->getValue()) active @endif">
                {{ __('admin.contents.offer.text') }}
                <span class="badge badge-primary badge-pill text-uppercase">{{ $loc }}</span>
            </a>
        @endforeach

        <a href="{{ route('admin.contents.offer.edit.availability', ['offerId' => $offer->id()]) }}"
           class="list-group-item list-group-item-action disabled">
            {{ __('admin.contents.offer.availability') }}
        </a>

        @if (Content::askBlog()->hasCategories())
            <a href="{{ route('admin.contents.offer.edit.relationship', ['offerId' => $offer->id()]) }}"
               class="list-group-item list-group-item-action disabled">
                {{ __('admin.contents.offer.relationship') }}
            </a>
        @endif

        <a href="{{ route('admin.contents.offer.remove', ['offerId' => $offer->id()]) }}"
           class="list-group-item list-group-item-danger disabled">
            {{ __('admin.contents.offer.remove') }}
        </a>
    </ul>
</div>
