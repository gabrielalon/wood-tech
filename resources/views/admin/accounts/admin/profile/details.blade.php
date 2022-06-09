<div class="col-md-3">
    <ul class="list-group">
        <li class="list-group-item text-muted"><i class="fa fa-dashboard"></i> {{ __('admin.accounts.admin.details') }}</li>
        <a href="{{ route('admin.accounts.admin.data.show', ['adminId' => $admin->id()]) }}"
           class="list-group-item list-group-item-action @if (Route::is('admin.accounts.admin.data.show')) active @endif">
            {{ __('admin.accounts.admin.action.data_update') }}
        </a>
        <a href="{{ route('admin.accounts.admin.password.reset.show', ['adminId' => $admin->id()]) }}"
           class="list-group-item list-group-item-action @if (Route::is('admin.accounts.admin.password.reset.show')) active @endif">
            {{ __('admin.accounts.admin.action.password_reset') }}
        </a>
    </ul>
</div>
