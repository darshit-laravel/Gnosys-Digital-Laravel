@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="products-hero-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto text-center">
                <h1 class="products-hero-title" data-aos="fade-up">Digital Products</h1>
                <p class="products-hero-subtitle" data-aos="fade-up" data-aos-delay="100">Ready-to-use digital assets, templates, and tools to accelerate your business growth</p>
            </div>
        </div>
    </div>
</section>

<!-- Products Grid Section -->
<section class="products-grid-section section-padding section-bg-light">
    <div class="container">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-3">
                <div class="category-sidebar mb-5 mb-lg-0" data-aos="fade-right">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-dark text-white p-4">
                            <h5 class="mb-0"><i class="fas fa-filter me-2"></i> Categories</h5>
                        </div>
                        <div class="card-body p-0">
                            <ul class="list-group list-group-flush category-sidebar-list">
                                <a href="{{ route('digital-products') }}" class="list-group-item list-group-item-action p-3 {{ !request('category') ? 'active' : '' }}">
                                    <i class="fas fa-th-large me-2"></i> All Products
                                </a>
                                @foreach($categories as $cat)
                                <a href="{{ route('digital-products.category', $cat->slug) }}"
                                   class="list-group-item list-group-item-action p-3 {{ request()->route('slug') == $cat->slug ? 'active' : '' }}">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span><i class="fas fa-chevron-right me-2 small"></i> {{ $cat->name }}</span>
                                        <span class="badge rounded-pill bg-light text-dark">{{ $cat->products_count ?? $cat->products()->active()->count() }}</span>
                                    </div>
                                </a>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-lg-9">
                <!-- All Products Section -->
                <div id="all-products" class="category-section">
                    <div class="row text-center mb-5">
                        <div class="col-12">
                            <h2 class="section-title">
                                @if(isset($category))
                                    {{ $category->name }}
                                @else
                                    All Digital Products
                                @endif
                            </h2>
                            <p class="lead text-muted">
                                @if(isset($category))
                                    {{ $category->description ?? 'Explore our collection of ' . $category->name }}
                                @else
                                    Explore our complete collection of digital assets and tools
                                @endif
                            </p>
                        </div>
                    </div>

                    @if($products->count() > 0)
                    <div class="row g-4" id="productsGrid">
                        @foreach($products as $product)
                        <div class="col-md-6 col-lg-4 product-item" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3 + 1) * 100 }}">
                            <div class="product-card h-100 d-flex flex-column border-0 shadow-sm">
                                <div class="product-image position-relative">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->title }}" class="product-img img-fluid rounded-top" onerror="this.src='https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80'">
                                    @if($product->badge)
                                        <div class="product-badge badge bg-primary position-absolute top-0 end-0 m-3 px-3 py-2">{{ $product->badge }}</div>
                                    @endif
                                </div>
                                <div class="product-content p-4 flex-grow-1 d-flex flex-column">
                                    <h5 class="product-title mb-2">{{ $product->title }}</h5>
                                    <p class="product-description text-muted small mb-3">{{ Str::limit($product->description, 100) }}</p>
                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <div class="prices">
                                                @if($product->is_sale && $product->original_price)
                                                    <span class="text-muted text-decoration-line-through small me-2">{{ $product->formatted_original_price }}</span>
                                                    <span class="text-dark fw-bold fs-5">{{ $product->formatted_price }}</span>
                                                @else
                                                    <span class="text-dark fw-bold fs-5">{{ $product->formatted_price }}</span>
                                                @endif
                                            </div>
                                            <span class="text-muted small"><i class="fas fa-folder me-1"></i> {{ $product->categoryRelationship->name ?? $product->category }}</span>
                                        </div>
                                        <button class="btn btn-outline-dark w-100 btn-add-to-cart" data-product-id="{{ encrypt($product->id) }}" data-product-price="{{ $product->price }}" data-product-type="product">
                                            <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <div class="row text-center py-5">
                        <div class="col-12">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <p class="lead text-muted">No products found in this category.</p>
                            <a href="{{ route('digital-products') }}" class="btn btn-primary mt-3">View All Products</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.category-sidebar-list .list-group-item {
    border-left: 3px solid transparent;
    transition: all 0.3s ease;
}
.category-sidebar-list .list-group-item:hover {
    background-color: #f8f9fa;
    border-left-color: var(--gnosys-blue, #007bff);
    padding-left: 2rem !important;
}
.category-sidebar-list .list-group-item.active {
    background-color: var(--gnosys-blue, #007bff);
    border-color: var(--gnosys-blue, #007bff);
    border-left-color: #333;
    color: white;
}
.product-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
}
.product-image img {
    height: 200px;
    width: 100%;
    object-fit: cover;
}
</style>


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
// Shopping Cart System
class ShoppingCart {
    constructor() {
        this.cart = [];
        this.init();
    }

    init() {
        this.loadCart();
        this.setupEventListeners();
        this.updateCartUI();
    }

    setupEventListeners() {
        // Add to cart buttons
        document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const productId = e.target.closest('.add-to-cart-btn').dataset.productId;
                const productCard = e.target.closest('.product-card');
                const product = {
                    id: productId,
                    title: productCard.querySelector('.product-title').textContent,
                    price: productCard.querySelector('.product-price').textContent,
                    image: productCard.querySelector('.product-image img').src,
                    quantity: 1
                };
                this.addToCart(product);
            });
        });

        // Cart sidebar controls
        document.getElementById('closeCartBtn')?.addEventListener('click', () => this.closeCart());
        document.getElementById('cartOverlay')?.addEventListener('click', () => this.closeCart());

        // Shopping bag icon in navbar
        document.querySelector('.fa-shopping-bag')?.parentElement.addEventListener('click', (e) => {
            e.preventDefault();
            this.toggleCart();
        });
    }

    addToCart(product) {
        const existingItem = this.cart.find(item => item.id === product.id);

        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            this.cart.push(product);
        }

        this.saveCart();
        this.updateCartUI();
        this.showNotification(`${product.title} added to cart!`);

        // Update cart badge
        const badge = document.querySelector('.fa-shopping-bag').nextElementSibling;
        if (badge) {
            badge.textContent = this.getTotalItems();
        }

        // Change Add to Cart button to View Cart
        const button = document.querySelector(`[data-product-id="${product.id}"]`);
        if (button) {
            button.innerHTML = '<i class="fas fa-shopping-cart"></i> View Cart';
            button.classList.remove('add-to-cart-btn');
            button.classList.add('view-cart-btn');
            button.onclick = () => this.openCart();
        }
    }

    removeFromCart(productId) {
        this.cart = this.cart.filter(item => item.id !== productId);
        this.saveCart();
        this.updateCartUI();
    }

    updateQuantity(productId, quantity) {
        const item = this.cart.find(item => item.id === productId);
        if (item) {
            item.quantity = Math.max(1, quantity);
            this.saveCart();
            this.updateCartUI();
        }
    }

    getTotalItems() {
        return this.cart.reduce((total, item) => total + item.quantity, 0);
    }

    getTotalPrice() {
        return this.cart.reduce((total, item) => {
            const price = parseFloat(item.price.replace('$', ''));
            return total + (price * item.quantity);
        }, 0);
    }

    updateCartUI() {
        const cartItems = document.getElementById('cartItems');
        const cartTotal = document.getElementById('cartTotal');

        if (this.cart.length === 0) {
            cartItems.innerHTML = '<div class="empty-cart">Your cart is empty</div>';
        } else {
            cartItems.innerHTML = this.cart.map(item => `
                <div class="cart-item">
                    <img src="${item.image}" alt="${item.title}" class="cart-item-image">
                    <div class="cart-item-details">
                        <h6>${item.title}</h6>
                        <div class="cart-item-price">${item.price}</div>
                        <div class="cart-item-quantity">
                            <button class="quantity-btn" onclick="cart.updateQuantity('${item.id}', ${item.quantity - 1})">-</button>
                            <span>${item.quantity}</span>
                            <button class="quantity-btn" onclick="cart.updateQuantity('${item.id}', ${item.quantity + 1})">+</button>
                        </div>
                    </div>
                    <button class="cart-item-remove" onclick="cart.removeFromCart('${item.id}')">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            `).join('');
        }

        cartTotal.textContent = `$${this.getTotalPrice().toFixed(2)}`;
    }

    showNotification(message) {
        const notification = document.getElementById('cartNotification');
        const messageEl = document.getElementById('cartMessage');

        messageEl.textContent = message;
        notification.classList.add('show');

        setTimeout(() => {
            notification.classList.remove('show');
        }, 3000);
    }

    openCart() {
        document.getElementById('cartSidebar').classList.add('open');
        document.getElementById('cartOverlay').classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    closeCart() {
        document.getElementById('cartSidebar').classList.remove('open');
        document.getElementById('cartOverlay').classList.remove('show');
        document.body.style.overflow = '';
    }

    toggleCart() {
        const isOpen = document.getElementById('cartSidebar').classList.contains('open');
        if (isOpen) {
            this.closeCart();
        } else {
            this.openCart();
        }
    }

    saveCart() {
        localStorage.setItem('shoppingCart', JSON.stringify(this.cart));
    }

    loadCart() {
        const savedCart = localStorage.getItem('shoppingCart');
        if (savedCart) {
            this.cart = JSON.parse(savedCart);
        }
    }
}

