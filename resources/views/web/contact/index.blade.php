@extends('layouts.web')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <form id="contactForm" action="mailto:{{ content()->snippet(\Components\Contents\Domain\Enum\SnippetTypeEnum::COMPANY_EMAIL->value, $locale) }}" method="get" enctype="text/plain">
                    <div class="mb-3">
                        <label class="form-label" for="name">{{ __('form.subject') }}</label>
                        <input class="form-control" id="name" type="text" placeholder="{{ __('form.subject') }}" name="subject"/>
                    </div>

                    <!-- Message input -->
                    <div class="mb-3">
                        <label class="form-label" for="message">{{ __('form.message') }}</label>
                        <textarea class="form-control" id="message" type="text" placeholder="{{ __('form.message') }}" style="height: 10rem;" name="body"></textarea>
                    </div>

                    <!-- Form submit button -->
                    <div class="d-grid">
                        <button class="btn btn-primary btn-lg" type="submit">
                            {{ __('form.send') }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
