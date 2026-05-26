@extends('layouts.app')

@section('title', 'SEO Services - Gnosysdigital')

@section('content')

{{-- ===================== HERO SECTION ===================== --}}
<section class="text-white position-relative overflow-hidden d-flex align-items-center"
    style="
        background-image: url('https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1950&q=80');
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        min-height: 600px;
    ">

    
    {{-- Dark overlay --}}
    <div class="position-absolute top-0 start-0 w-100 h-100"
         style="background: linear-gradient(135deg, rgba(10,37,64,0.93) 0%, rgba(14,52,96,0.90) 60%, rgba(22,61,110,0.87) 100%); z-index:1;"></div>

    <div class="container position-relative w-100" style="z-index:2; padding-top: 80px; padding-bottom: 80px;">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <p class="lead mb-3 fw-semibold" style="color: rgba(255,255,255,.75); letter-spacing:.3px; font-size: 1.1rem;">
                    Be Found. Be Chosen. Be Profitable.
                </p>
                <p class="mb-3" style="color: rgba(255,255,255,.65); font-size: 1rem;">
                    We don't just get you on Google — we grow your revenue. At Gnosys Digital, SEO is not about rankings; it's about measurable outcomes — traffic that converts, content that scales, and visibility that drives profit.
                </p>

                {{-- Animated Counters --}}
                <div class="row justify-content-center mb-4 g-3">
                    <div class="col-auto">
                        <div class="text-center px-4 py-3" style="background: rgba(255,255,255,0.1); border-radius: 12px; min-width: 130px;">
                            <div class="fw-bold text-white" style="font-size: 2rem;">
                                <span class="counter-up" data-target="400">0</span>%
                            </div>
                            <div style="color: rgba(255,255,255,.75); font-size: .85rem;">Traffic Growth</div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="text-center px-4 py-3" style="background: rgba(255,255,255,0.1); border-radius: 12px; min-width: 130px;">
                            <div class="fw-bold text-white" style="font-size: 2rem;">
                                <span class="counter-up" data-target="6">0</span>X
                            </div>
                            <div style="color: rgba(255,255,255,.75); font-size: .85rem;">ROI within 6 Months</div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="text-center px-4 py-3" style="background: rgba(255,255,255,0.1); border-radius: 12px; min-width: 130px;">
                            <div class="fw-bold text-white" style="font-size: 2rem;">
                                <span class="counter-up" data-target="60">0</span>%
                            </div>
                            <div style="color: rgba(255,255,255,.75); font-size: .85rem;">Faster Results</div>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ url('/growth-systems-discovery-call') }}" class="btn btn-light btn-lg fw-semibold px-4">
                        <i class="fas fa-chart-line me-2"></i>Get My SEO Growth Plan
                    </a>
                    <a href="{{ url('/free-digital-consultation') }}" class="btn btn-outline-light btn-lg fw-semibold px-4">
                        <i class="fas fa-comments me-2"></i>Talk to an Expert
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===================== WHY SEO MATTERS SECTION ===================== --}}
<section class="py-5 bg-light" data-aos="fade-up">
    <div class="container">
        <div class="row mb-2" data-aos="fade-up">
            <div class="col-12 text-center">
                <p class="text-uppercase fw-semibold text-primary mb-1" style="letter-spacing: 1px; font-size: .9rem;">Why SEO Matters Now</p>
                <h2 class="fw-bold" style="font-size: 2rem;">Visibility Is Profit. If You're Not Ranking, You're Not in the Game.</h2>
            </div>
        </div>
        <div class="row mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-8 mx-auto text-center">
                <p class="text-muted" style="font-size: 1.05rem;">
                    93% of online experiences start with a search — and 75% of users never go past page one.
                    But SEO today is not just about keywords — it's about <strong>data-driven visibility, intent-based optimization,</strong> and <strong>strategic storytelling</strong> that makes search engines and humans trust you.
                </p>
            </div>
        </div>

        <div class="row g-4 justify-content-center mb-5" data-aos="fade-up" data-aos-delay="200">
            <div class="col-md-4">
                <div class="card border-0 shadow text-center h-100" style="border-radius: 12px; border-top: 4px solid #0a2540;">
                    <div class="card-body p-4">
                        <i class="fas fa-chart-bar fa-2x text-primary mb-3"></i>
                        <h5 class="fw-bold">57% of marketers say SEO drives more sales than paid ads.</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow text-center h-100" style="border-radius: 12px; border-top: 4px solid #28a745;">
                    <div class="card-body p-4">
                        <i class="fas fa-blog fa-2x text-success mb-3"></i>
                        <h5 class="fw-bold">Companies that blog consistently see 13× higher ROI.</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border-0 shadow text-center h-100" style="border-radius: 12px; border-top: 4px solid #17a2b8;">
                    <div class="card-body p-4">
                        <i class="fas fa-users fa-2x text-info mb-3"></i>
                        <h5 class="fw-bold">Organic leads convert 8× better than outbound ones.</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="300">
            <div class="col-12 text-center">
                <a href="{{ url('/growth-systems-discovery-call') }}" class="btn btn-primary btn-lg px-4">
                    <i class="fas fa-rocket me-2"></i>Get My SEO Growth Plan
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ===================== SEO ENGINE ===================== --}}
<section class="py-5">
    <div class="container">
        <div class="row mb-2" data-aos="fade-up">
            <div class="col-12 text-center">
                <p class="text-uppercase fw-semibold text-primary mb-1" style="letter-spacing: 1px; font-size: .9rem;">Our SEO Framework — Built for Outcomes</p>
                <h2 class="fw-bold" style="font-size: 2rem;">The Gnosys SEO Engine — Designed for Measurable Results</h2>
            </div>
        </div>
        <div class="row mb-5" data-aos="fade-up" data-aos-delay="100">
            <div class="col-12 text-center">
                <p class="text-muted" style="font-size: 1.05rem;">
                    We combine <strong>data intelligence, creative content,</strong> and <strong>technical precision</strong> to deliver growth you can measure in revenue, not vanity metrics.
                </p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                <div class="card h-100 border-0 shadow" style="border-radius: 12px; border-left: 4px solid #0a2540;">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3" style="color: #0a2540;">
                            <i class="fas fa-cogs me-2"></i>Technical SEO Excellence
                        </h4>
                        <p class="mb-2" style="font-size: 1rem;">
                            Fix what search engines see first — site speed, structure, crawl depth, Core Web Vitals.
                        </p>
                        <div class="alert alert-success mb-0">
                            <strong>→ Result:</strong> 40% faster indexing, improved SERP stability.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                <div class="card h-100 border-0 shadow" style="border-radius: 12px; border-left: 4px solid #28a745;">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3" style="color: #28a745;">
                            <i class="fas fa-brain me-2"></i>Content Intelligence
                        </h4>
                        <p class="mb-2" style="font-size: 1rem;">
                            We turn keywords into compelling narratives that rank and convert.
                        </p>
                        <div class="alert alert-success mb-0">
                            <strong>→ Result:</strong> 3× average time on page, 25% lower bounce rates.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-right" data-aos-delay="400">
                <div class="card h-100 border-0 shadow" style="border-radius: 12px; border-left: 4px solid #ffc107;">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3" style="color: #d39e00;">
                            <i class="fas fa-link me-2"></i>Authority Building & Backlinks
                        </h4>
                        <p class="mb-2" style="font-size: 1rem;">
                            Acquire contextual, high-trust backlinks through ethical digital PR and outreach.
                        </p>
                        <div class="alert alert-success mb-0">
                            <strong>→ Result:</strong> Domain Authority +25%, organic traffic surge within 90 days.
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-left" data-aos-delay="500">
                <div class="card h-100 border-0 shadow" style="border-radius: 12px; border-left: 4px solid #17a2b8;">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-3" style="color: #17a2b8;">
                            <i class="fas fa-chart-bar me-2"></i>Performance Analytics & Reporting
                        </h4>
                        <p class="mb-2" style="font-size: 1rem;">
                            Weekly dashboards that tie clicks to conversions and ROI.
                        </p>
                        <div class="alert alert-success mb-0">
                            <strong>→ Result:</strong> Full transparency, real-time performance tracking.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===================== METRICS TABLE SECTION ===================== --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-2" data-aos="fade-up">
            <div class="col-12 text-center">
                <p class="text-uppercase fw-semibold text-primary mb-1" style="letter-spacing: 1px; font-size: .9rem;">Measurable Outcomes — Our Promise</p>
                <h2 class="fw-bold" style="font-size: 2rem;">We Don't Talk Traffic — We Talk ROI.</h2>
            </div>
        </div>

        <div class="row mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-10 mx-auto">
                <div class="card border-0 shadow" style="border-radius: 12px; overflow: hidden;">
                    <table class="table table-hover mb-0" style="font-size: 1rem;">
                        <thead style="background: #0a2540; color: #fff;">
                            <tr>
                                <th class="py-3 px-4">Metric</th>
                                <th class="py-3 px-4">Our Benchmarks</th>
                                <th class="py-3 px-4">Impact</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="py-3 px-4 fw-semibold">Organic Traffic Growth</td>
                                <td class="py-3 px-4 text-primary fw-bold">250–400%</td>
                                <td class="py-3 px-4 text-muted">Within 6 months of engagement</td>
                            </tr>
                            <tr class="table-light">
                                <td class="py-3 px-4 fw-semibold">Conversion Rate Lift</td>
                                <td class="py-3 px-4 text-success fw-bold">↑ 3–5X</td>
                                <td class="py-3 px-4 text-muted">Through content and UX optimization</td>
                            </tr>
                            <tr>
                                <td class="py-3 px-4 fw-semibold">Cost Per Lead (CPL)</td>
                                <td class="py-3 px-4 text-warning fw-bold">↓ 30–40%</td>
                                <td class="py-3 px-4 text-muted">Lower vs. PPC channels</td>
                            </tr>
                            <tr class="table-light">
                                <td class="py-3 px-4 fw-semibold">Average Ranking Improvement</td>
                                <td class="py-3 px-4 text-info fw-bold">+20–30 Positions</td>
                                <td class="py-3 px-4 text-muted">Across 50+ tracked keywords</td>
                            </tr>
                            <tr>
                                <td class="py-3 px-4 fw-semibold">ROI Realization</td>
                                <td class="py-3 px-4 text-danger fw-bold">90 Days</td>
                                <td class="py-3 px-4 text-muted">Measured through sales-qualified leads</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row mb-4" data-aos="fade-up" data-aos-delay="200">
            <div class="col-lg-8 mx-auto">
                <blockquote class="blockquote text-center p-4" style="background: #fff; border-radius: 12px; border-left: 4px solid #0a2540; box-shadow: 0 2px 12px rgba(0,0,0,0.07);">
                    <p class="mb-1 fst-italic" style="font-size: 1.15rem;">
                        "If SEO doesn't move your business KPIs, it's not SEO — it's noise."
                    </p>
                    <footer class="blockquote-footer mt-1">Team Gnosys Digital</footer>
                </blockquote>
            </div>
        </div>

        <div class="row" data-aos="fade-up" data-aos-delay="300">
            <div class="col-12 text-center">
                <a href="{{ url('/growth-systems-discovery-call') }}" class="btn btn-primary btn-lg px-4">
                    <i class="fas fa-rocket me-2"></i>Get My SEO Performance Forecast →
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ===================== INDUSTRY FLOWCHART SECTION ===================== --}}
<section class="py-5">
    <div class="container">
        <div class="row mb-2" data-aos="fade-up">
            <div class="col-12 text-center">
                <p class="text-uppercase fw-semibold text-primary mb-1" style="letter-spacing: 1px; font-size: .9rem;">Industry-Focused SEO Strategies</p>
                <h2 class="fw-bold" style="font-size: 2rem;">Tailored SEO for Every Industry</h2>
            </div>
        </div>
        <div class="row mb-4" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-8 mx-auto text-center">
                <p class="text-muted" style="font-size: 1.05rem;">
                    Every business is unique — so is your search strategy. We craft vertical-specific SEO blueprints that blend industry trends with AI-powered keyword intelligence.
                </p>
            </div>
        </div>
        <div class="row mb-5" data-aos="fade-up" data-aos-delay="200">
            <div class="col-12 text-center">
                <img src="https://gnosysdigital.com/wp-content/uploads/2025/11/SEO_Services_landingPage_flowchart-e1763960805772.jpg"
                     alt="SEO Industry Flowchart"
                     class="img-fluid shadow"
                     style="border-radius: 12px; max-width: 860px; width: 100%;">
            </div>
        </div>
        <div class="row" data-aos="fade-up" data-aos-delay="300">
            <div class="col-12 text-center">
                <a href="{{ url('/category/case-study') }}" class="btn btn-primary btn-lg px-4">
                    <i class="fas fa-search me-2"></i>Explore Industry Use Cases
                </a>
            </div>
        </div>
    </div>
