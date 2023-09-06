<?php
$currentPage = 'serviceDetails';
$currentNav = 'service';
?>

@include('admin.include.header')
<div class="admin-container">
    @include('admin.include.sidebar')

    <section class="main">
        <div class="main-top">
            <h1>Service Details </h1>

        </div>
        <div class="dashboard-container">
            <div class="table-profile">
                <table id="tables">
                    <tbody>
                        <tr class="table-heading-dashboard ">
                            <th>S no.</th>
                            <th>User Type</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($services as $service)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $service->user_type_name }}</td>
                                <td>{{ $service->service_name }}</td>
                                <td>{{ $service->service_price }}</td>
                                <td><img src="{{ asset($service->service_image) }}" style="width: 200px" alt=""></td>
                                <td>{{ $service->service_description }}</td>
                                <td>
                                    @if ($service->service_status == 1)
                                        Active
                                    @elseif ($service->service_status == 0)
                                        Deactive
                                    @endif
                                </td>
                                <td  style="width: 150px">
                                    <button class="accept-user" style="margin-top: 10px">
                                        <a href="{{ route('admin.activeService', ['id' => $service->service_id]) }}"
                                            style="color: white">Active</a>
                                    </button>
                                    <button class="deny-user" style="margin-top: 10px">
                                        <a href="{{ route('admin.deactiveService', ['id' => $service->service_id]) }}"
                                            style="color: white">Deactive</a>
                                    </button>
                                    <button class="edit-user" style="margin-top: 10px">
                                        <a href="{{ route('admin.editService', ['id' => $service->service_id]) }}"
                                            style="color: white">
                                            Edit
                                        </a>
                                    </button>
                                    <button class="delete-user" style="margin-top: 10px">
                                        <a href="{{ route('admin.deleteService', ['id' => $service->service_id]) }}"
                                            style="color: white">Delete</a>
                                    </button>
                                </td>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>

    </section>
</div>
@include('admin.include.footer')
