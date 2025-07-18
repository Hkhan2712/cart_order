<div class="col-sm-2 col-lg-2 text-center text-sm-end d-flex align-items-center justify-content-center justify-content-sm-end gap-2">
    <ul class="d-flex list-unstyled align-items-center mb-0">
        @auth
            <li>
                <a href="/account">
                    <svg width="24" height="24"><use xlink:href="#user"></use></svg>
                </a>
            </li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn p-0 border-0 bg-transparent">
                        <svg width="24" height="24"><use xlink:href="#logout"></use></svg>
                    </button>
                </form>
            </li>
        @else
            <li><a href="{{ route('login.form') }}" class="btn btn-primary text-uppercase me-2">Login</a></li>
            <li><a href="{{ route('register.form') }}" class="btn btn-dark text-uppercase">Register</a></li>
        @endauth
        <li>
            <a href="/wishlist" class="px-2">
                <svg width="24" height="24"><use xlink:href="#wishlist"></use></svg>
            </a>
        </li>
        <li>
            <a href="#" class="px-2" data-bs-toggle="offcanvas" data-bs-target="#offcanvasCart" aria-controls="offcanvasCart">
                <svg width="24" height="24"><use xlink:href="#shopping-bag"></use></svg>
            </a>
        </li>
    </ul>
</div>