</section>

{{-- ===================== CLIENT RESULTS ===================== --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="row mb-2" data-aos="fade-up">
            <div class="col-12 text-center">
                <p class="text-uppercase fw-semibold text-primary mb-1" style="letter-spacing: 1px; font-size: .9rem;">Client Results That Speak Louder Than Claims</p>
                <h2 class="fw-bold" style="font-size: 2rem;">Real Clients. Real Results.</h2>
            </div>
        </div>
                
        <div class="row g-4">
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow" style="border-radius: 12px; border-top: 4px solid #0a2540;">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <i class="fas fa-shopping-cart fa-3x text-primary"></i>
                        </div>
                        <h4 class="fw-bold mb-3">E-Commerce Brand</h4>
                        <p class="text-muted mb-3">
                            400% increase in organic traffic in 5 months
                        </p>
                        <div class="alert alert-success mb-0">
                            <strong>→</strong> $180K revenue increase via SEO-only channel
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow" style="border-radius: 12px; border-top: 4px solid #28a745;">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <i class="fas fa-cloud fa-3x text-success"></i>
                        </div>
                        <h4 class="fw-bold mb-3">SaaS Client</h4>
                        <p class="text-muted mb-3">
                            120 high-intent keywords ranked in top 10
                        </p>
                        <div class="alert alert-success mb-0">
                            <strong>→</strong> 4× demo bookings within 90 days
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100 border-0 shadow" style="border-radius: 12px; border-top: 4px solid #ffc107;">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <i class="fas fa-heartbeat fa-3x text-warning"></i>
                        </div>
                        <h4 class="fw-bold mb-3">Healthcare Client</h4>
                        <p class="text-muted mb-3">
                            Local SEO optimization increased appointment bookings
                        </p>
                        <div class="alert alert-success mb-0">
                            <strong>→</strong> 55% increase in appointments
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===================== PROCESS SECTION ===================== --}}
<section class="py-5">
    <div class="container">
        <div class="row mb-2" data-aos="fade-up">
            <div class="col-12 text-center">
                <p class="text-uppercase fw-semibold text-primary mb-1" style="letter-spacing: 1px; font-size: .9rem;">How We Work — The Gnosys Growth Playbook</p>
                <h2 class="fw-bold" style="font-size: 2rem;">SEO That Starts with Data. Ends with Revenue.</h2>
            </div>
        </div>

        <div class="row g-4 mt-2">
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
                <div class="card h-100 border-0 shadow text-center" style="border-radius: 12px;">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="fas fa-search fa-3x text-primary"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Discover</h5>
                        <p class="text-muted mb-0">
                            Deep audit & competitor gap analysis
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
                <div class="card h-100 border-0 shadow text-center" style="border-radius: 12px;">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="fas fa-tasks fa-3x text-success"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Define</h5>
                        <p class="text-muted mb-0">
                            Strategy roadmap with measurable KPIs
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
                <div class="card h-100 border-0 shadow text-center" style="border-radius: 12px;">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="fas fa-rocket fa-3x text-warning"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Deploy</h5>
                        <p class="text-muted mb-0">
                            On-page, off-page, and technical rollout
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
                <div class="card h-100 border-0 shadow text-center" style="border-radius: 12px;">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <i class="fas fa-trophy fa-3x text-danger"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Deliver</h5>
                        <p class="text-muted mb-0">
                            Transparent weekly reports
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4" data-aos="fade-up" data-aos-delay="500">
            <div class="col-lg-6 mx-auto">
                <div class="card border-0 shadow text-center" style="border-radius: 12px; border-left: 4px solid #17a2b8;">
                    <div class="card-body p-4">
                        <h4 class="fw-bold mb-2" style="color: #17a2b8;">
                            <i class="fas fa-crown me-2"></i>Dominate
                        </h4>
                        <p class="text-muted mb-0">
                            Continuous optimization & authority scaling
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===================== CTA SECTION ===================== --}}
<section class="py-5" style="background: linear-gradient(135deg, #0a2540 0%, #0e3460 60%, #163d6e 100%);">
    <div class="container">
        <div class="row mb-2" data-aos="fade-up">
            <div class="col-12 text-center">
                <p class="text-uppercase fw-semibold mb-1" style="letter-spacing: 1px; font-size: .9rem; color: rgba(255,255,255,.6);">Ready to Scale Your Search Success?</p>
                <h2 class="fw-bold text-white" style="font-size: 2rem;">Let's Turn Search Into Sales</h2>
            </div>
        </div>
        <div class="row mb-5" data-aos="fade-up" data-aos-delay="100">
            <div class="col-12 text-center">
                <p class="text-white" style="font-size: 1.15rem; opacity: .85;">
                    Your customers are searching. Let's make sure they find you — and choose you.
                </p>
            </div>
        </div>
        <div class="row" data-aos="fade-up" data-aos-delay="200">
            <div class="col-12 text-center">
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ url('/free-digital-consultation') }}" class="btn btn-light btn-lg fw-semibold px-4">
                        <i class="fas fa-search me-2"></i>Request a Free SEO Audit
                    </a>
                    <a href="{{ url('/growth-systems-discovery-call') }}" class="btn btn-outline-light btn-lg fw-semibold px-4">
                        <i class="fas fa-phone me-2"></i>Schedule a Discovery Call
                    </a>
                </div>
            </div>  
        </div>
    </div>
</section>

{{-- ===================== COUNTER ANIMATION SCRIPT ===================== --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const counters = document.querySelectorAll('.counter-up');
    const speed = 200;

    const runCounter = (counter) => {
        const target = +counter.getAttribute('data-target');
        const increment = Math.ceil(target / speed);
        let current = 0;

        const update = () => {
            current += increment;
            if (current >= target) {
                counter.textContent = target;
            } else {
                counter.textContent = current;
                requestAnimationFrame(update);
            }
        };
        update();
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                runCounter(entry.target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });

    counters.forEach(counter => observer.observe(counter));
});
</script>
@endpush

@endsection
