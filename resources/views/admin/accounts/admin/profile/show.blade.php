@extends('admin.accounts.admin.profile')

@section('form')
    <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ __('admin.accounts.admin.full_name') }}
            <span class="badge bg-secondary">{{ $admin->fullName() }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ __('admin.accounts.admin.email') }}
            <span class="badge bg-secondary">{{ $admin->email() }}</span>
        </li>
        <li class="list-group-item d-flex justify-content-between align-items-center">
            {{ __('admin.accounts.admin.role') }}
            @foreach($admin->roles() as $role)
                <span class="badge bg-secondary">{{ $role }}</span>
            @endforeach
        </li>
    </ul>
@endsection
