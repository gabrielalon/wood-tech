@extends('layouts.web')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="mb-3 h2" style="margin-top: 25rem;">{{ $page->names->locale($locale) }}</h1>

            <p>{{ $page->descriptions->locale($locale) }}</p>
        </div>
    </div>
@endsection
