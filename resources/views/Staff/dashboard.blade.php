@php
    $currentPage = 'dashboard';
@endphp

@include('staff.include.header')
<!---Logo Navbar Ends Here-->
<!---Path-->
<div class="container path">
    <p><a href="">Home</a> > Service Provider</p>
</div>
<!---Path-->
<!---User Container-->
<div class="container profile-inline">
    {{-- sidebar --}}
    @include('staff.include.sidebar')

    {{-- sidebar end --}}

    {{--  --}}
    <div class="profile-containers">
        <div class="title-profile">
            <h2>Dashboard</h2>
        </div>
        <div class="dasboard-section">
            <div class="das-sec">
                <div class="img-das">
                    <img src="../resources/images/dashboard/list-items.png" alt="">
                </div>
                <div class="das-desc">
                    <p>Total Products Sold</p>
                    <p class="numberic" id="productsCount"> <span>4</span> Items</p>
                </div>
            </div>
            <div class="das-sec">
                <div class="img-das">
                    <img src="../resources/images/dashboard/dollar.png" alt="">
                </div>
                <div class="das-desc">
                    <p>Total Sales</p>
                    <p class="numberic" id="amountCount"> Rs. <span>4,000</span></p>
                </div>
            </div>
            <div class="das-sec">
                <div class="img-das">
                    <img src="../resources/images/dashboard/returned.png" alt="">
                </div>
                <div class="das-desc">
                    <p>Product Returned</p>
                    <p class="numberic" id="returnedid"> <span>4</span> Items</p>
                </div>
            </div>
        </div>
        <div class="table-profile">
            <table id="tables">
                <tr>
                    <th>Purchase Date</th>
                    <th>Sold To</th>
                    <th>Products Sold</th>
                    <th>Quantity</th>
                </tr>
                <tr>
                    <td>2024 - 01 - 04</td>
                    <td>Maria Anders</td>
                    <td>Oxygen </td>
                    <td>1ltr</td>
                </tr>
                <tr>
                    <td>2024 - 01 - 04</td>
                    <td>Christina Berglund</td>
                    <td>Sweden</td>
                    <td>1ltr</td>
                </tr>
                <tr>
                    <td>2024 - 01 - 04</td>
                    <td>Francisco Chang</td>
                    <td>Mexico</td>
                    <td>1ltr</td>
                </tr>

            </table>
        </div>

    </div>
</div>
@include('staff.include.footer')
 