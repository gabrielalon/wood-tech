<div class="col-md-3">
    <ul class="list-group">
        <li class="list-group-item text-muted"><i class="fa fa-dashboard"></i> {{ __('admin.contents.offer.details') }}</li>
        <a href="{{ route('admin.contents.offer.edit.text', ['offerId' => $offer->id()]) }}"
           class="list-group-item list-group-item-action disabled">
            {{ __('admin.contents.offer.edit') }}
        </a>

        @foreach(Loc::supported() as $loc)
            <a href="{{ route('admin.contents.offer.edit.text', ['offerId' => $offer->id(), 'locale' => $loc]) }}"
               class="list-group-item list-group-item-action d-flex justify-content-between align-items-center
                     @if (Route::is('admin.contents.offer.edit.text') && $loc === $locale->getValue()) active @endif">
                {{ __('admin.contents.offer.text') }}
                <span class="badge badge-primary badge-pill text-uppercase">{{ $loc }}</span>
            </a>
        @endforeach

        <a href="{{ route('admin.contents.offer.edit.availability', ['offerId' => $offer->id()]) }}"
           class="list-group-item list-group-item-action @if (Route::is('admin.contents.offer.edit.availability')) active @endif">
            {{ __('admin.contents.offer.availability') }}
        </a>

        @if (Content::askBlog()->hasCategories())
            <a href="{{ route('admin.contents.offer.edit.relationship', ['offerId' => $offer->id()]) }}"
               class="list-group-item list-group-item-action @if (Route::is('admin.contents.offer.edit.relationship')) active @endif">
                {{ __('admin.contents.offer.relationship') }}
            </a>
        @endif

        <a href="{{ route('admin.contents.offer.remove', ['offerId' => $offer->id()]) }}"
           class="list-group-item list-group-item-action list-group-item-danger"
           onclick="event.preventDefault();
               document.getElementById('offer-remove-{{ $offer->id() }}').submit();">
            {{ __('admin.contents.offer.remove') }}
        </a>
    </ul>
</div>

<form id="offer-remove-{{ $offer->id() }}"
      action="{{ route('admin.contents.offer.remove', ['offerId' => $offer->id()]) }}"
      method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
