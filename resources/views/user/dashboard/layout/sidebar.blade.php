@php
$menuSections = [
[
'section' => 'Main',
'items' => [
[
'route' => url('/dashboard'),
'icon' => 'new/Monitor.png',
'title' => 'Dashboard',
'permission' => 'dashboard.view', // MISSING: Add to permissions table
],
]
],
[
'section' => 'Job Cards',
'items' => [
[
'route' => url('/jobcards'),
'icon' => 'new/Vector.png',
'title' => 'Job Card',
'permission' => 'jobcards.view'
],
[
'route' => url('/jobcards-completed'),
'icon' => 'new/Vector2.png',
'title' => 'Paid Revenue',
'permission' => 'jobcards.view'
],
[
'route' => url('/jobcards-pending'),
'icon' => 'new/Vector3.png',
'title' => 'Amount Receivables',
'permission' => 'jobcards.view'
],
]
],
[
'section' => 'Expenses Management ',
'items' => [
[
'route' => url('/expenses'),
'icon' => 'new/Monitor.png',
'title' => 'Expenses',
'permission' => 'expenses.view', // MISSING: Add to permissions table
],
[
'route' => url('/vendors'),
'icon' => 'new/Vector1.png',
'title' => 'Vendors',
'permission' => 'vendors.view'
],
]
],
[
'section' => 'Customers & Vehicles',
'items' => [
[
'route' => url('/customers'),
'icon' => 'new/Vector7.png',
'title' => 'Customers',
'permission' => 'customers.view'
],
[
'route' => url('/vehicles'),
'icon' => 'new/Vector8.png',
'title' => 'Vehicles',
'permission' => 'vehicles.view'
],
[
'route' => url('/mechanics'),
'icon' => 'new/Vector5.png',
'title' => 'Mechanics',
'permission' => 'mechanics.view'
],
]
],
[
'section' => 'Reports & Reminders',
'items' => [
[
'route' => url('/reminder'),
'icon' => 'new/HandArrowUp.png',
'title' => 'Reminders',
'permission' => 'reminders.view'
],
[
'route' => url('/revenue'),
'icon' => 'new/Vector10.png',
'title' => 'Revenue Report',
'permission' => 'revenue.view', // MISSING: Add to permissions table
],
]
],
[
'section' => 'Role & Permission',
'items' => [
[
'route' => url('/roles'),
'icon' => 'new/HandArrowUp.png',
'title' => 'Role',
'permission' => 'roles.view', // MISSING: Add to permissions table
],
[
'route' => url('/users'),
'icon' => 'new/HandArrowUp.png',
'title' => 'Permission',
'permission' => 'users.view', // MISSING: Add to permissions table
],
]
],
[
'section' => 'Inventory',
'items' => [
[
'route' => url('/inventory'),
'icon' => 'new/HandArrowUp.png',
'title' => 'Inventory',
'permission' => 'inventory.view'
],
]
],
[
'section' => 'Insurance Management',
'items' => [
[
'route' => url('/insurence'),
'icon' => 'new/HandArrowUp.png',
'title' => 'Insurance Co',
'permission' => 'insurance.view', // MISSING: Add to permissions table
],
[
'route' => url('/insurance-ro'),
'icon' => 'new/HandArrowUp.png',
'title' => 'Insurance Ro',
'permission' => 'insurance-ro.view', // MISSING: Add to permissions table
],
]
],
];

@endphp

