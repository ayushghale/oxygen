<?php
$currentPage = 'asignedOrderCancel';
$currentNav = 'orderList';
?>
@include('admin.include.header')



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

                            <th>Assign Task</th>
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

<div class="admin-container">

    @include('admin.include.sidebar')

    <section class="main">
        <div class="main-top">
            <h1>Asigned Order Cancel</h1>
        </div>
        <div class="dashboard-container">
            <div class="table-profile">
                <table id="tables">
                    <tbody>
                        <tr class="table-heading-dashboard ">
                            <th>Date</th>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Order Details</th>
                            <th>Quantity</th>
                            <th>Service Per Total Price</th>
                            <th>Total Price</th>
                            <th>Payment Status</th>
                        </tr>

                        @foreach ($assignedOrderDetails as $assignedOrderDetail)
                            <tr>
                                {{-- payment_date --}}
                                <td>{{ $assignedOrderDetail['payment_date'] }}</td>
                                {{-- user_name --}}
                                <td>{{ $assignedOrderDetail['user_name'] }}</td>
                                {{-- user_phone --}}
                                <td>{{ $assignedOrderDetail['user_phone'] }}</td>
                                {{-- user_address --}}
                                <td>{{ $assignedOrderDetail['user_address'] }}</td>
                                {{-- service name --}}
                                <td>
                                    <table class="inside-td-data" style="border-collapse: collapse;">
                                        <tbody>
                                            @foreach ($assignedOrderDetail['serviceData'] as $service)
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
                                            @foreach ($assignedOrderDetail['serviceData'] as $service)
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
                                <td>
                                    <table class="inside-td-data" style="border-collapse: collapse;">
                                        <tbody>
                                            @foreach ($assignedOrderDetail['serviceData'] as $service)
                                                <tr>
                                                    <td>
                                                        {{ $service->order_amount }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                                {{-- total price --}}
                                <td>{{ $assignedOrderDetail['payment_amount'] }}</td>
                                {{-- payment status --}}
                                <td>
                                    <button class="edit-user" id="aligntaskModalBtn"
                                        onclick="shoModel('aligntask-modal','{{ $assignedOrderDetail['t_code'] }}')"
                                        style="width: 100%;">Assigned    Details</button>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>

            </div>

        </div>
    </section>
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

                    } else {
                        console.log(response.message);
                    }
                },
                error: function(response) {
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
                            tbody.append(row);
                        });

                        
                    } else {
                        console.log(response.message);
                    }
                },
                error: function(response) {
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
@include('admin.include.footer')
