@extends('layouts.admin')

@section('content')

    @php
        use Illuminate\Pagination\LengthAwarePaginator;
        assert($admins_paginator instanceof LengthAwarePaginator);
    @endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('admin.accounts.admin.list.header') }}</div>

                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-10">
                                <form action="{{ route('admin.accounts.admin.list') }}">
                                    <nav class="navbar navbar-expand-lg navbar-filters float-left">
                                        <i class="fa fa-filter"></i>
                                        <input type="hidden" name="page" value="1" />
                                        <input type="hidden" name="length" value="{{ $admins_paginator->perPage() }}" />
                                        <ul class="nav navbar-nav">
                                            <li class="nav-item dropdown show active">
                                                <a id="dropdownEmailFilter" href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">
                                                    {{ __('admin.accounts.admin.email') }} <span class="caret"></span>
                                                </a>
                                                <div class="dropdown-menu p-0 @if (\Illuminate\Support\Arr::has($filter, 'email')) show @endif" aria-labelledby="dropdownEmailFilter">
                                                    <div class="row backpack-filter mb-0">
                                                        <div class="input-group">
                                                            <input class="form-control pull-right" id="text-filter-text" type="text" name="filter[email]" value="{{ $filter['email'] ?? null }}"/>
                                                            <button class="input-group-text" type="submit"><i class="fa fa-search"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </nav>
                                </form>
                            </div>
                            <div class="col-md-2 pt-2">
                                <form action="{{ route('admin.accounts.admin.list') }}" class="pull-right">
                                    <input type="hidden" name="page" value="1" />
                                    <input type="hidden" name="length" value="{{ $admins_paginator->perPage() }}" />
                                    <div class="input-group input-group-sm">
                                        <label for="admin-pagination"></label>
                                        <select id="admin-pagination" class="form-select">
                                            @foreach([10, 25, 50] as $number)
                                                <option value="{{ $number }}" @if ($admins_paginator->perPage() === $number)selected="selected" @endif>{{ $number }}</option>
                                            @endforeach
                                        </select>
                                        <button class="input-group-text" type="submit"><i class="fa fa-times"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-10"></div>
                            <div class="col-md-2">
                                <blockquote class="blockquote text-end">
                                    <footer class="blockquote-footer fs-6">{{ __('admin.accounts.admin.list.manage') }}</footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('admin.accounts.admin.login') }}</th>
                            <th scope="col">{{ __('admin.accounts.admin.full_name') }}</th>
                            <th scope="col">{{ __('admin.accounts.admin.email') }}</th>
                            <th scope="col">{{ __('admin.accounts.admin.manage') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $counter = max(0, $admins_paginator->currentPage() - 1) * $admins_paginator->perPage() + 1; @endphp
                        @foreach ($admins_paginator as $admin)
                            <tr>
                                <th scope="row" class="align-middle">{{ $counter++ }}</th>
                                <td class="align-middle">{{ $admin->login() }}</td>
                                <td class="align-middle">{{ $admin->fullName() }}</td>
                                <td class="align-middle">{{ $admin->email() }}</td>
                                <td class="align-middle">
                                    <a href="{{ route('admin.accounts.admin.profile.show', ['adminId' => $admin->id()]) }}"
                                       class="badge badge-light text-dark">
                                        <i class="fa fa-search"></i>
                                    </a>
                                    <a href="{{ route('admin.accounts.admin.data.show', ['adminId' => $admin->id()]) }}"
                                       class="badge badge-light text-dark">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </a>
                                    <a class="badge badge-light text-danger"
                                       href="{{ route('admin.accounts.admin.remove', ['adminId' => $admin->id()]) }}"
                                       onclick="event.preventDefault();
                                                document.getElementById('account-remove-{{ $admin->id() }}').submit();">
                                        <i class="fa fa-trash-o"></i>
                                    </a>

                                    <form id="account-remove-{{ $admin->id() }}"
                                          action="{{ route('admin.accounts.admin.remove', ['adminId' => $admin->id()]) }}"
                                          method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="justify-content-center">
                        {{ $admins_paginator->links('layouts/pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js-script')
    <script type="application/javascript">
        pagination().track_length_change('admin-pagination');
    </script>
@endsection
