@php
    $currentPage = 'orderCompleted';
@endphp

@include('staff.include.header')
<!---Logo Navbar Ends Here-->

<style>
    button.edit-user {
        padding: 8px;
        font-size: 15px;
        border: none;
        text-transform: uppercase;
        font-weight: 500;
        background-color: var(--color1);
        color: white;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.5s;
        width: 100%;
    }
</style>

<!--Modal Align Tasks-->
<div id="aligntask-modal" class="aligntask-modal">
    <div class="aligntask-modal-content">
        <span class="aligntask-close" onclick="closeModel('aligntask-modal');">&times;</span>
        <h2>Order Details</h2>
        <input type="hidden" id="tCode" value="">
        <div class="aligntask-containers">
            <div class="table-profile" style="padding: 0px; margin-top: 10px;">
                <table id="tables">
                    <thead>
                        <tr class="table-heading-dashboard">
                            <th>S no.</th>
                            <th>Request Date</th>
                            <th>Service Name</th>
                            <th>Address</th>
                            <th>Quantity</th>
                            <th>Rate</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="orderDetailsTableBody">
                        <!-- dynamically generated rows will be inserted here -->
                    </tbody>
                </table>
            </div>
            <h2 style="padding-top: 35px">Asigned Staffs</h2>
            <div class="table-profile" style="padding: 0px; margin-top: 10px;">
                <table id="tables">
                    <thead>
                        <tr class="table-heading-dashboard ">
                            <th>S no.</th>
                            <th>Align To</th>
                            <th>Contact number</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Remark</th>
                        </tr>
                    </thead>
                    <tbody id="asignedStaffData">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!--Modal Align Tasks-->


<!---Path-->
<div class="container path">
    <p><a href="">Home</a> > User Profile</p>
