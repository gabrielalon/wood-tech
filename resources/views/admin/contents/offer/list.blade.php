@extends('layouts.admin')

@section('content')

    @php
        use Illuminate\Pagination\LengthAwarePaginator;
        assert($offer_paginator instanceof LengthAwarePaginator);
    @endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    {{ __('admin.contents.offer.index.header') }}

                    <a href="{{ route('admin.contents.offer.new') }}" class="btn btn-primary btn-sm pull-right">
                        {{ __('admin.contents.offer.new') }}
                    </a>
                </div>

                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-10">
                                <form action="{{ route('admin.contents.offer.list') }}">
                                    <nav class="navbar navbar-expand-lg navbar-filters float-left">
                                        <i class="fa fa-filter"></i>
                                        <ul class="nav navbar-nav">
                                            <li class="nav-item dropdown show active">
                                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                                    {{ __('admin.contents.offer.name') }} <span class="caret"></span>
                                                </a>
                                                <div class="dropdown-menu p-0 @if (\Illuminate\Support\Arr::has($filter, 'name')) show @endif">
                                                    <div class="form-group backpack-filter mb-0">
                                                        <div class="input-group">
                                                            <input class="form-control pull-right" type="text" name="filter[name]" value="{{ $filter['name'] ?? null }}"/>
                                                            <div class="input-group-append">
                                                                <button class="input-group-text" type="submit"><i class="fa fa-search"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </nav>
                                </form>
                            </div>

                            <div class="col-md-2 pt-2">
                                <form action="{{ route('admin.contents.offer.list') }}">
                                    <input type="hidden" name="page" value="1" />
                                    <input type="hidden" name="length" value="{{ $offer_paginator->perPage() }}" />
                                    <div class="input-group">
                                        <label for="contents-offer-pagination"></label>
                                        <select id="contents-offer-pagination" class="custom-select">
                                            @foreach([5, 10, 25, 50] as $number)
                                                <option value="{{ $number }}" @if ($offer_paginator->perPage() === $number)selected="selected" @endif>{{ $number }}</option>
                                            @endforeach
                                        </select>
                                        <div class="input-group-append">
                                            <button class="input-group-text" type="submit"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10"></div>
                            <div class="col-md-2">
                                <blockquote class="blockquote text-end">
                                    <footer class="blockquote-footer">{{ __('admin.list.manage') }}</footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col" style="width: 40%">{{ __('admin.contents.offer.name') }}</th>
                            <th scope="col" style="width: 40%">{{ __('admin.contents.offer.publish_at') }}</th>
                            <th scope="col">{{ __('admin.contents.offer.manage') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $counter = max(0, $offer_paginator->currentPage() - 1) * $offer_paginator->perPage() + 1; @endphp
                        @foreach ($offer_paginator as $offer)
                            @include('admin.contents.offer.list_item', ['counter' => $counter, 'offer' => $offer])
                        @endforeach
                        </tbody>
                    </table>

                    <div class="justify-content-center">
                        {{ $offer_paginator->links('layouts/pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js-script')
    <script type="application/javascript">
        pagination().track_length_change('contents-offer-pagination');
    </script>
@endsection