<div class="main-sidebar sidebar-style-2 supreme-container">

    <!-- Sidebar Brand (Logo) -->
    <div class="sidebar-brand fixed-top bg-white">
        <a data-toggle="sidebar">
            <img alt="Logo" src="{{ asset('logo1.png') }}" class="header-logo logo1head" />
            <span class="logo-name">
                <img alt="Logo" src="{{ asset('logo2.png') }}" class="header-logo logo2head" />
            </span>
        </a>
    </div>

    <!-- Sidebar Menu -->
    <aside id="sidebar-wrapper" class="pt-2 mt-5">
        <ul class="sidebar-menu">
            @foreach ($menuSections as $section)
            @php
            // Filter only accessible items
            $visibleItems = collect($section['items'])->filter(function($item) {
            $permission = $item['permission'] ?? null;
            return !$permission || canAccess($permission);
            });
            @endphp

            @if($visibleItems->isNotEmpty())
            <li class="sidebar-section" data-toggle="tooltip" data-placement="right" title="{{ $section['section'] }}">
                <span class="section-title">{{ $section['section'] }}</span>
            </li>

            @foreach ($visibleItems as $item)
            <li class="sidebar-item {{ isset($item['subItems']) ? 'has-sub' : '' }}">
                <a class="nav-link" href="{{ $item['route'] }}">
                    <img src="{{ asset($item['icon']) }}" class="icon-size" alt="{{ $item['title'] }}">
                    <span>&nbsp; {{ translate(ucwords($item['title'])) }}</span>
                    @if(isset($item['subItems']))
                    <i class="fa fa-chevron-down float-right"></i>
                    @endif
                </a>

                @if(isset($item['subItems']))
                @php
                $visibleSubItems = collect($item['subItems'])->filter(function($sub) {
                $subPermission = $sub['permission'] ?? null;
                return !$subPermission || canAccess($subPermission);
                });
                @endphp

                @if($visibleSubItems->isNotEmpty())
                <ul class="submenu">
                    @foreach($visibleSubItems as $sub)
                    <li>
                        <a href="{{ $sub['route'] }}">
                            @if(isset($sub['icon']))
                            <img src="{{ asset($sub['icon']) }}" class="icon-size" alt="{{ $sub['title'] }}">
                            @endif
                            <span>{{ $sub['title'] }}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
                @endif
                @endif
            </li>
            @endforeach
            @endif
            @endforeach

        </ul>
    </aside>
</div>

<!-- Scripts -->
<script>
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();

        // Sidebar dropdown
        $('.has-sub > .nav-link').click(function(e) {
            e.preventDefault();
            $(this).next('.submenu').slideToggle();
            $(this).find('i.fa-chevron-down').toggleClass('rotate');
        });

        // Highlight current page
        var currentUrl = window.location.href;
        $('.sidebar-menu li a').each(function() {
            if (this.href === currentUrl) {
                $(this).closest('li').css('background-color', '#41454E');
                $(this).parents('.submenu').show();
            }
        });
    });
</script>

<!-- Styles -->
<style>
    .scrollable-sidebar {
        height: 95vh;
        overflow-y: auto;
    }

    .scrollable-sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .scrollable-sidebar::-webkit-scrollbar-thumb {
        background-color: #6c757d;
        border-radius: 10px;
    }

    .main-sidebar {
        position: fixed;
        width: 250px;
        top: 0;
        left: 0;
        background-color: #2c2f3c;
        color: #fff;
    }

    .sidebar-mini .main-sidebar {
        width: 60px !important;
    }

    .sidebar-mini .sidebar-item>a span,
    .sidebar-mini .sidebar-section .section-title {
        display: none;
    }

    .sidebar-mini .sidebar-item>a {
        justify-content: center;
    }

    .sidebar-mini .sidebar-item .submenu {
        position: absolute;
        left: 60px;
        top: 0;
        background-color: #2c2f3c;
        min-width: 200px;
        display: none;
        z-index: 999;
    }

    .sidebar-mini .sidebar-item:hover .submenu {
        display: block;
    }

    .main-sidebar .sidebar-brand {
        padding: 15px !important;
        background-color: #FFF !important;
    }

    .sidebar-item .submenu {
        display: none;
        list-style: none;
        padding-left: 20px;
    }

    .sidebar-item .submenu li a {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 13px;
        color: #fff;
        padding: 5px 0;
        text-decoration: none;
    }

    .sidebar-item .submenu li a:hover {
        color: #00bfff;
    }

    .rotate {
        transform: rotate(90deg);
        transition: 0.3s;
    }

    .icon-size {
        width: 20px;
        height: 20px;
    }

    .sidebar-section .section-title {
        display: block;
        padding: 10px 15px;
        font-size: 14px;
        font-weight: bold;
        text-transform: uppercase;
        color: #aaa;
        border-bottom: 1px solid #3a3d4e;
        margin-top: 10px;
    }

    .sidebar-item>a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 15px;
        color: #fff;
        text-decoration: none;
    }

    .sidebar-item>a:hover {
        background-color: #41454E;
    }
</style>