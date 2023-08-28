@php
    $currentPage = 'dashboard';
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
            <h2>Dashboard</h2>
        </div>
        <div class="dasboard-section">
            <div class="das-sec">
                <div class="img-das">
                    <img src="{{ asset('oxygen/resources/images/dashboard/list-items.png') }}" alt="">
                </div>
                <div class="das-desc">
                    <p>Total Products Purchased</p>
                    <p class="numberic" id="productsCount"> <span>4</span> Items</p>
                </div>
            </div>
            <div class="das-sec">
                <div class="img-das">
                    <img src="{{ asset('oxygen/resources/images/dashboard/dollar.png') }}" alt="">
                </div>
                <div class="das-desc">
                    <p>Total Amount Purchased</p>
                    <p class="numberic" id="amountCount"> Rs. <span>4,000</span></p>
                </div>
            </div>
            <div class="das-sec">
                <div class="img-das">
                    <img src="{{ asset('oxygen/resources/images/dashboard/returned.png') }}" alt="">
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
                    <th>Name</th>
                    <th>Product</th>
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
