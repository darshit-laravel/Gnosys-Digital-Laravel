@extends('layouts.app')

@section('content')

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-10" data-aos="fade-up" data-aos-duration="1000">
                    <h1 class="hero-title">{!! $heroContent->title ?? 'Expert-Built Digital Solutions<br><span style="color: var(--g-primary)">No Freelancers. No Outsourcing.</span>' !!}</h1>
                    <p class="hero-subtitle mx-auto">{{ $heroContent->subtitle ?? 'From high-performing websites and automation setups to ready-to-use digital products — we build everything in-house so you can grow with confidence.' }}</p>
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <a href="{{ $heroContent->button_link ?? '#' }}" class="btn-gnosys btn-hero-primary">{{ $heroContent->button_text ?? 'Explore Our Gigs' }}</a>
                        <a href="{{ route('digital-products') }}" class="btn-gnosys-outline btn-hero-outline">Shop Digital Products</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What We Do / Core Offerings -->
    <section id="core-offerings" class="section-padding section-bg-white">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12" data-aos="fade-up">
                    <span class="sub-heading">What We Do</span>
                    <h2 class="section-title">Our Core Offerings</h2>
                </div>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-md-6 col-lg-5" data-aos="fade-right" data-aos-delay="100">
                    <div class="gnosys-card text-center">
                        <div class="icon-wrapper mx-auto">
                            <i class="fas fa-house-user"></i>
                        </div>
                        <h3>In-House Gigs</h3>
                        <p class="text-muted fw-bold">Done-for-You Digital Services</p>
                        <p>Web Development, SEO, eCommerce, Server Management, and Marketing Automation — delivered
                            end-to-end by our team.</p>
                        <a href="{{ route('digital-services') }}" class="btn-gnosys mt-3">View All Gigs</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-5" data-aos="fade-left" data-aos-delay="200">
                    <div class="gnosys-card text-center">
                        <div class="icon-wrapper mx-auto">
                            <i class="fab fa-digital-ocean"></i>
                        </div>
                        <h3>Digital Products</h3>
                        <p class="text-muted fw-bold">Ready-to-Use Digital Assets</p>
                        <p>Templates, WordPress themes, AI tools, and growth frameworks built to accelerate your business
                            workflows.</p>
                        <a href="{{ route('digital-products') }}" class="btn-gnosys mt-3">Shop Products</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Gnosys -->
    <section id="why-gnosys" class="section-padding section-bg-light">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12" data-aos="fade-up">
                    <span class="sub-heading">Why Gnosys (Differentiators)</span>
                    <h2 class="section-title">Why Businesses Choose Gnosys Digital</h2>
                </div>
            </div>
            <div class="row g-4">
                @foreach($features as $feature)
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="gnosys-card">
                        <div class="icon-wrapper">
                            <i class="{{ $feature->icon }}"></i>
                        </div>
                        <h4>{{ $feature->title }}</h4>
                        <p>{{ $feature->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Culture of Change -->
    <section class="section-padding bg-dark text-white"
        style="background: linear-gradient(rgba(0,34,51,0.9), rgba(0,34,51,0.9)), url('{{ $cultureCta->image_url ?? asset('/images/banner.webp') }}') center/cover;">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8" data-aos="zoom-in">
                    <h2 class="mb-4 text-white">{{ $cultureCta->title ?? 'Our Culture of Change' }}</h2>
                    <p class="lead mb-5" style="color: #cbd5e1;">{{ $cultureCta->content ?? 'Change isn’t a campaign for us — it’s our culture.' }}</p>
                    <a href="{{ $cultureCta->button_link ?? route('about.culture') }}" class="btn-gnosys border-0 bg-white" style="color: var(--g-accent);">{{ $cultureCta->button_text ?? 'Read Our Story' }}</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Gigs -->
    <section class="section-padding section-bg-white">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12" data-aos="fade-up">
                    <span class="sub-heading">Featured Gigs</span>
                    <h2 class="section-title">Our Top Gigs — Built & Delivered by Experts</h2>
                </div>
            </div>
            <div class="row g-4 text-center justify-content-center">
                @forelse($featuredServices as $service)
                <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <a href="{{ route('digital-services') }}" class="text-decoration-none">
                        <div class="gnosys-card d-flex flex-column align-items-center justify-content-center py-5 bg-light border-0 shadow-sm h-100 transition-all">
                            <div class="icon-wrapper rounded-circle mb-3">
                                <i class="fas fa-rocket fs-3"></i>
                            </div>
                            <h4 class="fs-5 text-dark">{{ $service->title }}</h4>
                            <p class="small text-muted px-3">{{ Str::limit($service->description, 60) }}</p>
                        </div>
                    </a>
                </div>
                @empty
                <div class="col-12 text-center text-muted">
                    <p>No featured services available.</p>
                </div>
                @endforelse
            </div>
            <div class="text-center mt-5" data-aos="fade-up">
                <a href="{{ route('digital-services') }}" class="btn-gnosys">View All Gigs</a>
            </div>
        </div>
    </section>

    <!-- Featured Digital Products -->
    <section class="section-padding section-bg-light">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12" data-aos="fade-up">
                    <span class="sub-heading">Featured Digital Products</span>
                    <h2 class="section-title">Ready-to-Use Digital Products</h2>
                </div>
            </div>
            <div class="row g-4">
                @forelse($featuredProducts as $product)
                <!-- Product Card -->
                <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="product-card d-flex flex-column border-0 shadow-sm h-100">
                        <img src="{{ $product->image_url }}"
                            alt="{{ $product->title }}" class="product-img" onerror="this.src='https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'">
                        <div class="product-body text-center flex-grow-1 d-flex flex-column p-4">
                            <h5 class="mb-3 product-title">{{ $product->title }}</h5>
                            <p class="fw-bold fs-4 text-dark mb-4">{{ $product->formatted_price }}</p>
                            <button type="button" class="btn-gnosys-outline w-100 mt-auto btn-add-to-cart" data-product-price="0.00" data-product-id="{{ encrypt($product->id) }}" data-product-type="product">Add to cart</button>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center text-muted py-5">
                    <p>No featured products available at the moment.</p>
                </div>
                @endforelse
            </div>
            <div class="text-center mt-5" data-aos="fade-up">
                <a href="{{ route('digital-products') }}" class="btn-gnosys">Browse All Products</a>
            </div>
        </div>
    </section>

    <!-- Solutions by Goal -->
    <section id="solutions-goal" class="section-padding section-bg-white">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12" data-aos="fade-up">
                    <span class="sub-heading">Solutions by Goal</span>
                    <h2 class="section-title">Solutions Built for Every Digital Goal</h2>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="gnosys-card text-center border-0 shadow-sm bg-light">
                        <i class="fas fa-rocket fa-3x mb-3" style="color: var(--g-primary)"></i>
                        <h4 class="mb-2">Launch Fast</h4>
                        <p class="text-muted small">For startups & new businesses</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="gnosys-card text-center border-0 shadow-sm bg-light">
                        <i class="fas fa-shopping-cart fa-3x mb-3" style="color: var(--g-primary)"></i>
                        <h4 class="mb-2">Scale Online Sales</h4>
                        <p class="text-muted small">For eCommerce brands</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="300">
                    <div class="gnosys-card text-center border-0 shadow-sm bg-light">
                        <i class="fas fa-cogs fa-3x mb-3" style="color: var(--g-primary)"></i>
                        <h4 class="mb-2">Automate Workflows</h4>
                        <p class="text-muted small">For agencies & SaaS founders</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6" data-aos="zoom-in" data-aos-delay="400">
                    <div class="gnosys-card text-center border-0 shadow-sm bg-light">
                        <i class="fas fa-search-dollar fa-3x mb-3" style="color: var(--g-primary)"></i>
                        <h4 class="mb-2">Grow Visibility</h4>
                        <p class="text-muted small">For SEO & content-driven teams</p>
                    </div>
                </div>
            </div>
            <div class="text-center mt-5" data-aos="fade-up">
                <a href="#" class="btn-gnosys">Explore Solutions</a>
            </div>
        </div>
    </section>

    <!-- Proof & Impact Section -->
    <section id="proof-impact" class="section-padding section-bg-light">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12" data-aos="fade-up">
                    <span class="sub-heading">Results</span>
                    <h2 class="section-title">Proven Results. Real Impact.</h2>
                    <p class="lead text-muted mb-5 max-w-700 mx-auto w-75">We deliver measurable outcomes that drive
                        business growth and digital transformation.</p>
                </div>
            </div>
            <div class="row g-4">
                @foreach($stats as $stat)
                <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="text-center bg-white p-4 rounded-4 shadow-sm border h-100">
                        <div class="impact-number mb-3">
                            <h3 class="display-4 fw-bold" style="color: var(--g-primary);">{{ $stat->value }}</h3>
                        </div>
                        <h5 class="fw-semibold">{{ $stat->label }}</h5>
                        <p class="text-muted small">{{ $stat->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-5" data-aos="fade-up">
                <a href="#" class="btn-gnosys">View Case Studies</a>
            </div>
        </div>
    </section>

    <!-- What Our Clients Say -->
    <section class="section-padding section-bg-white">
        <div class="container">
            <div class="row text-center mb-5">
                <div class="col-12" data-aos="fade-up">
                    <span class="sub-heading">Testimonials</span>
                    <h2 class="section-title">What Our Clients Say</h2>
                </div>
            </div>
            <div class="row g-4">
                @foreach($testimonials as $testimonial)
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="gnosys-card h-100 bg-light border-0 shadow-sm">
                        <div class="d-flex mb-3">
                            @for($i=0; $i<$testimonial->rating; $i++)
                            <i class="fas fa-star text-warning"></i>
                            @endfor
                        </div>
                        <p class="mb-4">"{{ $testimonial->content }}"</p>
                        <div class="d-flex align-items-center mt-auto">
                            <div class="bg-white rounded-circle p-3 me-3">
                                @if($testimonial->client_image)
                                    <img src="{{ $testimonial->client_image }}" alt="{{ $testimonial->client_name }}" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <i class="fas fa-user" style="color: var(--g-primary)"></i>
                                @endif
                            </div>
                            <div>
                                <h6 class="mb-0">{{ $testimonial->client_name }}</h6>
                                <small class="text-muted">{{ $testimonial->client_designation }}</small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="text-center mt-5" data-aos="fade-up">
                <a href="#" class="btn-gnosys">Client Voices</a>
            </div>
        </div>
    </section>

    <!-- Footer CTA -->
    <section class="section-padding" style="background-color: var(--g-primary); color: white;">
        <div class="container text-center" data-aos="fade-up">
            <h2 class="text-white mb-4">Ready to Start Something Great?</h2>
            <p class="lead mb-5 max-w-700 mx-auto w-75">Whether you want to launch a store, scale marketing, or streamline
                your workflows — Gnosys Digital is your in-house growth partner.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="#" class="btn-gnosys bg-white border-0 text-dark" style="color: var(--g-accent) !important;">Get
                    Started</a>
                <a href="#" class="btn-gnosys-outline text-white border-white">Book a Free Consultation</a>
            </div>
        </div>
    </section>

    @push('scripts')

    @endpush

@endsection
