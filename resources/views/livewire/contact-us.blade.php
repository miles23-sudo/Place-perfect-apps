<div>
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row breadcrumb_box  align-items-center">
                        <div class="col-lg-6 col-md-6 col-sm-12 text-center text-md-start">
                            <h2 class="breadcrumb-title">Contact Us</h2>
                            <p>We are here to help you. Reach out to us for any queries or support.</p>
                        </div>
                        <div class="col-lg-6  col-md-6 col-sm-12">
                            <ul class="breadcrumb-list text-center text-md-end">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('home') }}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Contact</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="contact-area pb-100px pt-100px">
        <div class="container">
            <div class="custom-row-2 row">
                <div class="col-lg-4 col-md-5 mb-lm-60px col-sm-12 col-xs-12 w-sm-100">
                    <div class="contact-info-wrap">
                        <h2 class="title" data-aos="fade-up" data-aos-delay="200">Contact Info</h2>

                        @isset($this->settings->phone_numbers)
                            <div class="single-contact-info" data-aos="fade-up" data-aos-delay="200">
                                <div class="contact-info-inner">
                                    <span class="sub-title">Phone:</span>
                                </div>
                                <div class="contact-info-dec">
                                    @foreach ($this->settings->phone_numbers as $phone)
                                        <p><a href="tel:{{ $phone }}">{{ $phone }}</a></p>
                                    @endforeach
                                </div>
                            </div>
                        @endisset

                        @isset($this->settings->emails)
                            <div class="single-contact-info" data-aos="fade-up" data-aos-delay="200">
                                <div class="contact-info-inner">
                                    <span class="sub-title">Email:</span>
                                </div>
                                <div class="contact-info-dec">
                                    @foreach ($this->settings->emails as $email)
                                        <p><a href="mailto:{{ $email }}">{{ $email }}</a></p>
                                    @endforeach
                                </div>
                            </div>
                        @endisset

                        @isset($this->settings->address)
                            <div class="single-contact-info" data-aos="fade-up" data-aos-delay="200">
                                <div class="contact-info-inner">
                                    <span class="sub-title">Address:</span>
                                </div>
                                <div class="contact-info-dec">
                                    <p>{{ $this->settings->address }}</p>
                                </div>
                            </div>
                        @endisset

                        @isset($this->settings->social_media_links)
                            <div class="contact-social">
                                <h3 class="title" data-aos="fade-up" data-aos-delay="200">Follow Us</h3>
                                <div class="social-info" data-aos="fade-up" data-aos-delay="200">
                                    <ul class="d-flex">

                                        @foreach ($this->settings->social_media_links as $key => $link)
                                            @if ($link)
                                                <li>
                                                    <a href="{{ $link }}"><i
                                                            class="icon-social-{{ $key }}"></i></a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endisset

                    </div>
                </div>

                @isset($this->settings->google_map_iframe)
                    <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">
                        <div class="contact-map h-100">
                            <div class="h-100" id="mapid" data-aos="fade-up" data-aos-delay="200">
                                <div class="mapouter h-100">
                                    <div class="gmap_canvas h-100">
                                        {!! $this->settings->google_map_iframe !!}
                                        <a href="https://sites.google.com/view/maps-api-v2/mapv2"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </div>
</div>
