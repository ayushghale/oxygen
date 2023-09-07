@php
    $currentPage = 'review';
@endphp

@include('customer.include.header')


<style>
    .golden-star {
        color: gold;
    }
</style>

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
            <h2>My Reviews</h2>
        </div>

        <div class="table-profile">

            <div class="my-reviews">
                @foreach ($reviewedDatas as $review)
                    <div class="review-box">
                        <div class="review-date">
                            <p>{{ Carbon\Carbon::parse($review->review_date)->formatLocalized('%B %d, %Y') }}</p>
                            <p>({{ $review->service_name }} - ({{ $review->service_description }}))</p>
                            <p>
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rating)
                                        <i class="fas fa-star golden-star"></i>
                                    @else
                                        <i class="far fa-star golden-star"></i>
                                    @endif
                                @endfor
                            </p>
                        </div>
                        <div class="user-content-review">
                            <p>{{ $review->review }}</p>
                        </div>
                    </div>
                @endforeach

            </div>
            {{-- <div class="pagination">
                <a href="#">&laquo;</a>
                <a href="#" class="active">1</a>
                <a href="#">2</a>
                <a href="#">3</a>
                <a href="#">4</a>
                <a href="#">5</a>
                <a href="#">6</a>
                <a href="#">&raquo;</a>
            </div> --}}
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
