@php
    $currentPage = 'purchaseService';
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
    {{-- sidebar --}}
    @include('customer.include.sidebar')
    {{-- sidebar end --}}

    <div class="profile-containers">
        <div class="title-profile">
            <h2>Purchase Service</h2>
        </div>
        <div class="services-purchase">
            <table id="tables">
                <tbody>
                    <tr>
                        <th>SN</th>
                        <th>Image</th>
                        <th>Product Name</th>
                        <th>Product Quantity</th>
                        <th>Product Price</th>
                        <th>Total Amount</th>
                        <th>Purchase</th>
                    </tr>

                    <?php $i = 1; ?>
                    @foreach ($services as $service)
                        <tr>
                            <td>{{ $i }}</td>
                            <td><img src="{{ asset($service->service_image) }}" style="width: 150px" alt=""></td>
                            <td>{{ $service->service_name }}</td>
                            <td>
                                <input type="number" class="quantity-input" placeholder="Quantity" min="1">
                                <p id="inValidQuantity" class="error"></p>
                            </td>

                            <td class="service-price">{{ $service->service_price }}</td>
                            <td class="total-price">Rs. 0</td>
                            <td>
                                <button class="pay-button" data-service-id="{{ $service->service_id }}">Add to
                                    cart</button>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="title-profile" style="border-top: 1px solid var(--color5);">
            <h2>Request Service</h2>
        </div>
        <div class="service-add">
            <input type="text" placeholder="Request Service">
            <button>Request</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.quantity-input').on('input', function() {
            var quantity = $(this).val();
            var servicePriceCell = $(this).closest('tr').find('.service-price');
            var totalPriceCell = $(this).closest('tr').find('.total-price');

            // Ensure that quantity is a valid number
            if (!isNaN(quantity) && quantity >= 1) {
                var servicePrice = parseFloat(servicePriceCell.text().replace(/[^0-9.]/g, ''));
                var totalPrice = servicePrice * quantity;

                totalPriceCell.text('Rs. ' + totalPrice.toFixed(2));
            } else {
                // Handle the case where the input is not a valid number or less than 1
                totalPriceCell.text('Invalid quantity');
            }
        });
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.pay-button').on('click', function() {
            var serviceId = $(this).data('service-id');
            var quantity = $(this).closest('tr').find('input[type="number"]').val();


            if (quantity <= 0 || isNaN(quantity)) {
                document.getElementById("inValidQuantity").innerText = "Quantity must be greater than 0";
                document.getElementById("inValidQuantity").style.display = "block";
                return; // Exit the function
            }
            else{
                document.getElementById("inValidQuantity").style.display = "none";
            }

            var csrfToken = $('meta[name="csrf-token"]').attr('content');

            var formData = {
                service_id: serviceId,
                quantity: quantity
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            // console.log(serviceId, quantity, formData, csrfToken);

            $.ajax({
                url: "{{ route('user.addToCart') }}",
                type: "POST",
                data: formData,
                success: function(response) {
                    console.log(response);
                    $('.quantity-input').val(0);
                    $('.total-price').text('Rs. 0');

                    window.location.href = "{{ route('user.cart') }}";
                },
                error: function(response) {
                    console.log(response);
                    console.log('Something went wrong');
                }
            });
        });
    });
</script>
@include('customer.include.footer')
