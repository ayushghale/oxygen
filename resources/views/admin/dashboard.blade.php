<?php
$currentPage = 'dashboard';
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
                            <th>Register As</th>
                            <th>Accept Or Deny</th>
                        </tr>
                        @foreach ($userDetails as $userDetail)
                            <tr>
                                <td>{{ $userDetail->created_at }}</td>
                                <td>{{ $userDetail->name }}</td>
                                <td>{{ $userDetail->address }}</td>
                                <td>{{ $userDetail->contact_number }}</td>
                                <td>{{ $userDetail->user_type_name }} </td>
                                <td>
                                    <button class="accept-user">Active</button> 
                                    <button class="deny-user">Deactive</button>
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
