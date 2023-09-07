<?php
$currentPage = 'staffDetail';
$currentNav = 'staff';
?>

@include('admin.include.header')

<!--Modal Align Tasks-->
<div id="aligntask-modal" class="aligntask-modal">
    <div class="aligntask-modal-content" style="width: 500px">
        <span class="aligntask-close" onclick="closeModel('aligntask-modal');">&times;</span>
        <input type="hidden" id="staffId" value="">
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
            <h2 >Are you Sure ?</h2>
            <p>You are not able to recover this data</p>
        </div>
        <div style="display: flex; justify-content: space-around; padding-top:20px ">
            <button  class="accept-user" style="margin-top: 10px; width:150px"
            onclick="closeModel('aligntask-modal')">
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
            <h1>Dashboard <i class="fa-solid fa-user-plus"></i></h1>

        </div>
        <div class="dashboard-container">
            <div class="table-profile">
                <table id="tables">
                    <tbody>
                        <tr class="table-heading-dashboard ">
                            <th>S no.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact No</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($staffDetails as $staffDetail )
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$staffDetail->name}}</td>
                            <td>{{$staffDetail->email}}</td>
                            <td>{{$staffDetail->contact_number}}</td>
                            <td>
                                @if ($staffDetail->status == 1)
                                    Active
                                @elseif ($staffDetail->status == 0)
                                    Deactive
                                @endif
                            </td>
                            <td  style="display:flex; gap:4px">
                                <button class="accept-user">
                                    <a href="{{ route('admin.activeStaff', ['id' => $staffDetail->id]) }}"
                                        style="color: white">Active</a>
                                </button>
                                <button class="deny-user">
                                    <a href="{{ route('admin.deactiveStaff', ['id' => $staffDetail->id]) }}"
                                        style="color: white">Deactive</a>
                                </button>
                                <button class="accept-user ">
                                    <a href="{{ route('admin.editStaff', ['id' => $staffDetail->id]) }}"
                                        style="color: white">
                                        Edit
                                    </a>
                                </button>
                                <button class="delete-user" 
                                        onclick="shoModel('aligntask-modal', '{{ $staffDetail->id }}')">
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
    function shoModel(tagNameId, staffId) {
        console.log(staffId);
        document.getElementById("staffId").value = staffId;
        document.getElementById(tagNameId).style.display = 'block';
    }

    function closeModel(tagNameId) {
        document.getElementById(tagNameId).style.display = 'none';
    }

    function deleteService() {
        var staffId = document.getElementById("staffId").value;
        console.log(staffId);
        window.location.href = "/admin/deleteService/" + staffId;
    }
</script>
@include('admin.include.footer')
