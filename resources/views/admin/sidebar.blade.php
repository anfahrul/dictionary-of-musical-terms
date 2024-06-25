<!-- Sidebar Start -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div
        class="brand-logo d-flex align-items-center justify-content-between"
        >
        <a href="./index.html" class="text-nowrap logo-img">
            <img
            src="/images/logos/musik-pedia-logo.png"
            width="221"
            style="border-radius: 10px;"
            alt=""
            />
        </a>
        <div
            class="close-btn d-xl-none d-block sidebartoggler cursor-pointer"
            id="sidebarCollapse"
        >
            <i class="ti ti-x fs-8"></i>
        </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
        <ul id="sidebarnav">
            <li class="sidebar-item">
            <a
                class="sidebar-link {{ ($title === "Dashboard") ? 'active':'' }}"
                aria-current="page" href="/admin/dashboard"
                aria-expanded="false"
            >
                <span>
                <i class="ti ti-layout-dashboard"></i>
                </span>
                <span class="hide-menu">Dashboard</span>
            </a>
            </li>
            <li class="sidebar-item">
            <a
                class="sidebar-link {{ ($title === "Istilah") ? 'active':'' }}"
                href="/admin/terms"
                aria-expanded="false"
            >
                <span>
                <i class="ti ti-book"></i>
                </span>
                <span class="hide-menu">Istilah</span>
            </a>
            </li>
        </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!--  Sidebar End -->
