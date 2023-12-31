<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="{{route('user_index')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Home
                    </a>
                    <a class="nav-link" href="index.html">
                        <div class="sb-nav-link-icon"><i class="fa fa-user-circle" aria-hidden="true"></i></div>
                        Admins
                    </a>
                    <a class="nav-link" href="{{ route('admin_user_list') }}">
                        <div class="sb-nav-link-icon"><i class="fa fa-users" aria-hidden="true"></i></div>
                        Users
                    </a>
                    <a class="nav-link" href="{{route('brands.index')}}">
                        <div class="sb-nav-link-icon"><i class="fa fa-list" aria-hidden="true"></i></div>
                        Brands
                    </a>
                    <a class="nav-link" href="{{route('products.index')}}">
                        <div class="sb-nav-link-icon"><i class="fa fa-archive" aria-hidden="true"></i></div>
                        Products 
                    </a>
                    <a class="nav-link" href="{{route('list_orders')}}">
                        <div class="sb-nav-link-icon"><i class="fa fa-truck" aria-hidden="true"></i></div>
                        Orders
                    </a>
                    <a class="nav-link" href="index.html">
                        <div class="sb-nav-link-icon"><i class="fa fa-tag" aria-hidden="true"></i></div>
                        Discounts
                    </a>
                    <a class="nav-link" href="index.html">
                        <div class="sb-nav-link-icon"><i class="fa fa-credit-card" aria-hidden="true"></i></div>
                        Transactions
                    </a>
                    <a class="nav-link" href="index.html">
                        <div class="sb-nav-link-icon"><i class="fa fa-link" aria-hidden="true"></i></div>
                        Visit Site
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                @guest My Account @else {{ Auth()->user()->fullname ?? 'My Account' }}
                @endguest
            </div>
        </nav>