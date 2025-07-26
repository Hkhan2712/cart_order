<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <img src="{{ asset('images/logo/aquaterra-transparent.png') }}" alt="AquaTerra Logo" class="brand-image opacity-75 shadow" />
        </a>
    </div>

    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" aria-label="Main navigation" id="navigation">
                
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-speedometer" viewBox="0 0 16 16">
                            <path d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2M3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707M2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8m9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5m.754-4.246a.39.39 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.39.39 0 0 0-.029-.518z"/>
                            <path fill-rule="evenodd" d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.95 11.95 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0"/>
                        </svg>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">QUẢN LÝ SẢN PHẨM</li>

                <li class="nav-item">
                    <a href="{{ route('admin.categories.index') }}" class="nav-link d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-bookmark" viewBox="0 0 16 16">
                            <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1z"/>
                        </svg>
                        <p>Danh mục</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.products.index') }}" class="nav-link d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                            <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2zm3.564 1.426L5.596 5 8 5.961 14.154 3.5zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464z"/>
                        </svg>
                        <p>Sản phẩm</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.reviews.index') }}" class="nav-link d-flex align-items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-star-half" viewBox="0 0 16 16">
                            <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
                        </svg>
                        <p>Đánh giá sản phẩm</p>
                    </a>
                </li>

                <li class="nav-header">ĐƠN HÀNG & GIAO HÀNG</li>

                <li class="nav-item">
                    <a href="{{ route('admin.orders.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-cart-check"></i>
                        <p>Đơn hàng</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.shippings.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-truck"></i>
                        <p>Đơn vị vận chuyển</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.inventory.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-clipboard-data"></i>
                        <p>Kho hàng</p>
                    </a>
                </li>

                <li class="nav-header">KHÁCH HÀNG & TÀI KHOẢN</li>

                <li class="nav-item">
                    <a href="{{ route('admin.users.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-people-fill"></i>
                        <p>Khách hàng</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.admins.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-shield-lock"></i>
                        <p>Quản trị viên</p>
                    </a>
                </li>

                <li class="nav-header">MARKETING</li>

                <li class="nav-item">
                    <a href="{{ route('admin.coupons.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-ticket-perforated"></i>
                        <p>Mã giảm giá</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.banners.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-image"></i>
                        <p>Banner quảng cáo</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.notifications.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-bell-fill"></i>
                        <p>Thông báo</p>
                    </a>
                </li>

                <li class="nav-header">CÀI ĐẶT HỆ THỐNG</li>

                <li class="nav-item">
                    <a href="{{ route('admin.settings.general') }}" class="nav-link">
                        <i class="nav-icon bi bi-gear-fill"></i>
                        <p>Cài đặt chung</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('admin.logs.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-journal-text"></i>
                        <p>Nhật ký hệ thống</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
