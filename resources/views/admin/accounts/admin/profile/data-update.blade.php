@extends('admin.accounts.admin.profile')

@section('form')
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <form method="POST" action="{{ route('admin.accounts.admin.data.update', ['adminId' => $admin->id()]) }}">
                    @csrf

                    <div class="row mb-1">
                        <label for="full-name" class="col-md-4 col-form-label text-md-end">{{ __('form.label.full_name') }}</label>

                        <div class="col-md-6">
                            <input id="full-name" type="text" name="full_name" value="{{ old('full_name', $admin->fullName()) }}"
                                   class="form-control @error('full_name') is-invalid @enderror" required>

                            @error('full_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-1">
                        <label for="locale" class="col-md-4 col-form-label text-md-end">{{ __('form.label.locale') }}</label>

                        <div class="col-md-6">
                            <select id="locale" class="form-select @error('locale') is-invalid @enderror" name="locale">
                                @foreach ($supported_languages as $languageCode => $languageConfig)
                                    <option value="{{ $languageCode }}"
                                            @if (old('locale', $admin->locale()) === $languageCode) selected="selected" @endif>
                                        {{ $languageConfig['name'] }}
                                    </option>
                                @endforeach
                            </select>

                            @error('locale')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-1">
                        <label class="col-md-4 col-form-label text-md-end">{{ __('form.label.roles') }}</label>

                        <div class="col-md-6 my-2">
                            @foreach ($roles as $role)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" disabled="disabled" checked="checked"
                                           id="role_{{ $role->type() }}" value="{{ $role->id() }}">
                                    <label class="form-check-label" for="role_{{ $role->type() }}">
                                        {{ $role->description(locale()->current()) }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="row mb-1 mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('form.button.update') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
