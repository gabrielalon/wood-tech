@extends('layouts.web')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div
                class="bg-image p-5 text-center shadow-1-strong rounded mb-5 text-white"
                style="
                    background-image: url('{{ asset('images/offers/' . $offer->type . '.jpg') }}');
                    background-size: cover;
                    min-height: 600px;">
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                {{ $offer->names->locale($locale) }}
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $offer->leads->locale($locale) }}</h5>
                <p class="card-text">{{ $offer->descriptions->locale($locale) }}</p>
                <a class="btn btn-sm btn-primary float-end"
                   href="{{ route('web.contents.home', ['locale' => $locale]) }}">
                    {{ __('general.back') }}
                </a>
            </div>
        </div>
    </div>
@endsection
