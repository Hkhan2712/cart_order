<div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasCart">
    <div class="offcanvas-header justify-content-center">
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <div class="order-md-last">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">Your cart</span>
            </h4>

            <!-- Loader -->
            <div id="mini-cart-loading" class="text-center py-5 d-none">
                <div class="spinner-border text-primary" role="status"></div>
            </div>

            <!-- Cart Items -->
            <ul class="list-group mb-3" id="mini-cart-items">
                
            </ul>

            <!-- Total -->
            <li class="list-group-item d-flex justify-content-between" id="mini-cart-total">
                
            </li>

            <a href="{{ route('cart.index') }}" class="w-100 btn btn-primary btn-lg mt-3">
                Continue to checkout
            </a>
        </div>
    </div>
</div>