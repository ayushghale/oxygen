@php
    $currentPage = 'ledger';
@endphp

@include('staff.include.header')
<!---Logo Navbar Ends Here-->
<!---Path-->
<div class="container path">
    <p><a href="">Home</a> > User Profile</p>
</div>
<!---Path-->
<!---User Container-->
<div class="container profile-inline">
    {{-- sidebar  --}}
    @include('staff.include.sidebar')
    {{-- sidebar end --}}

    <div class="profile-containers">
        <div class="title-profile">
            <h2>Purchase History</h2>
        </div>

        <div class="table-profile">
            <div class="date">
                <input type="date">
                <p>To</p>
                <input type="date">
                <button class="search"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
            <table id="tables">
                <tr>
                    <th>Purchase Date</th>
                    <th>Name</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Purchase Medium</th>
                </tr>
                <tr>
                    <td>2024 - 01 - 04</td>
                    <td>Maria Anders</td>
                    <td>Oxygen </td>
                    <td>1ltr</td>
                    <td>Online (Esewa)</td>
                </tr>
                <tr>
                    <td>2024 - 01 - 04</td>
                    <td>Christina Berglund</td>
                    <td>Oxygen</td>
                    <td>1ltr</td>
                    <td>Cash On Delivery</td>
                </tr>
                <tr>
                    <td>2024 - 01 - 04</td>
                    <td>Francisco Chang</td>
                    <td>Oxygen</td>
                    <td>1ltr</td>
                    <td>Online (Esewa)</td>
                </tr>

            </table>

            <div class="pagination">
                <a href="#">&laquo;</a>
                <a href="#" class="active">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#">6</a>
                <a href="#">&raquo;</a>
            </div>
        </div>
    </div> 

</div>
@include('staff.include.footer')
