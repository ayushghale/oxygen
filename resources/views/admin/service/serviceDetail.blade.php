<?php
$currentPage = 'serviceDetails';
$currentNav = 'service';
?>

@include('admin.include.header')


<!--Modal Align Tasks-->
<div id="aligntask-modal" class="aligntask-modal">
    <div class="aligntask-modal-content" style="width: 500px">
        <span class="aligntask-close" onclick="closeModel('aligntask-modal');">&times;</span>
        <input type="hidden" id="serviceId" value="">

        <div
            style="
            display: flex;
            justify-content: center;
            align-items: center;  
            border-radius: 200px; 
            height: 200px; width: 
            200px; background: #e7fee7;  
            color:rgb(255, 0, 0); 
            margin:50px auto;
             ">
            <i class="ri-close-line cross" style="font-size: 150px;"></i>
        </div>
        <div style="text-align: center">
            <h2>Are you Sure ?</h2>
            <p>You are not able to recover this data</p>
        </div>
        <div style="display: flex; justify-content: space-around; padding-top:20px ">
            <button class="accept-user" style="margin-top: 10px; width:150px" onclick="closeModel('aligntask-modal')">
                Cancell
            </button>
            <button onclick="deleteService()" class="delete-user" style="margin-top: 10px; width:150px">
                Delete
            </button>
        </div>


    </div>
</div>
<!--Modal Align Tasks-->


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
                                <td><img src="{{ asset($service->service_image) }}" style="width: 200px" alt="">
                                </td>
                                <td>{{ $service->service_description }}</td>
                                <td>
                                    @if ($service->service_status == 1)
                                        Active
                                    @elseif ($service->service_status == 0)
                                        Deactive
                                    @endif
                                </td>
                                <td style="width: 150px">
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
                                    {{-- <button class="delete-user" style="margin-top: 10px">
                                        <a href="{{ route('admin.deleteService', ['id' => $service->service_id]) }}"
                                            style="color: white">Delete</a>
                                    </button> --}}
                                    <button class="delete-user" style="margin-top: 10px"
                                        onclick="shoModel('aligntask-modal', '{{ $service->service_id }}')">
                                        Delete
                                    </button>
                                </td>
                        @endforeach

                    </tbody>
                </table>
            </div>

        </div>

    </section>
</div>

<script>
    function shoModel(tagNameId, serviceId) {
        console.log(serviceId);
        document.getElementById("serviceId").value = serviceId;
        document.getElementById(tagNameId).style.display = 'block';
    }

    function closeModel(tagNameId) {
        document.getElementById(tagNameId).style.display = 'none';
    }

    function deleteService() {
        var serviceId = document.getElementById("serviceId").value;
        console.log(serviceId);

        var dynamicVariables = {};
        dynamicVariables[serviceId] = serviceId;

        console.log(dynamicVariables);
        window.location.href = "/admin/deleteService/" + serviceId;
    }
</script>
@include('admin.include.footer')
