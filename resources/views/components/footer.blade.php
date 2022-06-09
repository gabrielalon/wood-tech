<footer class="text-center text-lg-start bg-light text-muted">
    <div class="container border-bottom">
        <div class="row justify-content-center py-4">
            <div class="col-md-9">
                <span>{{ __('general.stay_in_touch') }}</span>

                <a href="" class="text-reset float-end">
                    <i class="fa fa-facebook-f"></i>
                </a>
            </div>
        </div>
    </div>
    <!-- Section: Social media -->

    <!-- Section: Links  -->
    <section class="">
        <div class="container text-center text-md-start mt-5">
            <!-- Grid row -->
            <div class="row mt-3">
                <!-- Grid column -->
                <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                    <!-- Content -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        <i class="fa fa-hacker-news me-3"></i> {{ config('app.name') }}
                    </h6>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        {{ __('general.offers') }}
                    </h6>
                    @foreach($offers as $offer)
                        <p>
                            <a href="{{ route('web.contents.offers.details', ['locale' => locale()->current(), 'id' => $offer->id]) }}"
                               class="text-reset">
                                {{ $offer->names->locale(locale()->current()) }}
                            </a>
                        </p>
                    @endforeach
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        {{ __('general.useful_links') }}
                    </h6>
                    <p>
                        <a href="{{ route('web.contents.home', ['locale' => locale()->current()]) }}" class="text-reset">
                            {{ __('general.home') }}
                        </a>
                    </p>
                    <p>
                        <a href="{{ route('web.contents.pages.details', ['locale' => locale()->current(), 'type' => \Components\Contents\Domain\Enum\PageTypeEnum::PRIVACY_POLICY->value]) }}" class="text-reset">
                            {{ __('general.privacy_policy') }}
                        </a>
                    </p>
                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                    <!-- Links -->
                    <h6 class="text-uppercase fw-bold mb-4">
                        {{ __('general.contact') }}
                    </h6>
                    <p>
                        <i class="fa fa-home me-3"></i>
                        {{ content()->snippet(\Components\Contents\Domain\Enum\SnippetTypeEnum::COMPANY_ADDRESS_LINE_1->value) }}/{{ content()->snippet(\Components\Contents\Domain\Enum\SnippetTypeEnum::COMPANY_ADDRESS_LINE_2->value) }}
                        <br />
                        {{ content()->snippet(\Components\Contents\Domain\Enum\SnippetTypeEnum::COMPANY_CITY->value) }},
                        {{ content()->snippet(\Components\Contents\Domain\Enum\SnippetTypeEnum::COMPANY_ZIP_CODE->value) }},
                        {{ content()->snippet(\Components\Contents\Domain\Enum\SnippetTypeEnum::COMPANY_COUNTRY->value) }}
                    </p>
                    <p>
                        <i class="fa fa-envelope me-3"></i>
                        {{ content()->snippet(\Components\Contents\Domain\Enum\SnippetTypeEnum::COMPANY_EMAIL->value) }}
                    </p>
                    <p>
                        <i class="fa fa-phone me-3"></i>
                        {{ content()->snippet(\Components\Contents\Domain\Enum\SnippetTypeEnum::COMPANY_PHONE->value) }}
                    </p>
                </div>
                <!-- Grid column -->
            </div>
            <!-- Grid row -->
        </div>
    </section>
    <!-- Section: Links  -->

    <!-- Copyright -->
    <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
        &copy; {{ now()->format('Y') }} Copyright:
        <a class="text-reset fw-bold" href="{{ route('web.contents.home', ['locale' => locale()->current()]) }}">
            {{ config('app.name') }}
        </a>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->