</div>
<!---Path-->
<!---User Container-->
<div class="container profile-inline">
    {{-- sidebar  --}}
    @include('staff.include.sidebar')
    {{-- sidebar end --}}

    <div class="profile-containers">
        <div class="title-profile">
            <h2>Order Complete History</h2>
        </div>

        <div class="table-profile">
            {{-- search bar --}}
            <div style="display: flex">
                <form action="{{ route('staff.orderCompleted') }}" method="GET">
                    @csrf
                    <div class="date">
                        <input type="date" name="startDate">
                        <p>To</p>
                        <input type="date" name="endDate">
                        <button class="search"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>

                <div class="date">
                    <button class="search"><a href="{{ route('staff.orderCompleted') }}"><i class="fa-solid fa-broom"></i></a></button>
                </div>

            </div>
            {{-- end search bar --}}

            <div class="overflow-tables" style="width: 100%!important; overflow-x:auto!important;">
                <table id="tables">
                    <tbody>
                        <tr class="table-heading-dashboard ">
                            <th>Date</th>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Order Details</th>
                            <th>Quantity</th>
                            {{-- <th>Per total</th>
                            <th>Total Price</th> --}}
                            <th>Payment Status</th>
                            <th>Payment Type</th>
                            <th>Details</th>

                        </tr>

                        @foreach ($assignedOrderDetails as $assignedOrderDetail)
                            <tr>
                                {{-- payment_date --}}
                                <td>{{ $assignedOrderDetail['created_at'] }}</td>
                                {{-- user_name --}}
                                <td>{{ $assignedOrderDetail['user'] }}</td>
                                {{-- user_phone --}}
                                <td>{{ $assignedOrderDetail['contact_number'] }}</td>
                                {{-- user_address --}}
                                <td>{{ $assignedOrderDetail['address'] }}</td>
                                {{-- service name --}}
                                <td>
                                    <table class="inside-td-data" style="border-collapse: collapse;">
                                        <tbody>
                                            @foreach ($assignedOrderDetail['orderDetails'] as $service)
                                                <tr>
                                                    <td>
                                                        {{ $service->service_name }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                                {{-- quantity --}}
                                <td>
                                    <table class="inside-td-data" style="border-collapse: collapse;">
                                        <tbody>
                                            @foreach ($assignedOrderDetail['orderDetails'] as $service)
                                                <tr>
                                                    <td>
                                                        {{ $service->order_quantity }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                                {{-- service per total price --}}
                                {{-- <td>
                                    <table class="inside-td-data" style="border-collapse: collapse;">
                                        <tbody>
                                            @foreach ($assignedOrderDetail['orderDetails'] as $service)
                                                <tr>
                                                    <td>
                                                        {{ $service->order_amount }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td> --}}
                                {{-- total price --}}
                                {{-- <td>{{ $assignedOrderDetail['total'] }}</td> --}}
                                {{-- payment status --}}
                                <td>{{ $assignedOrderDetail['payment_status'] }}</td>
                                {{-- payment method --}}
                                <td>{{ $assignedOrderDetail['payment_method'] }}</td>
                                {{-- action --}}
                                <td>
                                    <button class="edit-user" id="aligntaskModalBtn"
                                        onclick="shoModel('aligntask-modal','{{ $assignedOrderDetail['t_code'] }}')"
                                        style="width: 100%;">Details </button>
                                </td>

                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>


            <div class="pagination">
                <a href="#">&laquo;</a>
                <a href="#" class="active">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#">6</a>
                <a href="#">&raquo;</a>
            </div>
        </div>
    </div>

</div>
<script>
    $(document).ready(function() {
        $('.edit-user').click(function() {
            var orderTCode = $("#tCode").val();

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var formData = {
                t_code: orderTCode,
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            // extract data of order details
            $.ajax({
                url: "{{ route('admin.orderDetails') }}",
                type: "GET",
                data: formData,
                success: function(response) {
                    // console.log(response); // Check the response data in the console

                    if (response.success) {
                        var tbody = $('#orderDetailsTableBody');
                        tbody.empty(); // Clear existing content

                        $.each(response.data, function(index, order) {
                            var row = $('<tr>');
                            row.append('<td>' + order.order_date + '</td>');
                            row.append('<td>' + order.service_name + '</td>');
                            row.append('<td>' + order.service_name + '</td>');
                            row.append('<td>' + order.user_address + '</td>');
                            row.append('<td>' + order.order_quantity + '</td>');
                            row.append('<td>' + order.service_price + '</td>');
                            row.append('<td>' + order.order_amount + '</td>');

                            // ... add more columns ...

                            tbody.append(row);
                        });

                        // alert(response.message);
                    } else {
                        console.log(response.message);
                    }
                },
                error: function(response) {
                    console.log(response);
                    console.log('Something went wrong');
                }
            });

            // extract data of asigned staff details
            $.ajax({
                url: "{{ route('admin.assignedOrderStaffDetails') }}",
                type: "GET",
                data: formData,
                success: function(response) {
                    // console.log(response); // Check the response data in the console

                    if (response.success) {
                        var tbody = $('#asignedStaffData');
                        tbody.empty(); // Clear existing content

                        $.each(response.data, function(index, order) {
                            var row = $('<tr>');
                            row.append('<td>' + order.staff_id + '</td>');
                            row.append('<td>' + order.name + '</td>');
                            row.append('<td>' + order.contact_number + '</td>');
                            row.append('<td>' + order.email + '</td>');

                            if (order.status == '0') {
                                row.append('<td>' + 'cancelled ' + '</td>');
                            }
                            if (order.status == '1') {
                                row.append('<td>' + 'completed' + '</td>');
                            }
                            if (order.status == '2') {
                                row.append('<td>' + 'in process' + '</td>');
                            }
                            row.append('<td>' + order.remark + '</td>');
                            tbody.append(row);
                        });

                        // alert(response.message);
                    } else {
                        console.log(response.message);
                    }
                },
                error: function(response) {
                    console.log(response);
                    console.log('Something went wrong');
                }
            });

        });
    });
</script>
<script>
    function shoModel(tagNameId, tCode) {
        console.log(tCode);
        document.getElementById("tCode").value = tCode;
        document.getElementById(tagNameId).style.display = 'block';
    }

    function closeModel(tagNameId) {
        document.getElementById(tagNameId).style.display = 'none';
    }
</script>
@include('staff.include.footer')
