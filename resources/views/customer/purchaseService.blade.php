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
                            <td>{{ $service->service_name }}</td>
                            <td><input type="number" class="quantity-input" placeholder="Quantity" min="1"></td>
                            <td>{{ $service->service_price }}</td>
                            <td class="total-price">Rs. 0</td>
                            <td>
                                <button class="pay-button" data-service-id="{{ $service->service_id }}">Add to cart</button>
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
        $('.quantity-input').on('change', function() {
            var quantity = $(this).val();
            var servicePrice = $(this).closest('tr').find('td:nth-child(4)').text();
            var totalPriceCell = $(this).closest('tr').find('.total-price');

            // Calculate the total price and update the cell
            var totalPrice = parseFloat(servicePrice.replace(/[^0-9.]/g, '')) * quantity;
            totalPriceCell.text('Rs. ' + totalPrice.toFixed(2));
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
                alert('Please enter a valid quantity');
                return; // Exit the function
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
                    if (response.status == 'success') {
                        alert(response.message);
                        window.location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(response) {
                    console.log(response);
                    alert('Something went wrong');
                }
            });
        });
    });
</script>
@include('customer.include.footer')
