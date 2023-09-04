@php
    $currentPage = 'cart';
    $id = session()->get('userLogedIn');
@endphp

@include('customer.include.header')



{{-- start sweet Message --}}
@if (session()->has('success'))
    <div class="snackbar">
        {{ session()->get('success') }}
    </div>
@elseif(session()->has('error'))
    <div class="snackbar">
        {{ session()->get('error') }}
    </div>
@endif
{{-- end sweet Message --}}


<!--Payment-Modal---->
<div id="payment-modal" class="payment-modal">
    <div class="payment-modal-content">
        <span class="payment-close">&times;</span>
        <h2>Pay Through Different Means</h2>
        <div class="payment-containers">
            <div class="pay-container">
                <input type="radio" id="cash" name="pay" checked="checked" value="cash">
                <label for="cash">Pay By Cash</label>
            </div>
            <div class="pay-container">
                <input type="radio" id="esewa" name="pay" value="esewa">
                <label for="esewa"><img src="{{ asset('oxygen/resources/images/payment/esewa-paywith.png') }}"
                        alt=""></label>
            </div>
            <div class="pay-container">
                <input type="radio" id="khalti" name="pay" value="khalti">
                <label for="khalti"><img src="{{ asset('oxygen/resources/images/payment/khalti-paywith.png') }}"
                        alt=""></label>
            </div>
            <div class="buton-sub-pay">
                <button class="online-pay-btn pay-with-cash" id="payNow"><span id="paymentAmount">10</span></button>
            </div>
        </div>
    </div>
</div>

<!---Payment-Modal CLose-->


<!---Path-->
<div class="container path">
    <p><a href="">Home</a> > User Profile</p>
</div>
<!---Path-->

<!---User Container-->
<div class="container profile-inline">
    {{-- sidebar --}}
    @include('customer.include.sidebar')
    {{-- sidebar end --}}

    <div class="container ">
        <h2>Cart <i class="fa-solid fa-cart-shopping"></i></h2>
        <div class="cart-containers">
            <table id="tables">
                <tr>
                    <th>S.N</th>
                    <th>Product Information</th>
                    <th>Quantity</th>
                    <th>Amount Per Rate</th>
                    <th>Total Amount</th>
                    <th>Remove This</th>
                </tr>
                @foreach ($cartDatas as $cartData)
                    <tr class="cart-item">
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div class="infromation-inline">
                                <img src="{{ asset('oxygen/resources/images/ser-image.png') }}" alt="">
                                <p>{{ $cartData->service_name }}</p>
                            </div>
                        </td>
                        <!-- Move the input inside the <td> tag -->
                        <td>{{ $cartData->quantity }}</td>
                        <input type="hidden" class="quantity-input" value="{{ $cartData->quantity }}" min="1">
                        <td>Rs {{ $cartData->service_price }}</td>
                        <td class="total-amount">Rs. {{ $cartData->totalAmount }}</td>
                        {{-- remove single basket --}}
                        <td>
                            <a href="{{ url('user/removeFromCart/' . $cartData->basket_id) }}">
                                <button class="remove">Remove <i class="fa-solid fa-xmark"></i></button>
                            </a>
                        </td>
                        <!-- Move the input inside the <td> tag -->
                        <input type="hidden" class="serviceId" value="{{ $cartData->service_id }}">
                        <input type="hidden" class="basket_id remove_id " value="{{ $cartData->basket_id }}">
                    </tr>
                @endforeach
                <input type="hidden" id="user_id" value="{{ $id }}">
                <tr>
                    <td colspan="5" class="all-amount"><b>Total Amount :</b>Rs. <span id="totalAmount">10</span></td>
                    <td><a href="{{ route('user.removeAllFromCart') }}"><button class="remove remove-all">Remove All <i class="fa-solid fa-xmark"></i></button></a></td>
                </tr>
            </table>
            <div class="pay-button1">
                <button id="paymentModalBtn">Pay Now</button>
            </div>
        </div>
    </div>
</div>

{{-- js to remove all basket data --}}
{{-- <script>
    $(document).ready(function() {
        const basketIds = [];

        $('.remove-all').on('click', function() {
            const basket_id = $(this).next('.remove_id').val(); // Find the next sibling with class .basket_id
            // alert(basket_id);

            if (basket_id) {
                basketIds.push({
                    basket_id,
                });
            }

            if (basketIds.length === 0) {
                alert('Your cart is empty.');
                return;
            }

            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            const Data = {
                basketIds
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('user.removeAllFromCart') }}",
                data: Data,
                success: function(data) {
                    console.log(data);
                    if (data.status == 200) {
                        alert(data.message);
                    } else {
                        alert(data.message);
                    }
                    window.location.reload();
                }
            });


        });
    });
</script> --}}

