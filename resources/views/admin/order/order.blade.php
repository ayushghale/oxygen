<?php
$currentPage = 'order';
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
            <h2 style="padding-top: 25px">Staff Details</h2>
            <div class="assign-search">
                <input type="text" placeholder="Search By Name or Number..">
                <button class="profile-button">Search</button>
            </div>
            <div class="table-profile" style="padding: 0px; margin-top: 10px;">
                <table id="tables">
                    <thead>
                        <tr class="table-heading-dashboard ">
                            <th>S no.</th>
                            <th>Align To</th>
                            <th>Contact number</th>
                            <th>Address</th>
                            <th>Remark</th>
                            <th>Assign Task</th>
                            
                        </tr>
                    </thead>
                    <?php
                    $i = 1;
                    ?>
                    <tbody>
                        @foreach ($stafDetails as $stafDetail)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $stafDetail->name }}</td>
                                <td>{{ $stafDetail->contact_number }}</td>
                                <td>{{ $stafDetail->email }}</td>
                                <td><input type="text" placeholder="Write Remark" class="remark"
                                        id="remark_{{ $stafDetail->id }}">
                                </td>
                                <td style="text-align: center">
                                    <input type="checkbox" name="checkboxGroup" class="checkbox">
                                    <input type="hidden" class="staff-id" value="{{ $stafDetail->id }}">
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button class="assign-task" id="assignTaskBtn" style="width: 100%;">Assigned Task</button>
            </div>
        </div>
    </div>
</div>
<!--Modal Align Tasks-->

<div class="admin-container">

    @include('admin.include.sidebar')

    <section class="main">
        <div class="main-top">
            <h1>New Orders</h1>
        </div>
        <div class="dashboard-container">
            <div class="table-profile">
                <table id="tables">
                    <tbody>
                        <tr class="table-heading-dashboard ">
                            <th>Request Date</th>
                            <th>Register as</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Contact No</th>
                            <th>Type</th>
                            <th>Payment status</th>
                            <th>Accept Or Deny</th>
                        </tr>
                        @foreach ($purchaseDetails as $purchaseDetail)
                            <tr>
                                <td>{{ $purchaseDetail->payment_date }}</td>
                                <td>{{ $purchaseDetail->user_type_name }}</td>
                                <td>{{ $purchaseDetail->user_name }}</td>
                                <td>{{ $purchaseDetail->user_address }}</td>
                                <td>{{ $purchaseDetail->user_phone }}</td>
                                <td>{{ $purchaseDetail->payment_type }}</td>
                                <td>{{ $purchaseDetail->payment_status }}</td>
                                <td>
                                    <button class="edit-user" id="aligntaskModalBtn"
                                        onclick="shoModel('aligntask-modal','{{ $purchaseDetail->t_code }}')"
                                        style="width: 100%;">Assigned Task </button>
                                </td>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </section>
</div>
<script>
    let t_code;
    // Show the modal and populate the table with order details
    $(document).ready(function() {
        $('.edit-user').click(function() {
            var orderTCode = $("#tCode").val();

            t_code = orderTCode;
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var formData = {
                t_code: orderTCode,
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

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
                }
            });
        });
    });

    // asign task to staff
    $(document).ready(function() {
        var selectedStaffData = {}; // Object to store selected staff data

        // Event listener for checkbox change
        $('.checkbox').change(function() {
            var staffId = $(this).closest('tr').find('.staff-id').val();
            var remark = $('#remark_' + staffId).val(); // Get the remark input value

            if ($(this).is(':checked')) {
                selectedStaffData[staffId] = remark; // Store staff data in the object
            } else {
                delete selectedStaffData[staffId]; // Remove staff data when unchecked
            }
        });

        // Event listener for Assign Task button
        $('#assignTaskBtn').click(function() {
            // Convert the selected staff data object into an array of objects
            var staffDataArray = [];
            $.each(selectedStaffData, function(staffId, remark) {
                staffDataArray.push({
                    staff_id: staffId,
                    remark: remark
                });
            });

            if (staffDataArray.length === 0) {
                alert('Please select at least one staff member');
                return;
            }

            var formData = {
                t_code: t_code,
                staff_data: staffDataArray,
            };
            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            $.ajax({
                url: "{{ route('admin.assignTask') }}",
                type: "POST",
                data: formData,
                success: function(response) {
                    if (response.success) {
                        console.log(response.message);
                        closeModel('aligntask-modal');
                        window.location.reload();
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
        document.getElementById("tCode").value = tCode;
        document.getElementById(tagNameId).style.display = 'block';
    }

    function closeModel(tagNameId) {
        document.getElementById(tagNameId).style.display = 'none';
    }
</script>
@include('admin.include.footer')
