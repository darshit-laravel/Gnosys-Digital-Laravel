@extends('layouts.app')

@push('styles')
<style>
    .checkout-page-wrapper {
        background-color: var(--g-bg-light);
        padding-bottom: 90px;
    }

    .checkout-title-section h1 {
        font-family: var(--font-heading);
        font-weight: 700;
        color: var(--g-accent);
        position: relative;
        display: inline-block;
        padding-bottom: 8px;
    }

    .checkout-title-section h1::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 4px;
        background: var(--g-primary);
        border-radius: 2px;
    }

    .checkout-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid rgba(226, 232, 240, .8);
        box-shadow: 0 4px 15px rgba(15, 23, 42, .02);
        padding: 35px;
        margin-bottom: 30px;
    }

    .checkout-section-title {
        font-family: var(--font-heading);
        font-weight: 700;
        font-size: 1.15rem;
        color: var(--g-accent);
        margin-bottom: 22px;
    }

    .express-checkout-box {
        border: 2px dashed rgba(42, 123, 155, .25);
        background: #fcfdfe;
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 30px;
        position: relative;
    }

    .express-tag {
        position: absolute;
        top: -12px;
        left: 50%;
        transform: translateX(-50%);
        background: #fff;
        padding: 2px 16px;
        font-size: .75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
        color: var(--g-primary);
        border: 1px solid rgba(42, 123, 155, .2);
        border-radius: 20px;
    }

    .btn-paypal-express {
        background-color: #FFC439;
        color: #003087;
        font-weight: 700;
        font-style: italic;
        font-size: 1.1rem;
        width: 100%;
        max-width: 400px;
        padding: 12px;
        border-radius: 8px;
        border: none;
        transition: all .2s ease;
    }

    .btn-paypal-express:hover {
        background-color: #f2ba32;
        transform: translateY(-2px);
    }

    .paypal-bold {
        font-weight: 800;
        font-style: italic;
        color: #0079C1;
    }

    .paypal-gold {
        color: #00457C;
    }

    .divider-text-line {
        display: flex;
        align-items: center;
        margin: 25px 0;
        color: #94a3b8;
        font-size: .75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .divider-text-line::before,
    .divider-text-line::after {
        content: '';
        flex: 1;
        border-bottom: 1px solid var(--g-border);
    }

    .divider-text-line::before {
        margin-right: 15px;
    }

    .divider-text-line::after {
        margin-left: 15px;
    }

    .form-label-custom {
        font-weight: 600;
        color: var(--g-accent);
        margin-bottom: 8px;
        font-size: .9rem;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: var(--g-primary);
        box-shadow: 0 0 0 3px rgba(42, 123, 155, .1);
    }

    .toggle-link-btn {
        color: var(--g-primary);
        font-weight: 600;
        font-size: .85rem;
        cursor: pointer;
    }

    .toggle-link-btn:hover {
        color: var(--g-accent);
        text-decoration: underline;
    }

    .option-select-box {
        border: 1px solid var(--g-border);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 15px;
        cursor: pointer;
        transition: border-color .2s;
    }

    .option-select-box:hover,
    .option-select-box.active {
        border-color: var(--g-primary);
        background: rgba(42, 123, 155, .03);
    }

    .order-summary-card {
        background: #fff;
        border-radius: 20px;
        border: 1px solid rgba(226, 232, 240, .8);
        box-shadow: 0 10px 30px rgba(15, 23, 42, .03);
        padding: 30px;
        position: sticky;
        top: 160px;
    }

    .order-summary-title {
        font-family: var(--font-heading);
        font-weight: 700;
        font-size: 1.25rem;
        color: var(--g-accent);
        border-bottom: 2px solid var(--g-border);
        padding-bottom: 15px;
        margin-bottom: 20px;
    }

    .summary-product-item {
        display: flex;
        align-items: center;
        padding: 16px 0;
        border-bottom: 1px solid rgba(226, 232, 240, .5);
    }

    .summary-img-wrapper {
        position: relative;
        width: 64px;
        height: 64px;
        border-radius: 8px;
        flex-shrink: 0;
    }

    .summary-img-art {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 8px;
    }

    .summary-qty-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background-color: var(--g-accent);
        color: #fff;
        font-size: .7rem;
        font-weight: 700;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid #fff;
    }

    .summary-product-title {
        font-family: var(--font-heading);
        font-weight: 700;
        font-size: .9rem;
        color: var(--g-accent);
        margin-bottom: 2px;
        line-height: 1.3;
    }

    .summary-product-desc {
        font-size: .75rem;
        color: #64748b;
        margin-bottom: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 180px;
    }

    .checkout-coupon-toggle {
        background: none;
        border: none;
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        font-weight: 600;
        color: var(--g-accent);
        font-size: .9rem;
        border-bottom: 1px solid var(--g-border);
    }

    .checkout-cost-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 0;
        font-size: .9rem;
    }

    .checkout-cost-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 18px 0 0;
        margin-top: 10px;
        border-top: 2px solid var(--g-border);
    }

    .checkout-total-label {
        font-family: var(--font-heading);
        font-weight: 700;
        font-size: 1.15rem;
        color: var(--g-accent);
    }

    .checkout-total-val {
        font-family: var(--font-heading);
        font-weight: 700;
        font-size: 1.35rem;
        color: var(--g-primary);
    }

    .btn-complete-checkout {
        background-color: var(--g-accent);
        color: #fff !important;
        font-family: var(--font-heading);
        font-weight: 700;
        font-size: 1.1rem;
        width: 100%;
        padding: 15px;
        border-radius: 12px;
        border: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all .3s ease;
        margin-top: 30px;
        box-shadow: 0 4px 15px rgba(0, 78, 137, .2);
    }

    .btn-complete-checkout:hover {
        background-color: #003761;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 78, 137, .35);
    }

    #billing-address-section,
    #apartment-field-wrapper,
    #order-note-wrapper {
        display: none;
    }
