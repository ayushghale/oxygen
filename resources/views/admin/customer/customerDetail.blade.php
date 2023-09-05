<?php
$currentPage = 'customerDetail';
$currentNav = 'customer';
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
                            <th>Request Date</th>
                            <th>Name</th>
                            <th>Address</th>
                            <th>Contact No</th>
                            <th>Email</th>
                            <th>Register As</th>
                            <th>Status</th>
                            <th>Accept Or Deny</th>
                        </tr>
                        @foreach ($userDetails as $userDetail)
                            <tr>
                                <td>{{ $userDetail->created_at }}</td>
                                <td>{{ $userDetail->name }}</td>
                                <td>{{ $userDetail->address }}</td>
                                <td>{{ $userDetail->contact_number }}</td>
                                <td>{{ $userDetail->email }}</td>
                                <td>{{ $userDetail->user_type_name }} </td>
                                <td>
                                    @if ($userDetail->status == 0)
                                        Deactive
                                    @elseif ($userDetail->status == 1)
                                        Active
                                    @elseif ($userDetail->status == 2)
                                        Pending
                                    @endif
                                </td>
                                <td style="display: flex; gap:3px">
                                    <button class="accept-user">
                                        <a href="{{ route('admin.activeUser', ['id' => $userDetail->id]) }}"
                                            style="color: white">Active</a>
                                    </button>
                                    <button class="deny-user">
                                        <a href="{{ route('admin.deactiveUser', ['id' => $userDetail->id]) }}"
                                            style="color: white">Deactive</a>
                                    </button>
                                    <button class="edit-user">
                                        <a href="{{ route('admin.editUser', ['id' => $userDetail->id]) }}"
                                            style="color: white">
                                            Edit
                                        </a>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </section>
</div>
@include('admin.include.footer')
