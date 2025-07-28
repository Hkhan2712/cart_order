<!-- Partial: Preloader -->
@include('partials.header.preloader')

<!-- Partial: Offcanvas Cart -->
@include('partials.header.cart')

<!-- Partial: Offcanvas Navigation Menu -->
@include('partials.header.nav')

<header>
    <div class="container-fluid">
        <div class="row py-3 border-bottom">
            <!-- Logo & Menu Toggler -->
            <div class="col-sm-4 col-lg-2 text-center text-sm-start d-flex gap-3 justify-content-center justify-content-md-start">
                <div class="d-flex align-items-center my-3 my-sm-0">
                    <a href="/">
                        <img src="{{ asset('images/logo/aquaterra-transparent.png') }}" alt="logo" class="img-fluid">
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <svg width="24" height="24" viewBox="0 0 24 24"><use xlink:href="#menu"></use></svg>
                </button>
            </div>

            <!-- Search Bar -->
            @include('partials.header.search')

            <!-- Main Navigation Links -->
            @include('partials.header.mainnav')

            <!-- Account, Wishlist, Cart -->
            @include('partials.header.usericons')
        </div>
    </div>
</header>