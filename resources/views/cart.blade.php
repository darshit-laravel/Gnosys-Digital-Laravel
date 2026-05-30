@extends('layouts.app')

@push('styles')
<style>
    /* ── Cart Page ── */
    .cart-page-wrapper { background: #f8fafc; padding-bottom: 80px; }

    /* Page Title */
    .cart-heading { font-size: 2rem; font-weight: 700; color: #0f172a; position: relative; display: inline-block; padding-bottom: 8px; }
    .cart-heading::after { content: ''; position: absolute; bottom: 0; left: 0; width: 48px; height: 4px; background: #2a7b9b; border-radius: 2px; }

    /* Table header labels */
    .tbl-header { font-size: 0.75rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: #94a3b8; border-bottom: 2px solid #e2e8f0; padding-bottom: 12px; }

    /* Cart item card */
    .cart-item-card { background: #fff; border-radius: 16px; border: 1px solid rgba(226,232,240,0.8); transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease; }
    .cart-item-card:hover { transform: translateY(-3px); box-shadow: 0 10px 28px rgba(15,23,42,0.07); border-color: rgba(42,123,155,0.3); }

    /* Product cover */
    .prod-cover { width: 82px; height: 82px; border-radius: 12px; overflow: hidden; flex-shrink: 0; box-shadow: 0 4px 14px rgba(0,0,0,0.1); }
    .prod-cover svg { width: 100%; height: 100%; display: block; }

    /* Title / price / desc */
    .prod-title { font-weight: 700; font-size: 1rem; color: #0f172a; text-decoration: none; transition: color 0.2s; }
    .prod-title:hover { color: #2a7b9b; }
    .prod-unit-price { font-size: 0.9rem; font-weight: 700; color: #2a7b9b; }
    .prod-desc { font-size: 0.8rem; color: #64748b; line-height: 1.55; }

    /* Qty selector */
    .qty-selector { display: inline-flex; align-items: center; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px; padding: 4px 8px; height: 40px; transition: all 0.2s; }
    .qty-selector:focus-within { border-color: #2a7b9b; box-shadow: 0 0 0 3px rgba(42,123,155,0.1); background: #fff; }
    .qty-btn { background: none; border: none; width: 26px; height: 26px; display: flex; align-items: center; justify-content: center; color: #64748b; font-size: 0.9rem; cursor: pointer; border-radius: 6px; transition: all 0.2s; padding: 0; }
    .qty-btn:hover { background: rgba(42,123,155,0.1); color: #2a7b9b; }
    .qty-input { width: 34px; text-align: center; border: none; background: transparent; font-weight: 700; color: #0f172a; font-size: 0.95rem; outline: none; }

    /* Remove button */
    .btn-remove { background: none; border: 1px solid transparent; width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #94a3b8; cursor: pointer; transition: all 0.2s; }
    .btn-remove:hover { background: #fef2f2; color: #d81313; border-color: rgba(216,19,19,0.12); }

    /* Row total */
    .row-total { font-weight: 700; font-size: 1.1rem; color: #0f172a; min-width: 80px; text-align: right; }

    /* ── Summary Card ── */
    .summary-card { background: #fff; border-radius: 20px; border: 1px solid rgba(226,232,240,0.8); box-shadow: 0 8px 28px rgba(15,23,42,0.04); padding: 28px; position: sticky; top: 160px; }
    .summary-card-title { font-size: 0.78rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: #0f172a; border-bottom: 2px solid #e2e8f0; padding-bottom: 14px; margin-bottom: 20px; }

    /* Coupon accordion */
    .coupon-toggle { background: none; border: none; width: 100%; display: flex; justify-content: space-between; align-items: center; padding: 10px 0; font-weight: 600; font-size: 0.92rem; color: #0f172a; cursor: pointer; transition: color 0.2s; }
    .coupon-toggle:hover { color: #2a7b9b; }
    .coupon-toggle .chev { font-size: 0.75rem; transition: transform 0.3s; }
    .coupon-toggle.open .chev { transform: rotate(180deg); }
    .coupon-drawer { display: none; padding-bottom: 16px; border-bottom: 1px solid #e2e8f0; }
    .coupon-msg { font-size: 0.78rem; font-weight: 600; margin-top: 8px; display: none; }

    /* Summary rows */
    .sum-row { display: flex; justify-content: space-between; align-items: center; padding: 13px 0; border-bottom: 1px solid #e2e8f0; font-size: 0.9rem; }
    .discount-row { display: none; }

    /* Grand total */
    .total-row { display: flex; justify-content: space-between; align-items: center; padding: 20px 0 22px; }
    .total-label { font-size: 1.15rem; font-weight: 700; color: #0f172a; }
    .total-amount { font-size: 1.4rem; font-weight: 700; color: #2a7b9b; }

    /* PayPal button */
    .btn-paypal { background: #FFC439; color: #003087; font-weight: 800; font-style: italic; font-size: 1rem; width: 100%; padding: 12px; border-radius: 10px; border: none; display: flex; align-items: center; justify-content: center; gap: 6px; transition: all 0.2s; box-shadow: 0 4px 14px rgba(255,196,57,0.25); }
    .btn-paypal:hover { background: #f2ba32; transform: translateY(-2px); box-shadow: 0 8px 22px rgba(255,196,57,0.4); }
    .pp-pay { color: #003087; }
    .pp-pal { color: #0079C1; }

    /* OR divider */
    .or-divider { display: flex; align-items: center; gap: 14px; color: #94a3b8; font-size: 0.72rem; font-weight: 700; letter-spacing: 1px; margin: 16px 0; }
    .or-divider::before, .or-divider::after { content: ''; flex: 1; height: 1px; background: #e2e8f0; }

    /* Checkout button */
    .btn-checkout { background: #0f172a; color: #fff !important; font-weight: 700; font-size: 0.95rem; width: 100%; padding: 14px; border-radius: 10px; border: none; display: flex; align-items: center; justify-content: center; gap: 10px; transition: all 0.3s; box-shadow: 0 4px 14px rgba(0,78,137,0.2); text-decoration: none; }
    .btn-checkout:hover { background: #003761; transform: translateY(-2px); box-shadow: 0 10px 24px rgba(0,78,137,0.35); }

    /* Trust badges */
    .trust-badges { display: flex; justify-content: center; gap: 18px; margin-top: 16px; }
    .trust-badge { font-size: 0.72rem; color: #94a3b8; font-weight: 500; display: flex; align-items: center; gap: 4px; }

    /* Empty cart */
    .empty-cart-view { display: none; text-align: center; padding: 70px 20px; background: #fff; border-radius: 20px; border: 1px solid #e2e8f0; }
    .empty-cart-icon { font-size: 3.5rem; color: #cbd5e1; margin-bottom: 18px; }

    /* Removal animation helper */
    .cart-item-card.removing { opacity: 0; transform: translateX(30px); transition: all 0.35s ease; }
</style>
@endpush


@section('content')
<div class="cart-page-wrapper section-padding">
    <div class="container">

        {{-- ── Page Title ── --}}
        <div class="row mb-5">
            <div class="col-12">
                <h1 class="cart-heading">Cart</h1>
            </div>
        </div>

        {{-- ── Main Cart Content ── --}}
        <div id="cartContent">
            <div class="row g-4">

                {{-- ── Left: Items ── --}}
                <div class="{{ $carts->isNotEmpty() ? 'col-lg-8' : 'col-lg-12' }}">

                    {{-- Table header (desktop only) --}}
                    <div class="row tbl-header px-3 d-none d-md-flex mb-2">
                        <div class="col-8">Products & Services</div>
                        <div class="col-4 text-end">Total</div>
                    </div>

                    {{-- Items list --}}
                    <div id="cartItemsList">

                        {{-- ───────── ITEM 1 ───────── --}}
                        @if ($carts->isNotEmpty())
                            @foreach ($carts as $cart)
                                <div class="cart-item-card p-3 p-md-4 mb-3" data-id="{{ encrypt($cart->product_id) }}" data-price="{{ $cart->product_price }}">
                                    <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">

                                        {{-- Left side: cover + info --}}
                                        <div class="d-flex align-items-start align-items-md-center gap-3 flex-grow-1">
                                            <div class="prod-cover">
                                                <img src="{{ $cart->product_img }}" alt="{{ $cart->product_title }}" srcset="{{ $cart->product_img . '300w' }} , {{ $cart->product_img . '150w' }}, {{ $cart->product_img . '100w' }}" sizes="80px" width="80" height="80">
                                            </div>
                                            <div>
                                                <a href="#" class="prod-title d-block mb-1">{{ $cart->product_title }}</a>
                                                <div class="prod-unit-price mb-2">${{ number_format($cart->product_price, 2) }}</div>
                                                {{-- <p class="prod-desc mb-0 d-none d-md-block">Every day, we expand and tackle new challenges together with our customers, and this book...</p> --}}
                                            </div>
                                        </div>

                                        {{-- Right side: qty + remove + total --}}
                                        <div class="d-flex align-items-center justify-content-between justify-content-md-end gap-3 flex-shrink-0">
                                            <div class="qty-selector">
                                                <button type="button" class="qty-btn btn-minus cart-item-qty-minus-btn">
                                                    <i class="fas fa-minus fa-xs"></i>
                                                </button>
                                                <input type="text" class="qty-input" value="{{ $cart->product_qty }}" readonly>
                                                <button type="button" class="qty-btn btn-plus cart-item-qty-plus-btn">
                                                    <i class="fas fa-plus fa-xs"></i>
                                                </button>
                                            </div>
                                            <button type="button" class="btn-remove cart-item-remove-btn" title="Remove item" data-id="{{ encrypt($cart->product_id) }}">
                                                <i class="far fa-trash-alt"></i>
                                            </button>
                                            <div class="row-total" data-raw="{{ $cart->product_price * $cart->product_qty }}">
                                                ${{ number_format($cart->product_price * $cart->product_qty, 2) }}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        @else
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
                        @endif

                    </div>
                </div>

                {{-- ── Right: Summary ── --}}
                <div class="{{ $carts->isNotEmpty() ? 'col-lg-4' : 'd-none' }}">
                    <div class="summary-card">
                        <div class="summary-card-title">Cart Totals</div>

                        {{-- Coupon accordion --}}
                        <div>
                            <button type="button" class="coupon-toggle" id="couponToggle">
                                <span><i class="fas fa-ticket-alt me-2 text-primary"></i>Add Coupon</span>
                                <i class="fas fa-chevron-down chev"></i>
                            </button>
                            <div class="coupon-drawer" id="couponDrawer">
                                <div class="input-group mt-2" style="border-radius:8px;overflow:hidden;">
                                    <input type="text" class="form-control" id="couponInput" placeholder="Enter coupon code" style="border-radius:8px 0 0 8px; font-size:0.875rem;">
                                    <button type="button" class="btn btn-primary px-3 fw-semibold" id="btnApplyCoupon" style="border-radius:0 8px 8px 0; font-size:0.85rem;">Apply</button>
                                </div>
                                <div class="coupon-msg" id="couponMsg"></div>
                            </div>
                        </div>

                        {{-- Shipping --}}
                        <div class="sum-row">
                            <span class="text-muted fw-semibold">Shipping</span>
                            <span class="fw-bold text-success" style="font-size:0.8rem;letter-spacing:0.5px;">FREE</span>
                        </div>

                        {{-- Discount (hidden by default) --}}
                        <div class="sum-row discount-row" id="discountRow">
                            <span class="text-muted fw-semibold">Discount (<span id="discountPct">0</span>%)</span>
                            <span class="fw-bold text-danger" id="discountVal">-$0.00</span>
                        </div>

                        {{-- Grand total --}}
                        <div class="total-row">
                            <span class="total-label">Estimated total</span>
                            <span class="total-amount" id="grandTotal">${{ $grandTotal }}</span>
                        </div>

                        {{-- PayPal --}}
                        <button type="button" class="btn-paypal mb-3">
                            Pay with&nbsp;<span class="pp-pay fw-bolder fst-italic">Pay</span><span class="pp-pal fw-bolder fst-italic">Pal</span>
                        </button>

                        {{-- OR --}}
                        <div class="or-divider">OR</div>

                        {{-- Checkout --}}
                        <a href="{{ route('checkout') }}" class="btn-checkout">
                            Proceed to Checkout &nbsp;<i class="fas fa-arrow-right fa-sm"></i>
                        </a>

                        {{-- Trust badges --}}
                        <div class="trust-badges">
                            <span class="trust-badge"><i class="fas fa-lock fa-xs"></i> Secure</span>
                            <span class="trust-badge"><i class="fas fa-shield-alt fa-xs"></i> Protected</span>
                            <span class="trust-badge"><i class="fas fa-credit-card fa-xs"></i> Encrypted</span>
                        </div>

                    </div>
                </div>{{-- /col-lg-4 --}}

            </div>
        </div>{{-- /cartContent --}}


        {{-- ── Empty Cart ── --}}
        <div class="empty-cart-view" id="emptyCartView">
            <div class="empty-cart-icon"><i class="fas fa-shopping-basket"></i></div>
            <h3 class="fw-bold mb-2" style="color:#0f172a;">Your Cart is Empty</h3>
            <p class="text-muted mb-4">You haven't added any products or services yet.</p>
            <a href="{{ url('/digital-products') }}" class="btn btn-primary px-4 py-2 fw-semibold rounded-3">
                Browse Products
            </a>
        </div>

    </div>
</div>
@endsection


@push('scripts')
<script>
$(document).ready(function () {
    // Coupon accordion
    $('#couponToggle').on('click', function () {
        $(this).toggleClass('open');
        $('#couponDrawer').slideToggle(280);
    });
});

$(document).ready(function() {
    let typingTimer;
    const doneTypingInterval = 500;

    $('.cart-item-qty-plus-btn, .cart-item-qty-minus-btn').on('click', function(e) {
        e.preventDefault();

        let $btn = $(this);

        let $card = $btn.closest('.cart-item-card');

        let productId = $card.data('id');

        let $input = $card.find('.qty-input');
        let currentQty = parseInt($input.val()) || 1;

        if ($btn.hasClass('cart-item-qty-plus-btn')) {
            currentQty += 1;
        } else if ($btn.hasClass('cart-item-qty-minus-btn')) {
            if (currentQty > 1) {
                currentQty -= 1;
            } else {
                return;
            }
        }

        $input.val(currentQty);

        clearTimeout(typingTimer);

        $card.find('.qty-btn').prop('disabled', true);

        typingTimer = setTimeout(function() {
            sendCartAjax(productId, currentQty, $card);
        }, doneTypingInterval);
    });

    function sendCartAjax(productId, qty, $card) {

        let unitPrice = parseFloat($card.data('price')) || 0;

        $.ajax({
            url: '{{ route('cart.update') }}',
            type: 'POST',
            data: {
                product_id: productId,
                quantity: qty,
            },
            success: function(response) {

                let newRowTotal = unitPrice * qty;

                $card.find('.row-total').attr('data-raw', newRowTotal);

                $card.find('.row-total').text('$' + newRowTotal.toFixed(2));

                updateGrandTotal();
            },
            error: function(xhr) {
                alert('Something went wrong updating the quantity.');
            },
            complete: function() {
                $card.find('.qty-btn').prop('disabled', false);
            }
        });
    }

    function updateGrandTotal() {
        let grandTotal = 0;

        $('.row-total').each(function() {
            let rowPrice = parseFloat($(this).attr('data-raw')) || 0;
            grandTotal += rowPrice;
        });

        if (grandTotal == '0' || grandTotal == '0.00') {
            $('#cartItemsList').html('<div class="container pt-5 d-flex justify-content-center align-items-center"><div class="col-12 col-md-8 col-lg-6 text-center p-5 bg-white rounded shadow-sm border"><div class="mb-4 text-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" fill="currentColor" class="bi bi-cart-x opacity-75" viewBox="0 0 16 16"><path d="M7.354 5.646a.5.5 0 1 0-.708.708L7.793 7.5 6.646 8.646a.5.5 0 1 0 .708.708L8.5 8.207l1.146 1.147a.5.5 0 0 0 .708-.708L9.207 7.5l1.147-1.146a.5.5 0 0 0-.708-.708L8.5 6.793 7.354 5.646z"/><path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg></div><h2 class="fw-bold text-dark mb-3">Your Cart is Empty!</h2><p class="text-muted mb-5 px-3">Looks like you haven\'t added anything to your cart yet. Discover some amazing products and start shopping.</p><a href="{{ url('/') }}" class="btn btn-primary btn-lg rounded-pill px-5 shadow-sm fw-semibold">&larr; Back to Home</a></div></div>');
        }

        $('#grandTotal').text('$' + grandTotal.toFixed(2));
    }

    $('.cart-item-remove-btn').on('click', function(e) {
        e.preventDefault();

        let $btn = $(this);
        let $card = $btn.closest('.cart-item-card');
        let productId = $btn.data('id');

        if (!confirm('Are you sure you want to remove this item from your cart?')) {
            return;
        }

        $btn.prop('disabled', true);

        $.ajax({
            url: '{{ route('cart.remove') }}',
            type: 'POST',
            data: {
                product_id: productId
            },
            success: function(response) {
                $card.fadeOut(300, function() {
                    $(this).remove();

                    $('.cart-count-badge').html(response.cart);

                    updateGrandTotal();
                });
            },
            error: function(xhr) {
                alert('Something went wrong trying to remove the item.');
                $btn.prop('disabled', false);
            }
        });
    });
});
</script>
@endpush
