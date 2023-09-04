<?php
$currentPage = 'purchaseReport';
$currentNav = 'report';
?>
@include('admin.include.header')

<div class="admin-container">

    @include('admin.include.sidebar')

    <section class="main">
        <div class="main-top">
            <h1>Purchase Report </h1>
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
                            </tr>
                        @endforeach



                    </tbody>
                </table>

            </div>

        </div>
    </section>
</div>


@include('admin.include.footer')
