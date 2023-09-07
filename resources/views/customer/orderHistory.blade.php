@php
    $currentPage = 'purchase';
@endphp

@include('customer.include.header')
<!---Logo Navbar Ends Here-->

<style>
    button.edit-user {
        padding: 8px;
        font-size: 15px;
        border: none;
        text-transform: uppercase;
        font-weight: 500;
        background-color: var(--color1);
        color: white;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.5s;
        width: 100%;
    }

    .container .post {
        display: none;
    }

    .container .text {
        font-size: 25px;
        color: #666;
        font-weight: 500;
    }

    .container .edit {
        position: absolute;
        right: 10px;
        top: 5px;
        font-size: 16px;
        color: #666;
        font-weight: 500;
        cursor: pointer;
    }

    .container .edit:hover {
        text-decoration: underline;
    }

    .container .star-widget input {
        display: none;
    }

    .star-widget {
        float: left;
    }

    .star-widget label {
        font-size: 40px;
        color: #444;
        padding: 10px;
        float: right;
        transition: all 0.2s ease;
    }

    input:not(:checked)~label:hover,
    input:not(:checked)~label:hover~label {
        color: #fd4;
    }

    input:checked~label {
        color: #fd4;
    }

    input#rate-5:checked~label {
        color: #fe7;
        text-shadow: 0 0 20px #952;
    }

    button.assign-task {
        padding: 8px;
        font-size: 15px;
        border: none;
        text-transform: uppercase;
        font-weight: 500;
        background-color: var(--color1);
        color: white;
        border-radius: 5px;
        cursor: pointer;
        transition: 0.5s;
        width: 100%;
    }
</style>


<!--Modal Align Tasks-->
<div id="aligntask-modal" class="aligntask-modal">
    <div class="aligntask-modal-content">
        <span class="aligntask-close" onclick="closeModel('aligntask-modal');">&times;</span>
        <h2>Order Details</h2>
        <input type="text" id="service_id" value="">
        <input type="text" id="t_code" value="">
        <div class="aligntask-containers">
            <div class="table-profile" style="padding: 0px; margin-top: 10px;">
                <table id="tables">
                    <thead>
                        <tr class="table-heading-dashboard">
                            <th>Request Date</th>
                            <th>Service Name</th>
                            <th>Address</th>
                            <th>Quantity</th>
                            <th>Rate</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="orderDetailsTableBody">
                        <!-- dynamically generated rows will be inserted here -->
                    </tbody>
                </table>
            </div>
            <h2 style="padding-top: 25px">Review Service</h2>
            <form action="#" id="reviewForm">
                <div class="container">
                    <div class="star-widget">
                        <input type="radio" name="rate" id="rate-5" value="5">
                        <label for="rate-5" class="fas fa-star"></label>
                        <input type="radio" name="rate" id="rate-4" value="4">
                        <label for="rate-4" class="fas fa-star"></label>
                        <input type="radio" name="rate" id="rate-3" value="3">
                        <label for="rate-3" class="fas fa-star"></label>
                        <input type="radio" name="rate" id="rate-2" value="2">
                        <label for="rate-2" class="fas fa-star"></label>
                        <input type="radio" name="rate" id="rate-1" value="1">
                        <label for="rate-1" class="fas fa-star"></label>
                    </div>
                </div>

                <div>
                    <textarea style="width: 100%; height: 200px; padding: 5px" placeholder="Describe The Patient" name="review"></textarea>
                </div>
                <div>
                    <button class="assign-task" id="addReview" style="width: 100%;">Add Review</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!--Modal Align Tasks-->

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
            <h2>Order History</h2>
        </div>

        <div class="table-profile">
            <div style="display: flex">
                <form action="{{ route('user.purchaseHistory') }}" method="GET">
                    @csrf
                    <div class="date">
                        <input type="date" name="startDate">
                        <p>To</p>
                        <input type="date" name="endDate">
                        <button class="search"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </div>
                </form>
                <div class="date">
                    <button class="search"><a href="{{ route('user.purchaseHistory') }}"><i
                                class="fa-solid fa-broom"></i></a></button>
                </div>
            </div>
            <table id="tables">
                <tr>
                    <th>Purchase Date</th>
                    <th>Name</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Purchase Medium</th>
                    <th>Add review</th>
                </tr>
                @foreach ($purchaseDetails as $purchaseDetail)
                    <tr>
                        <td>{{ $purchaseDetail->order_date }}</td>
                        <td>{{ $purchaseDetail->user_name }}</td>
                        <td>{{ $purchaseDetail->service_name }}</td>
                        <td>{{ $purchaseDetail->order_quantity }} </td>
                        <td>{{ $purchaseDetail->payment_type }}</td>
                        <td>
                            @if ($purchaseDetail->review_status == 1)
                                <button class="edit-user" style="background-color: green" style="width: 100%;">Reviewed
                                </button>
                            @else
                                <button class="edit-user aligntaskModalBtn"
                                    onclick="shoModel('aligntask-modal','{{ $purchaseDetail->service_id }}', '{{ $purchaseDetail->t_code }}')"
                                    style="width: 100%;">Review </button>
                            @endif

                        </td>
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
{{-- order detials --}}
<script>
    $(document).ready(function() {
        $('.aligntaskModalBtn').click(function() {
            var orderTCode = $("#t_code").val();
            var orderServiceId = $("#service_id").val();

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var formData = {
                t_code: orderTCode,
                service_id: orderServiceId,
            };

            console.log('Order T Code: ' + orderTCode + ' Service ID: ' + orderServiceId);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            // extract data of order details
            $.ajax({
                url: "{{ route('user.orderDetails') }}",
                type: "GET",
                data: formData,
                success: function(response) {
                    console.log(response); // Check the response data in the console    

                    if (response.success) {
                        var tbody = $('#orderDetailsTableBody');
                        tbody.empty(); // Clear existing content

                        $.each(response.data, function(index, order) {
                            var row = $('<tr>');
                            row.append('<td>' + order.order_date + '</td>');
                            row.append('<td>' + order.service_name + '</td>');
                            row.append('<td>' + order.user_address + '</td>');
                            row.append('<td>' + order.order_quantity + '</td>');
                            row.append('<td>' + order.service_price + '</td>');
                            row.append('<td>' + order.order_amount + '</td>');

                            // ... add more columns ...

                            tbody.append(row);
                        });

                        // alert(response.message);
                    } else {
                        console.log(response.message);
                    }
                },
                error: function(response) {
                    console.log(response);
                    console.log('Something went wrong');
                }
            });

        });
    });
