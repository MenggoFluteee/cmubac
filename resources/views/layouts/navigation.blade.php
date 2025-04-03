<ul class="sidebar-nav">

    {{-- ADMIN NAVIGATION --}}
    @if (Auth::user()->role_id === 1)
        <li class="sidebar-header">
            Administrator
        </li>
        <li class="sidebar-item">
            <a class='sidebar-link' href="{{ route('adminDashboard') }}">
                <i class="align-middle" data-lucide="home"></i> <span class="align-middle">Dashboard</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class='sidebar-link' href="{{ route('adminCollegeUnitsPage') }}">
                <i class="align-middle" data-lucide="school"></i> <span class="align-middle">Colleges, Offices, and
                    Units</span>
            </a>
        </li>


        <li class="sidebar-item">
            <a data-bs-target="#items" data-bs-toggle="collapse" class="sidebar-link collapsed" aria-expanded="false">
                <i class="align-middle" data-lucide="package-open"></i> <span class="align-middle">Items</span>
            </a>
            <ul id="items" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="">
                <li class="sidebar-item"><a class="sidebar-link" href="{{ route('adminItemCategoriesPage') }}"><i
                            class="align-middle" data-lucide="list"></i> Categories</a></li>
                <li class="sidebar-item"><a class="sidebar-link" href="{{ route('adminItemsPage') }}"><i
                            class="align-middle" data-lucide="list"></i> Items</a></li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a data-bs-target="#purchasing" data-bs-toggle="collapse" class="sidebar-link collapsed"
                aria-expanded="false">
                <i class="align-middle" data-lucide="shopping-cart"></i> <span class="align-middle">Purchasing</span>
            </a>
            <ul id="purchasing" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"
                style="">
                <li class="sidebar-item"><a class="sidebar-link" href="{{ route('adminAccountCodesPage') }}"><i
                            class="align-middle" data-lucide="binary"></i> Account Codes</a></li>

            </ul>
        </li>
        <li class="sidebar-item">
            <a class='sidebar-link' href="{{ route('adminUserManagementPage') }}">
                <i class="align-middle" data-lucide="users"></i> <span class="align-middle">User Management</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class='sidebar-link' href="{{ route('adminSettingsPage') }}">
                <i class="align-middle" data-lucide="settings"></i> <span class="align-middle">Settings</span>
            </a>
        </li>
    @endif


    {{-- BAC OFFICER NAVIGATION --}}
    @if (Auth::user()->role_id === 2)
        <li class="sidebar-header">
            BAC Officer
        </li>
        <li class="sidebar-item">
            <a class='sidebar-link' href=''>
                <i class="align-middle" data-lucide="home"></i> <span class="align-middle">Dashboard</span>
            </a>
        </li>

        {{-- <li class="sidebar-item">
            <a data-bs-target="#planning" data-bs-toggle="collapse" class="sidebar-link collapsed"
                aria-expanded="false">
                <i class="align-middle" data-lucide="folder-kanban"></i> <span class="align-middle">Planning</span>
            </a>
            <ul id="planning" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="">
                <li class="sidebar-item"><a class="sidebar-link" href=""><i class="align-middle"
                            data-lucide="file"></i> University APP</a></li>
                <li class="sidebar-item"><a class="sidebar-link" href=""><i class="align-middle"
                            data-lucide="file"></i> APP CSE</a></li>
                <li class="sidebar-item"><a class="sidebar-link" href=""><i class="align-middle"
                            data-lucide="file"></i> APP Non-CSE</a></li>
            </ul>
        </li> --}}
        <li class="sidebar-item">
            <a data-bs-target="#items" data-bs-toggle="collapse" class="sidebar-link collapsed" aria-expanded="false">
                <i class="align-middle" data-lucide="package-open"></i> <span class="align-middle">Items</span>
            </a>
            <ul id="items" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar" style="">

                <li class="sidebar-item"><a class="sidebar-link" href="{{ route('bacItemsPage') }}"><i
                            class="align-middle" data-lucide="package"></i> Items</a></li>
                <li class="sidebar-item"><a class="sidebar-link" href="{{ route('bacItemCategoriesPage') }}"><i
                            class="align-middle" data-lucide="package"></i> Item Categories</a></li>
                <li class="sidebar-item"><a class="sidebar-link" href="{{ route('bacRequestedItemsPage') }}"><i
                            class="align-middle" data-lucide="file-input"></i> Requested Items</a></li>
            </ul>
        </li>
        <li class="sidebar-item">
            <a data-bs-target="#purchasing" data-bs-toggle="collapse" class="sidebar-link collapsed"
                aria-expanded="false">
                <i class="align-middle" data-lucide="shopping-cart"></i> <span class="align-middle">Purchasing</span>
            </a>
            <ul id="purchasing" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"
                style="">
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('bacPurchaseRequestPage') }}">
                        <i class="align-middle" data-lucide="file-input"></i> Purchase Request
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('bacPPMPsPage') }}">
                        <i class="align-middle" data-lucide="file"></i><span>PPMP</span>
                        @if ($pendingPPMPsCount > 0)
                            <span class="badge bg-warning">{{ $pendingPPMPsCount }}</span>
                        @endif
                    </a>
                </li>
            </ul>
        </li>
        {{-- <li class="sidebar-item">
            <a data-bs-target="#distribution" data-bs-toggle="collapse" class="sidebar-link collapsed"
                aria-expanded="false">
                <i class="align-middle" data-lucide="file-text"></i> <span class="align-middle">Distribution</span>
            </a>
            <ul id="distribution" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"
                style="">
                <li class="sidebar-item"><a class="sidebar-link" href=""><i class="align-middle"
                            data-lucide="file"></i> By PPMP</a></li>
                <li class="sidebar-item"><a class="sidebar-link" href=""><i class="align-middle"
                            data-lucide="file"></i> By Items</a></li>

            </ul>
        </li> --}}
        {{-- <li class="sidebar-item">
            <a data-bs-target="#vendors" data-bs-toggle="collapse" class="sidebar-link collapsed"
                aria-expanded="false">
                <i class="align-middle" data-lucide="store"></i> <span class="align-middle">Vendors</span>
            </a>
            <ul id="vendors" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"
                style="">
                <li class="sidebar-item"><a class="sidebar-link" href=""><i class="align-middle"
                            data-lucide="users"></i> Suppliers</a></li>
                <li class="sidebar-item"><a class="sidebar-link" href=""><i class="align-middle"
                            data-lucide="users"></i> Bidders</a></li>

            </ul>
        </li> --}}
        {{-- <li class="sidebar-item">
            <a class='sidebar-link' href=''>
                <i class="align-middle" data-lucide="ticket"></i> <span class="align-middle">Procurements</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class='sidebar-link' href=''>
                <i class="align-middle" data-lucide="folder-output"></i> <span class="align-middle">RFQs</span>
            </a>
        </li> --}}
    @endif

    {{-- BUDGET OFFICER --}}
    @if (Auth::user()->role_id === 3)
        <li class="sidebar-header">
            Budget Officer
        </li>
        <li class="sidebar-item">
            <a class='sidebar-link' href='{{ route('budgetOfficeDashboard') }}'>
                <i class="align-middle" data-lucide="home"></i> <span class="align-middle">Dashboard</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a data-bs-target="#budgeting" data-bs-toggle="collapse" class="sidebar-link collapsed"
                aria-expanded="false">
                <i class="align-middle" data-lucide="coins"></i> <span class="align-middle">Budget Management</span>
            </a>
            <ul id="budgeting" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"
                style="">
                <li class="sidebar-item"><a class="sidebar-link"
                        href="{{ route('budgetOfficeYearlyBudgetPage') }}"><i class="align-middle"
                            data-lucide="banknote"></i> Yearly Budget</a></li>

                <li class="sidebar-item"><a class="sidebar-link"
                        href="{{ route('budgetOfficeBudgetAllocationV2Page') }}"><i class="align-middle"
                            data-lucide="hand-coins"></i> Budget Allocation</a></li>
            </ul>
        </li>

        <li class="sidebar-item">
            <a data-bs-target="#commodity" data-bs-toggle="collapse" class="sidebar-link collapsed"
                aria-expanded="false">
                <i class="align-middle" data-lucide="package-open"></i> <span class="align-middle">Commodity</span>
            </a>
            <ul id="commodity" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"
                style="">
                <li class="sidebar-item"><a class="sidebar-link"
                        href="{{ route('budgetOfficeAccountCodesPage') }}"><i class="align-middle"
                            data-lucide="binary"></i> Account Codes</a></li>

            </ul>
        </li>
        <li class="sidebar-item">
            <a data-bs-target="#purchasing" data-bs-toggle="collapse" class="sidebar-link collapsed"
                aria-expanded="false">
                <i class="align-middle" data-lucide="shopping-cart"></i> <span class="align-middle">Purchasing</span>
            </a>
            <ul id="purchasing" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"
                style="">
                <li class="sidebar-item"><a class="sidebar-link" href="{{ route('budgetPPMPsPage') }}"><i
                            class="align-middle" data-lucide="file"></i> PPMP</a></li>
                <li class="sidebar-item"><a class="sidebar-link"
                        href="{{ route('budgetOfficePurchaseRequestsPage') }}"><i class="align-middle"
                            data-lucide="file-input"></i> Purchase Request</a></li>

            </ul>
        </li>
    @endif


    {{-- END USER --}}
    @if (Auth::user()->role_id === 4)
        <li class="sidebar-header">
            End User
        </li>
        <li class="sidebar-item">
            <a class='sidebar-link' href='{{ route('userDashboard') }}'>
                <i class="align-middle" data-lucide="home"></i> <span class="align-middle">Dashboard</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class='sidebar-link' href='{{ route('userBudgetsPage') }}'>
                <i class="align-middle" data-lucide="hand-coins"></i> <span class="align-middle">Budgeting</span>
            </a>
        </li>
        <li class="sidebar-item">
            <a class='sidebar-link' href='{{ route('userRequestItemsPage') }}'>
                <i class="align-middle" data-lucide="hand-helping"></i> <span class="align-middle">Request
                    Item</span>
            </a>
        </li>

        <li class="sidebar-item">
            <a data-bs-target="#purchasing" data-bs-toggle="collapse" class="sidebar-link collapsed"
                aria-expanded="false">
                <i class="align-middle" data-lucide="shopping-cart"></i> <span class="align-middle">Purchasing</span>
            </a>
            <ul id="purchasing" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar"
                style="">
                <li class="sidebar-item"><a class="sidebar-link" href="{{ route('userPpmpsPage') }}"><i
                            class="align-middle" data-lucide="file"></i> PPMP</a></li>
                <li class="sidebar-item"><a class="sidebar-link" href="{{ route('userPrPage') }}"><i
                            class="align-middle" data-lucide="file"></i> Purchase Requests</a></li>
                <li class="sidebar-item"><a class="sidebar-link" href="{{ route('userPoPage') }}"><i
                            class="align-middle" data-lucide="file"></i> Purchase Order</a></li>

            </ul>
        </li>
    @endif


</ul>
