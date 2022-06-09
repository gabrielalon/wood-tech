<a href="{{ route('admin.contents.offer.edit.text', ['offerId' => $offer->id()]) }}"
   data-toggle="tooltip" data-placement="top"
   title="{{ __('admin.contents.offer.edit') }}"
   class="badge badge-light text-dark pt-sm-3">
    <i class="fa fa-pencil-square-o"></i>
</a>

<div class="btn-group show">
    <a class="btn btn-sm btn-link dropdown-toggle text-primary pl-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <span class="caret"></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-right" x-placement="top-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-85px, -171px, 0px);">
        <li class="dropdown-header">{{ __('admin.contents.offer.edit') }}:</li>

        @foreach(Loc::supported() as $loc)
            <a href="{{ route('admin.contents.offer.edit.text', ['offerId' => $offer->id(), 'locale' => $loc]) }}"
               class="dropdown-item d-flex justify-content-between align-items-center
                     @if (Route::is('admin.contents.offer.edit.text') && $loc === $locale->getValue()) active @endif">

                {{ __('admin.contents.offer.text') }}
                <span class="badge badge-primary badge-pill text-uppercase">{{ $loc }}</span>
            </a>
        @endforeach
    </ul>
</div>

<a class="badge badge-light text-danger"
   href="{{ route('admin.contents.offer.remove', ['offerId' => $offer->id()]) }}"
   onclick="event.preventDefault();
       document.getElementById('offer-remove-{{ $offer->id() }}').submit();">
    <i class="fa fa-trash-o"></i>
</a>

<form id="offer-remove-{{ $offer->id() }}"
      action="{{ route('admin.contents.offer.remove', ['offerId' => $offer->id()]) }}"
      method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
