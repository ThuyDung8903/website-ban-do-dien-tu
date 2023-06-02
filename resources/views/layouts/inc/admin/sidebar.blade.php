@php use Illuminate\Support\Facades\Auth; @endphp
<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion" id="accordionSidenav">
                <!-- Sidenav Menu Heading (Account)-->
                <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                <div class="sidenav-menu-heading d-sm-none">Account</div>
                <!-- Sidenav Link (Alerts)-->
                <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                <a class="nav-link d-sm-none" href="#!">
                    <div class="nav-link-icon"><i data-feather="bell"></i></div>
                    Alerts
                    <span class="badge bg-warning-soft text-warning ms-auto">4 New!</span>
                </a>
                <!-- Sidenav Link (Messages)-->
                <!-- * * Note: * * Visible only on and above the sm breakpoint-->
                <a class="nav-link d-sm-none" href="#!">
                    <div class="nav-link-icon"><i data-feather="mail"></i></div>
                    Messages
                    <span class="badge bg-success-soft text-success ms-auto">2 New!</span>
                </a>
                <!-- Sidenav Menu Heading (Home)-->
                <div class="sidenav-menu-heading">Home</div>
                <!-- Sidenav Accordion (Dashboard)-->
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <div class="nav-link-icon"><i data-feather="activity"></i></div>
                    Dashboard
                </a>
                <!-- Sidenav Heading (Applications)-->
                <div class="sidenav-menu-heading">Applications</div>
                <!-- Sidenav Accordion (Profile)-->
                <a class="nav-link" href="{{ route('admin.account.profile') }}">
                    <div class="nav-link-icon"><i data-feather="user"></i></div>
                    My profile
                </a>
                <!-- Sidenav Accordion (User Management)-->
                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                        data-bs-target="#appsCollapseUserManagement" aria-expanded="false"
                        aria-controls="appsCollapseUserManagement">
                    <div class="nav-link-icon"><i data-feather="users"></i></div>
                    User Management
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="appsCollapseUserManagement"
                        data-bs-parent="#accordionSidenavAppsMenu">
                    <nav class="sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.user.add') }}">Add User</a>
                        <a class="nav-link" href="{{ route('admin.user.list') }}">Users List</a>
                    </nav>
                </div>
                <!-- Sidenav Accordion (Customer Management)-->
                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                        data-bs-target="#appsCollapseCustomerManagement" aria-expanded="false"
                        aria-controls="appsCollapseCustomerManagement">
                    <div class="nav-link-icon"><i data-feather="shopping-bag"></i></div>
                    Customer Management
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="appsCollapseCustomerManagement"
                        data-bs-parent="#accordionSidenavAppsMenu">
                    <nav class="sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.customer.list') }}">Customers List</a>
                    </nav>
                </div>
                <!-- Sidenav Accordion (Order Management)-->
                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                        data-bs-target="#appsCollapseOrderManagement" aria-expanded="false"
                        aria-controls="appsCollapseOrderManagement">
                    <div class="nav-link-icon"><i data-feather="box"></i></div>
                    Order Management
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="appsCollapseOrderManagement"
                        data-bs-parent="#accordionSidenavAppsMenu">
                    <nav class="sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('admin.order.list') }}">Orders List</a>
                    </nav>
                </div>
                <!-- Sidenav Accordion (Applications)-->
                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                        data-bs-target="#collapseEcommerce" aria-expanded="false" aria-controls="collapseEcommerce">
                    <div class="nav-link-icon"><i data-feather="grid"></i></div>
                    Ecommerce
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseEcommerce" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavAppsMenu">
                        <!-- Nested Sidenav Accordion (Ecommerce -> Brand Management)-->
                        <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                                data-bs-target="#appsCollapseBrand" aria-expanded="false"
                                aria-controls="appsCollapseBrand">
                            Brand
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="appsCollapseBrand"
                                data-bs-parent="#accordionSidenavAppsMenu">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.brand.add') }}">Add brand</a>
                                <a class="nav-link" href="{{ route('admin.brand.list') }}">Brands list</a>
                            </nav>
                        </div>
                    </nav>
                </div>
                <div class="collapse" id="collapseEcommerce" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavAppsMenu">
                        <!-- Nested Sidenav Accordion (Ecommerce -> Banner Management)-->
                        <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                                data-bs-target="#appsCollapseBanner" aria-expanded="false"
                                aria-controls="appsCollapseBanner">
                            Banner
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="appsCollapseBanner"
                                data-bs-parent="#accordionSidenavAppsMenu">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.banner.add') }}">Add banner</a>
                                <a class="nav-link" href="{{ route('admin.banner.list') }}">Banners list</a>
                            </nav>
                        </div>
                    </nav>
                </div>
                <div class="collapse" id="collapseEcommerce" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavAppsMenu">
                        <!-- Nested Sidenav Accordion (Ecommerce -> Category Management)-->
                        <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                                data-bs-target="#appsCollapseCategory" aria-expanded="false"
                                aria-controls="appsCollapseCategory">
                            Category
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="appsCollapseCategory"
                                data-bs-parent="#accordionSidenavAppsMenu">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.category.add') }}">Add category</a>
                                <a class="nav-link" href="{{ route('admin.category.list') }}">Categories list</a>
                            </nav>
                        </div>
                    </nav>
                </div>
                <div class="collapse" id="collapseEcommerce" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavAppsMenu">
                        <!-- Nested Sidenav Accordion (Ecommerce -> Product Management)-->
                        <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                                data-bs-target="#appsCollapseProduct" aria-expanded="false"
                                aria-controls="appsCollapseProduct">
                            Product
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="appsCollapseProduct"
                                data-bs-parent="#accordionSidenavAppsMenu">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.product.add') }}">Add Product</a>
                                <a class="nav-link" href="{{ route('admin.product.list') }}">Products List</a>
                            </nav>
                        </div>
                    </nav>
                </div>
                <div class="collapse" id="collapseEcommerce" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavAppsMenu">
                        <!-- Nested Sidenav Accordion (Ecommerce -> Product Management)-->
                        <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                                data-bs-target="#appsCollapsePaymentMethod" aria-expanded="false"
                                aria-controls="appsCollapsePaymentMethod">
                            Payment method
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="appsCollapsePaymentMethod"
                                data-bs-parent="#accordionSidenavAppsMenu">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.payment-method.add') }}">Add payment method</a>
                                <a class="nav-link" href="{{ route('admin.payment-method.list') }}">Payment methods list</a>
                            </nav>
                        </div>
                    </nav>
                </div>
                <div class="collapse" id="collapseEcommerce" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavAppsMenu">
                        <!-- Nested Sidenav Accordion (Ecommerce -> Product Management)-->
                        <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                                data-bs-target="#appsCollapseShippingMethod" aria-expanded="false"
                                aria-controls="appsCollapseShippingMethod">
                            Shipping method
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="appsCollapseShippingMethod"
                                data-bs-parent="#accordionSidenavAppsMenu">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.shipping-method.add') }}">Add shipping method</a>
                                <a class="nav-link" href="{{ route('admin.shipping-method.list') }}">Shipping methods list</a>
                            </nav>
                        </div>
                    </nav>
                </div>
                <div class="collapse" id="collapseEcommerce" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav accordion" id="accordionSidenavAppsMenu">
                        <!-- Nested Sidenav Accordion (Ecommerce -> Product Management)-->
                        <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                                data-bs-target="#appsCollapseOrderStatus" aria-expanded="false"
                                aria-controls="appsCollapseOrderStatus">
                            Order-status
                            <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="appsCollapseOrderStatus"
                                data-bs-parent="#accordionSidenavAppsMenu">
                            <nav class="sidenav-menu-nested nav">
                                <a class="nav-link" href="{{ route('admin.order-status.add') }}">Add order-status</a>
                                <a class="nav-link" href="{{ route('admin.order-status.list') }}">Order-statuses list</a>
                            </nav>
                        </div>
                    </nav>
                </div>
                <!-- Sidenav Accordion (Email)-->
                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                        data-bs-target="#collapseEmail" aria-expanded="false" aria-controls="collapseEmail">
                    <div class="nav-link-icon"><i data-feather="mail"></i></div>
                    Email
                    <div class="sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseEmail" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav">
                        <a class="nav-link" href="multi-tenant-select.html">Inbox</a>
                        <a class="nav-link" href="wizard.html">Read Mail</a>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Sidenav Footer-->
        <div class="sidenav-footer">
            <div class="sidenav-footer-content">
                <div class="sidenav-footer-subtitle">Logged in as:</div>
                <div class="sidenav-footer-title">{{ Auth::guard()->user()->username }}</div>
            </div>
        </div>
    </nav>
</div>