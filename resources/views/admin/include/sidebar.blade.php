<nav class="admin-dashboard-nav">
    <ul>
        <li class="logo">
            <img src="{{ asset('oxygen/resources/images/oxygen.png') }}" alt="">
        </li>

        <li style="margin-top: 20px;" class="{{ $currentPage === 'dashboard' ? 'active-nav' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="{{ $currentPage === 'dashboard' ? 'active-a' : '' }}">
                <i class="fa-solid fa-house"></i>
                <span class="nav-item">Dashboard</span>
            </a>
        </li>

        {{-- order --}}
        <li class="parent  {{ @$currentNav === 'orderList' ? 'active-nav' : '' }}">
            <a>
                <i class="fa-solid fa-cart-plus"></i>
                <span class="nav-item">Order </span>
            </a>
            <i class="fa-solid fa-chevron-down"></i>
            <ul class="drop-down-items">
                {{-- new orders --}}
                <li class="{{ $currentPage === 'order' ? 'active-nav' : '' }}">
                    <a href="{{ route('admin.orders') }}" class="{{ $currentPage === 'order' ? 'active-a' : '' }}">
                        <i class="fa-solid fa-cart-plus"></i>
                        <span class="nav-item">New Order</span>
                    </a>
                </li>
                <li class="{{ $currentPage === 'asignedOrder' ? 'active-nav' : '' }}">
                    <a href="{{ route('admin.assignedOrders') }}" class="{{ $currentPage === 'order' ? 'active-a' : '' }}">
                        <i class="fa-solid fa-cart-plus"></i>
                        <span class="nav-item">Asigned Order</span>
                    </a>
                </li>
                <li class="{{ $currentPage === 'completedOrders' ? 'active-nav' : '' }}">
                    <a href="{{ route('admin.completedOrders') }}" class="{{ $currentPage === 'completedOrders' ? 'active-a' : '' }}">
                        <i class="fa-solid fa-cart-plus"></i>
                        <span class="nav-item">Complete Order</span>
                    </a>
                </li>
                <li class="{{ $currentPage === 'asignedOrderCancel' ? 'active-nav' : '' }}">
                    <a href="{{ route('admin.asignedOrderCancel') }}" class="{{ $currentPage === 'asignedOrderCancel' ? 'active-a' : '' }}">
                        <i class="fa-solid fa-cart-plus"></i>
                        <span class="nav-item">Order Cancel by staff</span>
                    </a>
                </li>
            </ul>
        </li>
        
        {{-- user --}}
        <li class="parent  {{@$currentDiv === 'customer' ? 'active-nav' : '' }}">
            <a>
                <i class="fa-solid fa-users"></i>
                <span class="nav-item">customer </span>
            </a>
            <i class="fa-solid fa-chevron-down"></i>
            <ul class="drop-down-items">

                {{-- display Customer details --}}
                <li class="{{ $currentPage === 'customerDetail' ? 'active-nav' : '' }}">
                    <a href="{{ route('admin.customerDetail') }}"
                        class="{{ $currentPage === 'customerDetail' ? 'active-a' : '' }}">
                        <i class="fa-solid fa-users"></i>
                        <span class="nav-item">Customer Detail</span>
                    </a>
                </li>

                {{--  add Customer--}}
                <li class="{{ $currentPage === 'CustomerFormPage' ? 'active-nav' : '' }}">
                    <a href="{{ route('admin.addCustomerFormPage') }}"
                        class="{{ $currentPage === 'CustomerFormPage' ? 'active-a' : '' }}">
                        <i class="fa-solid fa-users"></i>
                        <span class="nav-item">Add Customer </span>
                    </a>
                </li>

                {{-- add Customer type --}}
                <li class="{{ $currentPage === 'userType' ? 'active-nav' : '' }}">
                    <a href="{{ route('admin.userTypeFormPage') }}"
                        class="{{ $currentPage === 'userType' ? 'active-a' : '' }}">
                        <i class="fas fa-tasks"></i>
                        <span class="nav-item">Add Customer Type</span>
                    </a>
                </li>

                {{-- display Customer type --}}
                <li class="{{ $currentPage === 'userTypeDetails' ? 'active-nav' : '' }}">
                    <a href="{{ route('admin.userTypeList') }}"
                        class="{{ $currentPage === 'userTypeDetails' ? 'active-a' : '' }}">
                        <i class="fas fa-tasks"></i>
                        <span class="nav-item">Customer Type details</span>
                    </a>
                </li>
            </ul>
        </li>

        {{-- service --}}
        <li class="parent  {{ @$currentDiv === 'service' ? 'active-nav' : '' }}">
            <a>
                <i class="fa-solid fa-cart-plus"></i>
                <span class="nav-item">Service </span>
            </a>
            <i class="fa-solid fa-chevron-down"></i>
            <ul class="drop-down-items">
                {{-- add Service --}}
                <li class="{{ $currentPage === 'serviceFormPage' ? 'active-nav' : '' }}">
                    <a href="{{ route('admin.serviceFormPage') }}" class="{{ $currentPage === 'service' ? 'active-a' : '' }}">
                        <i class="fas fa-chart-bar"></i>
                        <span class="nav-item">Add Service</span>
                    </a>
                </li>
                {{-- display service --}}
                {{-- show staff --}}
                <li class="{{ $currentPage === 'serviceDetails' ? 'active-nav' : '' }}">
                    <a href="{{ route('admin.serviceDetails') }}" class="{{ $currentPage === 'serviceDetails' ? 'active-a' : '' }}">
                        <i class="fas fa-chart-bar"></i>
                        <span class="nav-item">Service Details</span>
                    </a>
                </li>
                
            </ul>
        </li>
        
        {{-- staff --}}
        <li class="parent  {{ @$currentDiv === 'staff' ? 'active-nav' : '' }}">
            <a>
                <i class="fa-solid fa-users"></i>
                <span class="nav-item">Staff </span>
            </a>
            <i class="fa-solid fa-chevron-down"></i>
            <ul class="drop-down-items">
                {{-- add staff --}}
                <li class="{{ $currentPage === 'staffRegisterPage' ? 'active-nav' : '' }}">
                    <a href="{{ route('admin.staffRegisterPage') }}"
                        class="{{ $currentPage === 'staffRegisterPage' ? 'active-a' : '' }}">
                        <i class="fas fa-chart-bar"></i>
                        <span class="nav-item">Add Staff</span>
                    </a>
                </li>
                {{-- show staff --}}
                <li class="{{ $currentPage === 'staffDetail' ? 'active-nav' : '' }}">
                    <a href="{{ route('admin.staffDetail') }}"
                        class="{{ $currentPage === 'staffDetail' ? 'active-a' : '' }}">
                        <i class="fas fa-chart-bar"></i>
                        <span class="nav-item">Staff Details</span>
                    </a>
                </li>
                
            </ul>
        </li>


        <li>
            <a href="">
                <i class="fas fa-cog"></i>
                <span class="nav-item">Settings</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.logout') }}" class="logout">
                <i class="fas fa-sign-out-alt"></i>
                <span class="nav-item">Log out</span>
            </a>
        </li>

    </ul>
</nav>
<script>
    $(document).ready(function() {
        $('.admin-dashboard-nav ul').on('click', 'li.parent', function(event) {
            event.stopPropagation();
            // $(this).find('.fa-chevron-down').toggleClass('rotate-180');
            $(this).find('.drop-down-items').toggleClass('show');
        });

        $(document).click(function() {
            $('.admin-dashboard-nav ul li.parent .fa-chevron-down').removeClass('rotate-180');
            $('.admin-dashboard-nav ul li.parent .drop-down-items').removeClass('show');
        });
    });
</script>