</script>
{{-- add review --}}
<script>
    document.getElementById('addReview').addEventListener('click', function(event) {
        event.preventDefault();

        const form = document.getElementById('reviewForm');
        const ratingInput = form.querySelector('input[name="rate"]:checked');
        const reviewInput = form.querySelector('textarea[name="review"]');

        if (ratingInput && reviewInput.value.trim() !== '') {
            const ratingValue = ratingInput.value;
            const reviewText = reviewInput.value;

            console.log('Rating:', ratingValue);
            console.log('Review:', reviewText);

            // Get the service ID and other values
            const serviceId = document.getElementById('service_id').value;
            const tCode = document.getElementById('t_code').value;

            // Prepare form data
            const formData = {
                'service_id': serviceId,
                't_code': tCode,
                'rating': ratingValue,
                'review': reviewText,
            };

            console.log(formData);

            // Set CSRF token header for the AJAX request
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            // Make the AJAX request
            $.ajax({
                url: "{{ route('user.reviewData') }}",
                type: "POST",
                data: formData,
                success: function(response) {
                    var message = response.message;


                    console.log('sweetMessage sent');

                    if (message) {
                        console.log(message);

                        console.log('done');
                    } else {
                        console.log(response.message);
                    }

                    // Close the modal and reload the page
                    closeModel('aligntask-modal');
                    window.location.reload();
                },
                error: function(response) {
                    console.log(response);
                    console.log('Something went wrong');
                }
            });
        } else {
            console.log('Please select a rating and provide a review.');
        }
    });
</script>
{{-- add review end --}}
<script>
    function shoModel(tagNameId, id, t_code) {
        document.getElementById("service_id").value = id;
        document.getElementById("t_code").value = t_code;
        document.getElementById(tagNameId).style.display = 'block';
    }

    function closeModel(tagNameId) {
        document.getElementById(tagNameId).style.display = 'none';
    }
</script>



@include('customer.include.footer')
