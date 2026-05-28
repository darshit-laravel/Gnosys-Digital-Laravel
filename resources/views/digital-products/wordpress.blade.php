@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="products-hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="products-hero-title" data-aos="fade-up">WordPress Themes & Plugins</h1>
                <p class="products-hero-subtitle" data-aos="fade-up" data-aos-delay="100">Premium WordPress themes and plugins for professional websites</p>
            </div>
        </div>
    </div>
</section>

<!-- Products Grid Section -->
<section class="products-grid-section section-padding section-bg-light">
    <div class="container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center py-5">
                <div class="no-results-content" data-aos="fade-up">
                    <i class="fas fa-search mb-4" style="font-size: 3rem; color: var(--gnosys-blue); opacity: 0.5;"></i>
                    <h2 class="h4 mb-3">It seems we can’t find what you’re looking for.</h2>
                    <p class="text-muted">Perhaps searching can help.</p>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>

<!-- Cart Notification -->
<div id="cartNotification" class="cart-notification">
    <i class="fas fa-check-circle"></i> <span id="cartMessage">Product added to cart!</span>
</div>

<!-- Shopping Cart Sidebar -->
<div id="cartSidebar" class="cart-sidebar">
    <div class="cart-header">
        <h4><i class="fas fa-shopping-cart"></i> Shopping Cart</h4>
        <button id="closeCartBtn" class="btn-close">
            <i class="fas fa-times"></i>
        </button>
    </div>
    <div class="cart-body">
        <div id="cartItems" class="cart-items">
            <!-- Cart items will be dynamically added -->
        </div>
        <div class="cart-summary">
            <div class="cart-total">
                <span>Total: <strong id="cartTotal">$0.00</strong></span>
            </div>
            <button class="btn-gnosys w-100">
                <i class="fas fa-credit-card"></i> Checkout
            </button>
        </div>
    </div>
</div>

<!-- Cart Overlay -->
<div id="cartOverlay" class="cart-overlay"></div>

<script>
</script>

@endsection
