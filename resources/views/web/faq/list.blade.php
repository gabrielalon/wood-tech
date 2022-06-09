@extends('layouts.web')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                @foreach($faqs as $faq)
                    <div class="card">
                        <div class="card-header">{{ $faq->questions->locale($locale) }}</div>
                        <div class="card-body">
                            <p class="card-text">{{ $faq->answers->locale($locale) }}</p>
                        </div>
                    </div>
                    <br />
                @endforeach
            </div>
        </div>
    </div>
@endsection
