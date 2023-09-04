<?php
$currentPage = 'userTypeDetails';
$currentNav = 'customer';
?>

@include('admin.include.header')
<div class="admin-container">
    @include('admin.include.sidebar')

    <section class="main">
        <div class="main-top">
            <h1>Customer Type details </h1>

        </div>
        <div class="dashboard-container">
            <div class="table-profile">
                <table id="tables">
                    <tbody>
                        <tr class="table-heading-dashboard ">
                            <th>S.no</th>
                            <th>Name</th>
                            <th>Statu</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($userTypes as $userType)
                            <tr>
                                <td>{{ $userType->id }}</td>
                                <td>{{ $userType->user_type_name }}</td>
                                <td>
                                    @if ($userType->status == 1)
                                        Active
                                    @elseif ($userType->status == 0)
                                        Deactive
                                    @endif
                                </td>
                                <td>
                                    <button class="accept-user">
                                        <a href="{{ route('admin.activeUserType', ['id' => $userType->id]) }}"
                                            style="color: white">Active</a>
                                    </button>
                                    <button class="deny-user">
                                        <a href="{{ route('admin.deactiveUserType', ['id' => $userType->id]) }}"
                                            style="color: white">Deactive</a>
                                    </button>
                                    <button class="accept-user ">
                                        <a href="{{ route('admin.editUserType', ['id' => $userType->id]) }}"
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