{{-- display total amount --}}
<script>
    $(document).ready(function() {
        // Function to calculate the total amount
        function calculateTotalAmount() {
            let totalAmount = 0;
            let paymentAmount = 0;

            const totalAmountCells = document.querySelectorAll('.total-amount');
            const paymentAmountCells = document.querySelectorAll('.payment-amount');

            totalAmountCells.forEach(cell => {
                const amountText = cell.innerText.replace('Rs. ', ''); // Remove the 'Rs. ' prefix
                const amountValue = parseFloat(amountText); // Convert to a numeric value

                if (!isNaN(amountValue)) {
                    totalAmount += amountValue;
                    paymentAmount += amountValue;

                }
            });

            return totalAmount, paymentAmount;
        }

        // Function to update the total amount display
        function updateTotalAmountDisplay() {
            const totalAmount = calculateTotalAmount();
            const totalAmountSpan = document.getElementById('totalAmount');
            totalAmountSpan.innerText = totalAmount.toFixed(2);

            const paymentAmount = calculateTotalAmount();
            const paymentAmountSpan = document.getElementById('paymentAmount');
            paymentAmountSpan.innerText = paymentAmount.toFixed(2);

        }

        // Call the update function initially
        updateTotalAmountDisplay();

        // Add event listeners or call the update function when you want to update the total amount dynamically
        $('.quantity-input').on('change', function() {
            // ... Your existing code to update individual row totals ...

            // Update the total amount display whenever the quantity changes
            updateTotalAmountDisplay();
        });
    });
</script>

{{-- js to send data  --}}
<script>
    $(document).ready(function() {
        // Function to calculate the total amount
        function calculateTotalAmount() {
            let totalAmount = 0;
            const totalAmountCells = document.querySelectorAll('.total-amount');

            totalAmountCells.forEach(cell => {
                const amountText = cell.innerText.replace('Rs. ', ''); // Remove the 'Rs. ' prefix
                const amountValue = parseFloat(amountText); // Convert to a numeric value

                if (!isNaN(amountValue)) {
                    totalAmount += amountValue;
                }
            });

            return totalAmount;
        }

        function sendCartData(paymentType) {
            const cartData = [];
            const basketIds = [];

            $('.cart-item').each(function() {
                const service_id = $(this).find('.serviceId').val();
                const quantity = $(this).find('.quantity-input').val();
                const basket_id = $(this).find('.basket_id').val();

                if (service_id && quantity) {
                    cartData.push({
                        service_id,
                        quantity,
                    });
                }
                if (basket_id) {
                    basketIds.push({
                        basket_id,
                    });
                }
            });

            if (cartData.length === 0) {
                alert('Your cart is empty.');
                return;
            }

            const online_Transaction_code =
                ''; // Replace this with the actual online transaction code if applicable
            const user_id = document.getElementById("user_id").value;

            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            const Data = {
                cartData,
                payment_type: paymentType, // Pass the paymentType here
                online_Transaction_code,
                user_id,
                basketIds
            };

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('user.orderedService') }}",
                data: Data,
                success: function(data) {
                    console.log(data);
                    if (data.status == 200) {
                        session()->flash('success', 'Your order has been placed successfully');
                    } else {
                        session()->flash('success', 'Your order has been placed successfully');
                    }
                    window.location.reload();
                }
            });
        }

        $('#payNow').on('click', function() {
            const cash = document.getElementById('cash').checked;
            const esewa = document.getElementById('esewa').checked;
            const khalti = document.getElementById('khalti').checked;

            let payment_type;

            if (cash) {
                payment_type = 'cash';
            } else if (esewa) {
                payment_type = 'esewa';
            } else if (khalti) {
                payment_type = 'khalti';
            } else {
                alert('Please select a payment method');
                return;
            }

            // Call the sendCartData function and pass the payment_type
            sendCartData(payment_type);
        });
    });
</script>


{{-- mode of payment js --}}
<script>
    const paymentModalBtn = document.getElementById('paymentModalBtn');
    const paymentModal = document.getElementById('payment-modal');
    const paymentCloseModal = document.querySelector('.payment-close');

    paymentModalBtn.addEventListener('click', () => {
        paymentModal.style.display = 'block';
    });

    paymentCloseModal.addEventListener('click', () => {
        paymentModal.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
        if (event.target === paymentModal) {
            paymentModal.style.display = 'none';
        }
    });
</script>

<script>
    const paymentButton = document.querySelector('.online-pay-btn');
    const cashRadio = document.getElementById('cash');
    const esewaRadio = document.getElementById('esewa');
    const khaltiRadio = document.getElementById('khalti');


    function updateButtonClass() {
        if (cashRadio.checked) {
            paymentButton.classList.remove('pay-with-esewa', 'pay-with-khalti');
            paymentButton.classList.add('pay-with-cash');
        } else if (esewaRadio.checked) {
            paymentButton.classList.remove('pay-with-cash', 'pay-with-khalti');
            paymentButton.classList.add('pay-with-esewa');
        } else if (khaltiRadio.checked) {
            paymentButton.classList.remove('pay-with-cash', 'pay-with-esewa');
            paymentButton.classList.add('pay-with-khalti');
        }
    }


    cashRadio.addEventListener('click', updateButtonClass);
    esewaRadio.addEventListener('click', updateButtonClass);
    khaltiRadio.addEventListener('click', updateButtonClass);

    updateButtonClass();
</script>
{{-- mode of payment js --}}

@include('customer.include.footer')