</style>
@endpush

@section('content')
<div class="checkout-page-wrapper section-padding">
    <div class="container">

        <div class="row mb-5 checkout-title-section">
            <div class="col-12">
                <h1>Checkout</h1>
            </div>
        </div>

        @if ($carts->isEmpty())
            <div class="container pt-5 d-flex justify-content-center align-items-center">
                <div class="col-12 col-md-8 col-lg-6 text-center p-5 bg-white rounded shadow-sm border">

                    <div class="mb-4 text-secondary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-cart-x opacity-75" viewBox="0 0 16 16">
                        <path d="M7.354 5.646a.5.5 0 1 0-.708.708L7.793 7.5 6.646 8.646a.5.5 0 1 0 .708.708L8.5 8.207l1.146 1.147a.5.5 0 0 0 .708-.708L9.207 7.5l1.147-1.146a.5.5 0 0 0-.708-.708L8.5 6.793 7.354 5.646z"/>
                        <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                        </svg>
                    </div>

                    <h2 class="fw-bold text-dark mb-3">Your Cart is Empty!</h2>
                    <p class="text-muted mb-5 px-3">
                        Looks like you haven't added anything to your cart yet. Discover some amazing products and start shopping.
                    </p>

                    <a href="{{ url('/') }}" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm fw-semibold">
                        &larr; Back to Home
                    </a>

                </div>
            </div>
        @else
            <div class="checkout-form-layout">
                <form id="checkoutForm" method="POST">
                    <div class="row g-4">

                        <!-- Left: Form (col-lg-7) -->
                        <div class="col-lg-7">

                            <div class="express-checkout-box text-center">
                                <span class="express-tag">Express Checkout</span>
                                <button type="button" class="btn-paypal-express">
                                    Pay with <span class="paypal-bold">Pay</span><span class="paypal-gold">Pal</span>
                                </button>
                                <div class="divider-text-line">Or continue below</div>
                            </div>

                                <!-- Contact -->
                                <div class="checkout-card">
                                    <h3 class="checkout-section-title d-flex align-items-center gap-2">
                                        <i class="far fa-envelope text-primary"></i> Contact information
                                    </h3>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label-custom" for="first_name">First name</label>
                                            <input type="text" id="first_name" name="first_name" class="form-control" placeholder="First name" value="{{ !empty(auth()->user()) ? auth()->user()?->name : '' }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label-custom" for="last_name">Last name</label>
                                            <input type="text" id="last_name" name="last_name" class="form-control" placeholder="Last name" value="" >
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label-custom" for="email">Email address</label>
                                            <input type="email" id="email" name="email" class="form-control" placeholder="example@gmail.com" value="{{ !empty(auth()->user()) ? auth()->user()?->email : '' }}">
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label-custom" for="phone">Phone (optional)</label>
                                            <input type="text" id="phone" name="phone" class="form-control" placeholder="" value="{{ !empty(auth()->user()) ? auth()->user()?->phone : '' }}">
                                        </div>
                                    </div>

                                </div>

                                <!-- Shipping Address -->
                                <div class="checkout-card">
                                    <h3 class="checkout-section-title d-flex align-items-center gap-2">
                                        <i class="fas fa-shipping-fast text-primary"></i> Shipping address
                                    </h3>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label-custom" for="shipping_address">Address</label>
                                            <input type="text" id="shipping_address" name="shipping_address" class="form-control" placeholder="1664 The East Mall" value="{{ auth()->user()?->address?->shipping_address }}">
                                            <div class="mt-2">
                                                <span class="toggle-link-btn" id="toggleApartmentBtn">
                                                    <i class="fas fa-plus-circle me-1"></i> Add apartment, suite, etc.
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-12" id="apartment-field-wrapper">
                                            <label class="form-label-custom" for="shipping_apartment">Apartment, suite, etc. (optional)</label>
                                            <input type="text" id="shipping_apartment" name="shipping_apartment" class="form-control" placeholder="Suite 225" value="{{ auth()->user()?->address?->shipping_apartment }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label-custom" for="shipping_country">Country/Region</label>
                                            <select id="shipping_country" name="shipping_country" class="form-select">
                                                <option value="">Select country</option>
                                                @if ($countrys)
                                                    @foreach ($countrys as $country)
                                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label-custom" for="shipping_province">Province</label>
                                            <select id="shipping_province" name="shipping_province" class="form-select" >
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label-custom" for="shipping_city">City</label>
                                            <input type="text" id="shipping_city" name="shipping_city" class="form-control" placeholder="" value="{{ auth()->user()?->address?->shipping_city }}">
                                        </div>
                                        <div class="col-12 mt-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="use_same_address_for_billing" name="use_same_address_for_billing" value="1" checked style="cursor:pointer;">
                                                <label class="form-check-label fw-semibold" for="use_same_address_for_billing" style="cursor:pointer;">Use same address for billing</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Billing Address (hidden by default) -->
                                <div class="checkout-card" id="billing-address-section">
                                    <h3 class="checkout-section-title d-flex align-items-center gap-2">
                                        <i class="far fa-credit-card text-primary"></i> Billing address
                                    </h3>
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label-custom" for="billing_address">Address</label>
                                            <input type="text" id="billing_address" name="billing_address" class="form-control" placeholder="Billing Street Address" value="{{ auth()->user()?->address?->billing_address }}">
                                        </div>

                                        <div class="col-12">
                                            <label class="form-label-custom" for="billing_apartment">Apartment, suite, etc. (optional)</label>
                                            <input type="text" id="billing_apartment" name="billing_apartment" class="form-control" placeholder="Suite 225" value="{{ auth()->user()?->address?->billing_apartment }}">
                                        </div>

                                        <div class="col-md-4">
                                            <label class="form-label-custom" for="billing_country">Country/Region</label>
                                            <select id="billing_country" name="billing_country" class="form-select billing-country">
                                                <option value="">Select country</option>
                                                @if ($countrys)
                                                    @foreach ($countrys as $country)
                                                        <option value="{{ $country->id }}" {{ auth()->user()?->address?->billing_country == $country->id ? 'selected' : '' }} >{{ $country->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label-custom" for="billing_province">Province</label>
                                            <select id="billing_province" name="billing_province" class="form-select billing-province">
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label-custom" for="billing_city">City</label>
                                            <input type="text" id="billing_city" name="billing_city" class="form-control" placeholder="" value="{{ auth()->user()?->address?->billing_city }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Shipping Options -->
                                <div class="checkout-card">
                                    <h3 class="checkout-section-title d-flex align-items-center gap-2">
                                        <i class="fas fa-truck text-primary"></i> Shipping options
                                    </h3>
                                    <div class="option-select-box active d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center gap-3">
                                            <input class="form-check-input m-0" type="radio" name="shipping_option" id="ship_free" checked style="width:20px;height:20px;">
                                            <label class="fw-bold mb-0" for="ship_free" style="cursor:pointer;">Free shipping</label>
                                        </div>
                                        <span class="fw-bold text-success">FREE</span>
                                    </div>
                                </div>

                                <!-- Payment Options -->
                                <div class="checkout-card">
                                    <h3 class="checkout-section-title d-flex align-items-center gap-2">
                                        <i class="fas fa-lock text-primary"></i> Payment options
                                    </h3>
                                    <div class="option-select-box active">
                                        <div class="d-flex align-items-center gap-3">
                                            <input class="form-check-input m-0" type="radio" name="payment_option" id="pay_paypal" checked style="width:20px;height:20px;">
                                            <label class="fw-bold mb-0" for="pay_paypal" style="cursor:pointer;">
                                                PayPal <i class="fab fa-cc-paypal text-primary fa-lg ms-1"></i>
                                            </label>
                                        </div>
                                        <p class="text-muted mb-0 mt-2 ms-5" style="font-size:.85rem;">
                                            Our all-in-one checkout lets you offer PayPal, Venmo, Pay Later options and more.<br>
                                            <span class="fw-semibold">Clicking "Proceed to PayPal" will redirect you to PayPal to complete your purchase.</span>
                                        </p>
                                    </div>
                                    <div class="mt-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="add_order_note" style="cursor:pointer;">
                                            <label class="form-check-label fw-semibold" for="add_order_note" style="cursor:pointer;font-size:.9rem;">Add a note to your order</label>
                                        </div>
                                    </div>
                                    <div class="mt-3" id="order-note-wrapper">
                                        <textarea id="order_notes" class="form-control" rows="3" placeholder="Notes about your order, e.g. special delivery instructions."></textarea>
                                    </div>
                                </div>

                                <p class="text-muted" style="font-size:.85rem;font-weight:500;">
                                    By proceeding you agree to our
                                    <a href="{{ route('privacy-policy') }}" class="text-decoration-underline text-primary fw-semibold">Terms and Conditions</a> and
                                    <a href="{{ route('privacy-policy') }}" class="text-decoration-underline text-primary fw-semibold">Privacy Policy</a>.
                                </p>

                                <button type="submit" class="btn-complete-checkout">
                                    Proceed to PayPal <i class="fas fa-lock"></i>
                                </button>

                        </div>

                        <!-- Right: Order Summary -->
                        <div class="col-lg-5">
                            <div class="order-summary-card">
                                <h2 class="order-summary-title">Order summary</h2>

                                <div class="summary-products-list">

                                    @if ($carts->isNotEmpty())
                                        @foreach ($carts as $key => $cart)
                                            <!-- Product 1 -->
                                            <div class="summary-product-item">
                                                <input type="hidden" name="order_product_id[{{ $key }}]" class="order-product-id" value="{{ encrypt($cart->product_id) }}">
                                                <div class="summary-img-wrapper">
                                                    <img src="{{ $cart->product_img }}" alt="{{ $cart->product_title }}" srcset="{{ $cart->product_img . ' 300w' }}, {{ $cart->product_img . ' 150w' }} , {{ $cart->product_img . ' 100w' }}" sizes="80px" width="80" height="80">
                                                    <span class="summary-qty-badge">
                                                        <input type="hidden" name="order_product_qty[{{ $key }}]" class="order-product-qty" value="{{ $cart->product_qty }}">
                                                        {{ $cart->product_qty }}
                                                    </span>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <input type="hidden" name="order_product_title[{{ $key }}]" class="order-product-title" value="{{ $cart->product_title }}">
                                                    <h4 class="summary-product-title">
                                                        {{ $cart->product_title }}
                                                    </h4>
                                                    <div class="text-muted" style="font-size:.8rem;">
                                                        <input type="hidden" name="order_product_price[{{ $key }}]" class="order-product-price" value="{{ $cart->product_price }}">
                                                        ${{ number_format($cart->product_price, 2) }}
                                                    </div>
                                                    {{-- <p class="summary-product-desc">Every day, we expand and tackle new challenges together...</p> --}}
                                                </div>
                                                <div class="fw-bold ms-2" style="font-size:.95rem;min-width:70px;text-align:right;">
                                                    <input type="hidden" name="order_product_total_amount[{{ $key }}]" class="order-product-total-amount" value="{{ $cart->product_qty * $cart->product_price }}">
                                                    ${{ number_format($cart->product_qty * $cart->product_price, 2) }}
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif

                                </div>

                                <!-- Coupon Drawer -->
                                <div>
                                    <button type="button" class="checkout-coupon-toggle" id="checkoutCouponBtn">
                                        <span><i class="fas fa-ticket-alt me-2 text-primary"></i> Add coupons</span>
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                    <div id="checkoutCouponDrawer" style="display:none;padding:15px 0;border-bottom:1px solid var(--g-border);">
                                        <div class="d-flex gap-2">
                                            <input type="text" class="form-control" id="checkoutCouponInput" placeholder="Coupon code" style="border-radius:8px;font-size:.85rem;">
                                            <button type="button" class="btn btn-primary px-3" id="btnApplyCheckoutCoupon" style="border-radius:8px;font-weight:600;font-size:.8rem;">Apply</button>
                                        </div>
                                        <div id="checkoutCouponMsg" style="font-size:.75rem;"></div>
                                    </div>
                                </div>

                                <!-- Cost breakdown -->
                                <div class="checkout-cost-row mt-3">
                                    <span class="text-muted fw-semibold">Subtotal</span>
                                    <span class="fw-bold" id="checkout-subtotal-val">${{ number_format($grandTotal, 2) }}</span>
                                </div>
                                <div class="checkout-cost-row" id="checkout-discount-row" style="display:none!important;">
                                    <span class="text-muted fw-semibold">Discount (<span id="checkout-discount-percent">0</span>%)</span>
                                    <span class="fw-bold text-danger" id="checkout-discount-val">-$0.00</span>
                                </div>
                                <div class="checkout-cost-row pb-2">
                                    <span class="text-muted fw-semibold">Free shipping</span>
                                    <span class="fw-bold text-success text-uppercase" style="font-size:.8rem;">Free</span>
                                </div>
                                <div class="checkout-cost-total">
                                    <span class="checkout-total-label">Estimated total</span>
                                    <span class="checkout-total-val" id="checkout-total-val">
                                        <input type="hidden" name="order_product_grand_total" class="order-product-grand-total" value="{{ $grandTotal }}">
                                        ${{ number_format($grandTotal, 2) }}
                                    </span>
                                </div>

                            </div>
                        </div>

                    </div>
                </form>
            </div>
        @endif

    </div>
</div>

<!-- Order Success Modal -->
<div class="modal fade" id="orderSuccessModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-success text-white border-0 py-4 justify-content-center flex-column text-center">
                <div class="mb-2" style="font-size:3rem;"><i class="far fa-check-circle"></i></div>
                <h4 class="modal-title fw-bold text-white" style="font-family:var(--font-heading);">Order Placed Successfully!</h4>
            </div>

            <div class="modal-body text-center p-5">
                <p class="text-muted mb-4">Thank you for your order! Your purchase of <strong>Gnosys Digital</strong> services has been processed successfully.</p>
                <div class="p-3 bg-light rounded-3 mb-4 text-start">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Transaction ID:</span>
                        <strong id="order-transaction-id"></strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Total Paid:</span>
                        <strong class="text-success" id="order-grand-total">$0</strong>
                    </div>
                </div>
                <a href="{{ url('/') }}" class="btn btn-success px-4 py-2 rounded-3 fw-semibold" style="font-family:var(--font-heading);">Return to Homepage</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {

        $('#shipping_country').select2();
        $('#shipping_province').select2();

        var shippingCountryID =  '{{ auth()->user()?->address?->shipping_country }}';
        var shippingProvinceID =  '{{ auth()->user()?->address?->shipping_province }}';

        $('#shipping_country').on('change', function() {

            var countryId = $(this).val();
            var shippingProvinceDropdown = $('#shipping_province');

            shippingProvinceDropdown.empty().append('<option value="" selected disabled>Loading...</option>');

            shippingProvinceDropdown.trigger('change');

            if(countryId) {
                $.ajax({
                    url: '{{ route('get.states') }}',
                    type: 'POST',
                    data: {
                        id: countryId
                    },
                    success: function(response) {
                        shippingProvinceDropdown.empty();
                        shippingProvinceDropdown.append('<option value="" selected disabled>Select Province/State</option>');

                        if(response.status === 'success') {
                            $.each(response.states, function(key, state) {
                                var selected = shippingProvinceID == state.id ? 'selected' : '';
                                shippingProvinceDropdown.append('<option value="' + state.id + '" data-id="' + state.id + '" '+selected+' >' + state.name + '</option>');
                            });
                        }

                        shippingProvinceDropdown.trigger('change');
                    },
                    error: function() {
                        alert('Could not fetch states. Please try again.');
                        shippingProvinceDropdown.empty().append('<option value="" selected disabled>Error loading states</option>');
                        shippingProvinceDropdown.trigger('change');
                    }
                });
            } else {
                shippingProvinceDropdown.empty().append('<option value="" selected disabled>Select Country First</option>');
                shippingProvinceDropdown.trigger('change');
            }
        });

        if (shippingCountryID && shippingProvinceID) {
            $('#shipping_country').val(shippingCountryID).trigger('change');
        }

        $('#billing_country').select2();
        $('#billing_province').select2();

        var billingCountryID =  '{{ auth()->user()?->address?->billing_country }}';
        var billingProvinceID =  '{{ auth()->user()?->address?->billing_province }}';

        $('#billing_country').on('change', function() {
            var countryId = $(this).val();
            var billingProvinceDropdown = $('#billing_province');

            billingProvinceDropdown.empty().append('<option value="" selected disabled>Loading...</option>');

            billingProvinceDropdown.trigger('change');

            if(countryId) {
                $.ajax({
                    url: '{{ route('get.states') }}',
                    type: 'POST',
                    data: {
                        id: countryId
                    },
                    success: function(response) {
                        billingProvinceDropdown.empty();
                        billingProvinceDropdown.append('<option value="" selected disabled>Select Province/State</option>');

                        if(response.status === 'success') {
                            $.each(response.states, function(key, state) {
                                var selected = billingProvinceID == state.id ? 'selected' : '';
                                billingProvinceDropdown.append('<option value="' + state.id + '" data-id="' + state.id + '" '+selected+' >' + state.name + '</option>');
                            });
                        }

                        billingProvinceDropdown.trigger('change');
                    },
                    error: function() {
                        alert('Could not fetch states. Please try again.');
                        billingProvinceDropdown.empty().append('<option value="" selected disabled>Error loading states</option>');
                        billingProvinceDropdown.trigger('change');
                    }
                });
            } else {
                billingProvinceDropdown.empty().append('<option value="" selected disabled>Select Country First</option>');
                billingProvinceDropdown.trigger('change');
            }
        });

        if (billingCountryID && billingProvinceID) {
            $('#billing_country').val(billingCountryID).trigger('change');
        }

        $('#toggleApartmentBtn').on('click', function() {
            $('#apartment-field-wrapper').slideDown(300);
            $(this).parent().fadeOut(200);
        });
        $('#use_same_address_for_billing').on('change', function() {
            if ($(this).is(':checked')) {
                $('#billing-address-section').slideUp(300);
                $('#billing-address-section').find('input,select').prop('', false);
            } else {
                $('#billing-address-section').slideDown(300);
                $('#billing_firstname,#billing_lastname,#billing_address,#billing_city,#billing_postalcode').prop('', true);
            }
        });
        $('#add_order_note').on('change', function() {
            $('#order-note-wrapper').slideToggle(300);
        });
        $('#checkoutCouponBtn').on('click', function() {
            $('#checkoutCouponDrawer').slideToggle(300);
        });

        // $('#checkoutForm').on('submit', function(e) {
        //     e.preventDefault();
        //     $('#modal-total-paid').text($('#checkout-total-val').text());
        //     new bootstrap.Modal(document.getElementById('orderSuccessModal')).show();
        // });

        $('.btn-paypal-express').on('click', function() {
            $('#modal-total-paid').text($('#checkout-total-val').text());
            new bootstrap.Modal(document.getElementById('orderSuccessModal')).show();
        });

        // Toggle Billing Address Section visibility based on checkbox status
        $('#use_same_address_for_billing').on('change', function() {
            if ($(this).is(':checked')) {
                $('#billing-address-section').slideUp();
                // Clear any lingering billing validation errors when hidden
                validator.resetForm();
            } else {
                $('#billing-address-section').slideDown();
            }
        });

        var validator = $("#checkoutForm").validate({
            rules: {
                email: {
                    required : true,
                    email: true
                },
                shipping_country: {
                    required : true
                },
                first_name: {
                    required : true,
                    minlength: 2
                },
                last_name: {
                    required : false,
                    minlength: 2
                },
                shipping_address: {
                    required : true
                },
                shipping_city: {
                    required : true
                },
                shipping_province: {
                    required : true
                },
                shipping_postal_code: {
                    required : true
                },
                billing_country: {
                    required : {
                        depends: function(element) {
                            return !$("#use_same_address_for_billing").is(":checked");
                        }
                    }
                },
                billing_address: {
                    required : {
                        depends: function(element) {
                            return !$("#use_same_address_for_billing").is(":checked");
                        }
                    }
                },
                billing_city: {
                    required : {
                        depends: function(element) {
                            return !$("#use_same_address_for_billing").is(":checked");
                        }
                    }
                },
                billing_province: {
                    required : {
                        depends: function(element) {
                            return !$("#use_same_address_for_billing").is(":checked");
                        }
                    }
                },
            },
            messages: {
                email: {
                    required : "Please enter your email address",
                    email: "Please enter a valid email address"
                },
                first_name: "first name is required.",
                last_name: "last name is required.",
                shipping_address: "Shipping address is required.",
                shipping_city: "Shipping city is required.",
                shipping_province: "Shipping province is required.",
                shipping_country: "Please select a shipping country",

                billing_address: "Billing address is required.",
                billing_city: "Billing city is required.",
                billing_province: "Billing province is required.",
                billing_country: "Please select a billing country"
            },
            errorElement: 'div',
            errorClass: 'invalid-feedback',
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid').removeClass('is-valid');

                if ($(element).hasClass('select2-hidden-accessible')) {
                    $(element).next('.select2-container').find('.select2-selection').addClass('border border-danger');
                }
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid').addClass('is-valid');

                if ($(element).hasClass('select2-hidden-accessible')) {
                    $(element).next('.select2-container').find('.select2-selection').removeClass('border border-danger');
                }
            },
            errorPlacement: function(error, element) {
                if (element.hasClass('select2-hidden-accessible')) {
                    error.insertAfter(element.next('.select2-container'));
                } else if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {
                let submitBtn = $(form).find('button[type="submit"]');
                let originalBtnText = submitBtn.html();

                $.ajax({
                    url: '{{ route('orders.store') }}',
                    type: 'POST',
                    data: $(form).serialize(),
                    beforeSend: function() {
                        submitBtn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Processing...');
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            form.reset();

                            $('#orderSuccessModal').modal('show');

                            $('#order-transaction-id').text(response.data.transection_id);

                            $('#order-grand-total').text(`$${response.data.order_grand_total}`);

                            $('.cart-count-badge').html('0');

                            $('.checkout-form-layout').empty().html('<div class="container pt-5 d-flex justify-content-center align-items-center"><div class="col-12 col-md-8 col-lg-6 text-center p-5 bg-white rounded shadow-sm border"><div class="mb-4 text-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-cart-x opacity-75" viewBox="0 0 16 16"><path d="M7.354 5.646a.5.5 0 1 0-.708.708L7.793 7.5 6.646 8.646a.5.5 0 1 0 .708.708L8.5 8.207l1.146 1.147a.5.5 0 0 0 .708-.708L9.207 7.5l1.147-1.146a.5.5 0 0 0-.708-.708L8.5 6.793 7.354 5.646z"/><path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg></div><h2 class="fw-bold text-dark mb-3">Your Cart is Empty!</h2><p class="text-muted mb-5 px-3">Looks like you haven\'t added anything to your cart yet. Discover some amazing products and start shopping.</p><a href="{{ url('/') }}" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm fw-semibold">&larr; Back to Home</a></div></div>');

                            // $('#orderSuccessModal .order-id-display').text(response.order_number);
                        }
                    },
                    error: function(xhr) {
                        alert('Something went wrong: ' + xhr.responseJSON.message);
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).html(originalBtnText);
                    }
                });
            }
        });

    });
</script>
@endpush
