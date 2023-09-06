<?php
$currentPage = 'staffDetail';
$currentNav = 'staff';
?>

@include('admin.include.header')
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
                                <button class="delete-user">
                                    <a href="{{ route('admin.deleteStaff', ['id' => $staffDetail->id]) }}"
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
