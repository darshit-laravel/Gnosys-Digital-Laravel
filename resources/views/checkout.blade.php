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

                <form id="checkoutForm" action="#" method="POST">
                    @csrf

                    <!-- Contact -->
                    <div class="checkout-card">
                        <h3 class="checkout-section-title d-flex align-items-center gap-2">
                            <i class="far fa-envelope text-primary"></i> Contact information
                        </h3>
                        <label class="form-label-custom" for="email">Email address</label>
                        <input type="email" id="email" class="form-control" placeholder="darshit@gnosysdigital.com" value="darshit@gnosysdigital.com" required>
                    </div>

                    <!-- Shipping Address -->
                    <div class="checkout-card">
                        <h3 class="checkout-section-title d-flex align-items-center gap-2">
                            <i class="fas fa-shipping-fast text-primary"></i> Shipping address
                        </h3>
                        <div class="row g-3">
                            <div class="col-12">
                                <label class="form-label-custom" for="country">Country/Region</label>
                                <select id="country" class="form-select" required>
                                    <option value="CA" selected>Canada</option>
                                    <option value="US">United States</option>
                                    <option value="IN">India</option>
                                    <option value="GB">United Kingdom</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom" for="firstname">First name</label>
                                <input type="text" id="firstname" class="form-control" placeholder="Darshit" value="Darshit" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom" for="lastname">Last name</label>
                                <input type="text" id="lastname" class="form-control" placeholder="Ranpara" value="Ranpara" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label-custom" for="address">Address</label>
                                <input type="text" id="address" class="form-control" placeholder="1664 The East Mall" required>
                                <div class="mt-2">
                                    <span class="toggle-link-btn" id="toggleApartmentBtn">
                                        <i class="fas fa-plus-circle me-1"></i> Add apartment, suite, etc.
                                    </span>
                                </div>
                            </div>
                            <div class="col-12" id="apartment-field-wrapper">
                                <label class="form-label-custom" for="apartment">Apartment, suite, etc. (optional)</label>
                                <input type="text" id="apartment" class="form-control" placeholder="Suite 225">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom" for="city">City</label>
                                <input type="text" id="city" class="form-control" placeholder="Toronto" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom" for="province">Province</label>
                                <select id="province" class="form-select" required>
                                    <option value="ON" selected>Ontario</option>
                                    <option value="QC">Quebec</option>
                                    <option value="BC">British Columbia</option>
                                    <option value="AB">Alberta</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom" for="postalcode">Postal code</label>
                                <input type="text" id="postalcode" class="form-control" placeholder="M9B 6H2" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom" for="phone">Phone (optional)</label>
                                <input type="text" id="phone" class="form-control" placeholder="+1 647 947 9546">
                            </div>
                            <div class="col-12 mt-2">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="same_address_billing" checked style="cursor:pointer;">
                                    <label class="form-check-label fw-semibold" for="same_address_billing" style="cursor:pointer;">Use same address for billing</label>
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
                                <label class="form-label-custom" for="billing_country">Country/Region</label>
                                <select id="billing_country" class="form-select">
                                    <option value="CA" selected>Canada</option>
                                    <option value="US">United States</option>
                                    <option value="IN">India</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom" for="billing_firstname">First name</label>
                                <input type="text" id="billing_firstname" class="form-control" placeholder="First Name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom" for="billing_lastname">Last name</label>
                                <input type="text" id="billing_lastname" class="form-control" placeholder="Last Name">
                            </div>
                            <div class="col-12">
                                <label class="form-label-custom" for="billing_address">Address</label>
                                <input type="text" id="billing_address" class="form-control" placeholder="Billing Street Address">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom" for="billing_city">City</label>
                                <input type="text" id="billing_city" class="form-control" placeholder="Billing City">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom" for="billing_province">Province</label>
                                <select id="billing_province" class="form-select">
                                    <option value="ON" selected>Ontario</option>
                                    <option value="QC">Quebec</option>
                                    <option value="BC">British Columbia</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom" for="billing_postalcode">Postal code</label>
                                <input type="text" id="billing_postalcode" class="form-control" placeholder="Billing Postal Code">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label-custom" for="billing_phone">Phone (optional)</label>
                                <input type="text" id="billing_phone" class="form-control" placeholder="Phone Number">
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

                </form>
            </div>

            <!-- Right: Order Summary -->
            <div class="col-lg-5">
                <div class="order-summary-card">
                    <h2 class="order-summary-title">Order summary</h2>

                    <div class="summary-products-list">

                        <!-- Product 1 -->
                        <div class="summary-product-item">
                            <div class="summary-img-wrapper">
                                <img src="https://gnosysdigital.com/wp-content/uploads/2025/10/50.jpg" alt="How To Build Your Start-up Future" srcset="https://gnosysdigital.com/wp-content/uploads/2025/10/50.jpg 300w, https://gnosysdigital.com/wp-content/uploads/2025/10/50-150x150.jpg 150w, https://gnosysdigital.com/wp-content/uploads/2025/10/50-100x100.jpg 100w" sizes="80px" width="80" height="80">
                                <span class="summary-qty-badge">1</span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="summary-product-title">How To Build Your Start-up Future</h4>
                                <div class="text-muted" style="font-size:.8rem;">$19.99</div>
                                <p class="summary-product-desc">Every day, we expand and tackle new challenges together...</p>
                            </div>
                            <div class="fw-bold ms-2" style="font-size:.95rem;min-width:70px;text-align:right;">$39.98</div>
                        </div>

                        <!-- Product 2 -->
                        <div class="summary-product-item">
                            <div class="summary-img-wrapper">
                                <img src="https://gnosysdigital.com/wp-content/uploads/2025/10/50.jpg" alt="How To Build Your Start-up Future" srcset="https://gnosysdigital.com/wp-content/uploads/2025/10/50.jpg 300w, https://gnosysdigital.com/wp-content/uploads/2025/10/50-150x150.jpg 150w, https://gnosysdigital.com/wp-content/uploads/2025/10/50-100x100.jpg 100w" sizes="80px" width="80" height="80">
                                <span class="summary-qty-badge">1</span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="summary-product-title">Affiliate Marketing Landing Page Template</h4>
                                <div class="text-muted" style="font-size:.8rem;">$6.99</div>
                                <p class="summary-product-desc">Professionally Designed Affiliate Program Page.</p>
                            </div>
                            <div class="fw-bold ms-2" style="font-size:.95rem;min-width:70px;text-align:right;">$6.99</div>
                        </div>

                        <!-- Product 3 -->
                        <div class="summary-product-item">
                            <div class="summary-img-wrapper">
                                <img src="https://gnosysdigital.com/wp-content/uploads/2025/10/50.jpg" alt="How To Build Your Start-up Future" srcset="https://gnosysdigital.com/wp-content/uploads/2025/10/50.jpg 300w, https://gnosysdigital.com/wp-content/uploads/2025/10/50-150x150.jpg 150w, https://gnosysdigital.com/wp-content/uploads/2025/10/50-100x100.jpg 100w" sizes="80px" width="80" height="80">
                                <span class="summary-qty-badge">1</span>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h4 class="summary-product-title">30 Days Instagram Management</h4>
                                <div class="text-muted" style="font-size:.8rem;">$150.00</div>
                                <p class="summary-product-desc">What you can expect: 60 Post with proper hashtags...</p>
                            </div>
                            <div class="fw-bold ms-2" style="font-size:.95rem;min-width:70px;text-align:right;">$150.00</div>
                        </div>

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
                        <span class="fw-bold" id="checkout-subtotal-val">$196.97</span>
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
                        <span class="checkout-total-val" id="checkout-total-val">$196.97</span>
                    </div>

                </div>
            </div>

        </div>
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
                        <strong>PAY-89520489A12</strong>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Total Paid:</span>
                        <strong class="text-success" id="modal-total-paid">$196.97</strong>
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
        $('#toggleApartmentBtn').on('click', function() {
            $('#apartment-field-wrapper').slideDown(300);
            $(this).parent().fadeOut(200);
        });
        $('#same_address_billing').on('change', function() {
            if ($(this).is(':checked')) {
                $('#billing-address-section').slideUp(300);
                $('#billing-address-section').find('input,select').prop('required', false);
            } else {
                $('#billing-address-section').slideDown(300);
                $('#billing_firstname,#billing_lastname,#billing_address,#billing_city,#billing_postalcode').prop('required', true);
            }
        });
        $('#add_order_note').on('change', function() {
            $('#order-note-wrapper').slideToggle(300);
        });
        $('#checkoutCouponBtn').on('click', function() {
            $('#checkoutCouponDrawer').slideToggle(300);
        });

        $('#checkoutForm').on('submit', function(e) {
            e.preventDefault();
            $('#modal-total-paid').text($('#checkout-total-val').text());
            new bootstrap.Modal(document.getElementById('orderSuccessModal')).show();
        });

        $('.btn-paypal-express').on('click', function() {
            $('#modal-total-paid').text($('#checkout-total-val').text());
            new bootstrap.Modal(document.getElementById('orderSuccessModal')).show();
        });
    });
</script>
@endpush