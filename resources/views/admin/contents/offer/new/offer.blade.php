@extends('layouts.admin')

@section('content')

    <div class="container">
        <div class="row">
            @include ('admin.contents.offer.new.details')

            <div class="col-md-9">
                <div class="card">
                    @yield('form')
                </div>
            </div>
        </div>
    </div>
@endsection
