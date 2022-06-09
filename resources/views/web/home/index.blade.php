@extends('layouts.web')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="bg-light rounded-lg mt-5 mb-lg-5 pb-lg-5">
                    <h1 class="display-4">
                        {{ $page->names->locale($locale) }}
                    </h1>
                    <p class="lead">
                        {{ $page->leads->locale($locale) }}
                    </p>
                    <hr class="my-4">
                    <p>
                        {{ $page->descriptions->locale($locale) }}
                    </p>
                    <a class="btn btn-primary btn-lg float-end" href="#" role="button">
                        {{ __('general.contact') }}
                    </a>
                </div>

                @foreach($offers as $offer)
                    @if($loop->index % 3 === 0)
                        <div class="card-group mb-lg-5">
                    @endif

                    <div class="card col-md-3">
                        <img src="{{ asset('images/offers/' . $offer->type . '.jpg') }}"
                             class="card-img-top"
                             alt="{{ $offer->names->locale($locale) }}" />
                        <div class="card-body">
                            <h5 class="card-title">
                                {{ $offer->names->locale($locale) }}
                            </h5>
                            <p class="card-text">
                                {{ $offer->leads->locale($locale) }}
                            </p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a class="btn btn-sm btn-primary float-end"
                                   href="{{ route('web.contents.offers.details', ['locale' => $locale, 'id' => $offer->id]) }}"
                                   role="button">
                                    {{ __('general.more') }}
                                </a>
                            </li>
                        </ul>
                    </div>

                    @if($loop->index % 3 === 2)
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <x-mapbox
        id="map"
        style="height: 400px; width: 100%; position: relative;"
        :center="['long' => 18.85, 'lat' => 50.37]"
        :markers="[['long' => 18.85, 'lat' => 50.37, 'description' => 'Wood-Tech']]" />
@endsection
