@php
    $currentPage = 'orderToRecive';
@endphp

@include('customer.include.header')
<!---Logo Navbar Ends Here-->



<!---Path-->
<div class="container path">
    <p><a href="">Home</a> > User Profile</p>
</div>
<!---Path-->

<!---User Container-->
<div class="container profile-inline">
    {{-- sidebar  --}}
    @include('customer.include.sidebar')

    <div class="profile-containers">
        <div class="title-profile">
            <h2>Order to be Recived</h2>
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
                @foreach ($purchaseDetails as $purchaseDetail)
                    <tr>
                        <td>{{ $purchaseDetail->order_date }}</td>
                        <td>{{ $purchaseDetail->user_name }}</td>
                        <td>{{ $purchaseDetail->service_name }}</td>
                        <td>{{ $purchaseDetail->order_quantity }} </td>
                        <td>{{ $purchaseDetail->payment_type }}</td>
                    </tr>
                @endforeach

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
@include('customer.include.footer')