// Category Filtering System
class CategoryFilter {
    constructor() {
        this.init();
    }

    init() {
        this.setupEventListeners();
        this.showCategoryFromHash();
    }

    setupEventListeners() {
        // Listen for hash changes
        window.addEventListener('hashchange', () => {
            this.showCategoryFromHash();
        });

        // Listen for initial page load
        document.addEventListener('DOMContentLoaded', () => {
            this.showCategoryFromHash();
        });
    }

    showCategoryFromHash() {
        const hash = window.location.hash.substring(1); // Remove # symbol

        // Hide all category sections
        document.querySelectorAll('.category-section').forEach(section => {
            section.style.display = 'none';
        });

        // Show the appropriate category
        if (hash && hash !== 'all-products') {
            const targetSection = document.getElementById(hash);
            if (targetSection) {
                targetSection.style.display = 'block';
                // Scroll to the section
                setTimeout(() => {
                    targetSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 100);
            } else {
                // If category doesn't exist, show all products
                document.getElementById('all-products').style.display = 'block';
            }
        } else {
            // Show all products by default
            document.getElementById('all-products').style.display = 'block';
        }
    }
}

// Initialize shopping cart
const cart = new ShoppingCart();

// Initialize category filter
const categoryFilter = new CategoryFilter();
</script>

@endsection
