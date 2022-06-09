@extends('admin.accounts.admin.profile')

@section('form')
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <form method="POST" action="{{ route('admin.accounts.admin.password.reset', ['adminId' => $admin->id()]) }}">
                    @csrf

                    <div class="row mb-1">
                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('form.label.password') }}</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-1">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('form.label.password_confirm') }}</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row mb-1 mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('form.button.password_reset') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
