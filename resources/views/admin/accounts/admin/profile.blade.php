@extends('layouts.admin')

@section('content')

<div class="container">
    <div class="row">
        @include ('admin.accounts.admin.profile.details')

        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <ol class="breadcrumb bg-transparent mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin.accounts.admin.list')}}">{{ __('admin.navbar.account.admin') }}</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ __('admin.accounts.admin.profile') }}
                        </li>
                    </ol>
                </div>
                @yield('form')
            </div>
        </div>
    </div>
</div>
@endsection
