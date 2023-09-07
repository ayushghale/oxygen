@php
    $currentPage = 'ledger';
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
            <h2>Ledger</h2>
        </div>
        <div class="profile-information">
            <div style="display: flex">
                <form action="{{ route('staff.orderAsigned') }}" method="GET">
                    @csrf
                    <div class="date">
                        <input type="date" name="startDate">
                        <p>To</p>
                        <input type="date" name="endDate">
                        <button class="search"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
                <div class="date">
                    <button class="search" >
                        <a href="{{ route('staff.orderAsigned') }}">
                            <i class="fa-solid fa-broom" style="color: white"></i>
                        </a>
                    </button>
                </div>
            </div>

            <div class="records-table-show" style="width: 100%;">
                <div class="export-buttons" style="margin-bottom: 10px;">
                    <button class="profile-button" style="width: auto;"><i class="fa-solid fa-file-export"></i>
                        Export As Pdf</button>
                    <button class="profile-button" style="width: auto;"><i class="fa-solid fa-print"></i>
                        Print</button>
                    <button class="profile-button" style="width: auto;"><i class="fa-solid fa-file-export"></i>
                        Export As Excell</button>
                </div>

                <div class="overflow-tables" style="width: 100%!important; overflow-x:auto!important;">
                    <table id="tables" style="width: 1600px;">
                        <tbody>
                            <tr>
                                <th>Date :</th>

                                <th>Items Purchased</th>
                                <th>Quantity</th>
                                <th>Per Amount</th>
                                <th>Total</th>
                            </tr>
                            @foreach ($uerOrderDetails as $uerOrderDetail)
                                <tr>
                                    <td>{{ $uerOrderDetail['date'] }}</td>
                                    {{-- service name --}}
                                    <td>
                                        <table class="inside-td-data" style="border-collapse: collapse;">
                                            <tbody>
                                                @foreach ($uerOrderDetail['orderDetails'] as $service)
                                                    <tr>
                                                        <td>
                                                            {{ $service->service_name }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                    {{-- quantity --}}
                                <td>
                                    <table class="inside-td-data" style="border-collapse: collapse;">
                                        <tbody>
                                            @foreach ($uerOrderDetail['orderDetails'] as $service)
                                                <tr>
                                                    <td>
                                                        {{ $service->order_quantity }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                                {{-- service per total price --}}
                                <td>
                                    <table class="inside-td-data" style="border-collapse: collapse;">
                                        <tbody>
                                            @foreach ($uerOrderDetail['orderDetails'] as $service)
                                                <tr>
                                                    <td>
                                                        {{ $service->order_amount }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>
                                {{-- total price --}}
                                <td>{{ $uerOrderDetail['total_amount'] }}</td>
                                </tr>
                                
                            @endforeach

                        </tbody>
                    </table>
                </div>

                <div class="pagination">
                    <a href="#">«</a>
                    <a href="#" class="active">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#">5</a>
                    <a href="#">6</a>
                    <a href="#">»</a>
                </div>
            </div>

        </div>

    </div>
</div>
<script>
    function animateCount(elementId, targetCount, duration) {
        const span = document.getElementById(elementId).querySelector('span');
        const startCount = 0;
        const increment = Math.ceil(targetCount / (duration / 10));
        let currentCount = 0;

        const timer = setInterval(() => {
            if (currentCount >= targetCount) {
                clearInterval(timer);
                span.textContent = targetCount;
            } else {
                currentCount += increment;
                span.textContent = currentCount;
            }
        }, 10);
    }

    animateCount("productsCount", 40, 2000);
    animateCount("amountCount", 4000, 300);
    animateCount("returnedid", 20, 2000);
</script>
@include('customer.include.footer')
