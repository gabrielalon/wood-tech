@extends('admin.contents.offer.edit.offer')

@section('form')
    @include('admin.contents.offer.edit.heading')

    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <form method="POST" action="{{ route('admin.contents.offer.update.text', ['offerId' => $offer->id()]) }}">
                    @csrf
                    @method('PUT')

                    <div class="form-group form-row">
                        <label for="name" class="col-md-2 col-form-label text-md-end">{{ __('admin.contents.offer.form.label.name') }}</label>

                        <div class="col-8 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">{{ $locale }}</span>
                            </div>
                            <input id="name_{{ $locale }}" type="text"
                                   class="form-control multilang @error('name.' . $locale) is-invalid @enderror"
                                   name="name[{{ $locale }}]" value="{{ old('name.' . $locale, $offer->name($locale)) }}"/>

                            @error('name.' . $locale)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <label for="lead" class="col-md-2 col-form-label text-md-end">
                            {{ __('admin.contents.offer.form.label.lead') }}
                        </label>
                        <div class="col-8">
                            <div id="lead_editor"></div>
                            <input id="lead" type="hidden"
                                   class="form-control multilang @error('lead.' . $locale) is-invalid @enderror"
                                   name="lead[{{ $locale }}]"
                                   value="{{ old('lead.' . $locale, $offer->lead($locale)) }}"/>

                            @error('lead.' . $locale)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group form-row">
                        <label for="description" class="col-md-2 col-form-label text-md-end">
                            {{ __('admin.contents.offer.form.label.description') }}
                        </label>
                        <div class="col-8">
                            <div id="description_editor"></div>
                            <input id="description" type="hidden"
                                   class="form-control multilang @error('description.' . $locale) is-invalid @enderror"
                                   name="description[{{ $locale }}]"
                                   value="{{ old('description.' . $locale, $offer->description($locale)) }}"/>

                            @error('description.' . $locale)
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-2">
                            <button type="submit" class="btn btn-primary">
                                {{ __('form.button.submit') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js-script')
    <script type="application/javascript">
        content().load_markdown_editor('lead', {height: '200px'});
        content().load_markdown_editor('description', {height: '400px'});
    </script>
@endsection
