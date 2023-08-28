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
</style>

<!--Modal Align Tasks-->
<div id="aligntask-modal" class="aligntask-modal">
    <div class="aligntask-modal-content">
        <span class="aligntask-close" onclick="closeModel('aligntask-modal');">&times;</span>
        <h2>Order Details</h2>
        <input type="hidden" id="id" value="">
        <input type="text" id="t_code" value="">
        <div class="aligntask-containers">
            <div class="table-profile" style="padding: 0px; margin-top: 10px;">
                <table id="tables">
                    <thead>
                        <tr class="table-heading-dashboard">
                            <th>S no.</th>
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
                            @if ($purchaseDetail->review_status === 1)
                                <button class="edit-user" style="background-color: green" id="aligntaskModalBtn"
                                    style="width: 100%;">Reviewed </button>
                                
                            @else
                            <button class="edit-user" id="aligntaskModalBtn"
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
        const serviceId = document.getElementById('id').value;
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
                if (response.success) {
                    alert(response.message);
                    alert('Review added successfully')
                    closeModel('aligntask-modal');
                    window.location.reload();
                } else {
                    closeModel('aligntask-modal');
                    alert(response.message);
                }
            },
            error: function(response) {
                console.log(response);
                alert('Something went wrong');
            }
        });
    } else {
        alert('Please select a rating and provide a review.');
    }
});
</script>
<script>
    function shoModel(tagNameId, id, t_code) {
        document.getElementById("id").value = id;
        document.getElementById("t_code").value = t_code;
        document.getElementById(tagNameId).style.display = 'block';
    }

    function closeModel(tagNameId) {
        document.getElementById(tagNameId).style.display = 'none';
    }
</script>
@include('customer.include.footer')
