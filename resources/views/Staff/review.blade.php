@php
    $currentPage = 'review';
@endphp

@include('staff.include.header')
<!---Logo Navbar Ends Here-->
<!---Path-->
<div class="container path">
    <p><a href="">Home</a> > User Profile</p>
</div>
<!---Path-->
<!---User Container-->
<div class="container profile-inline">
    {{-- sidebar  --}}
    @include('staff.include.sidebar')
    {{-- sidebar end --}}

    <div class="profile-containers">
        <div class="title-profile">
            <h2>My Reviews</h2>
        </div>

        <div class="table-profile">
            <div class="date">
                <input type="date">
                <p>To</p>
                <input type="date">
                <button class="search"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>

            <div class="my-reviews">
                <div class="review-box">
                    <div class="review-date">
                        <p>August 21, 2023</p>
                        <p>( Review For Purchasing Oxygen From Pawan Cooperation Pvt. Lmt ) </p>
                    </div>
                    <div class="user-content-review">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quibusdam eveniet asperiores
                            commodi obcaecati doloremque aspernatur perspiciatis, distinctio quisquam mollitia nobis at
                            voluptatum, iusto eligendi magnam atque, corporis in inventore et?</p>
                    </div>
                </div>
                <div class="review-box">
                    <div class="review-date">
                        <p>August 21, 2023</p>
                        <p>( Review For Purchasing Oxygen From Pawan Cooperation Pvt. Lmt ) </p>
                    </div>
                    <div class="user-content-review">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quibusdam eveniet asperiores
                            commodi obcaecati doloremque aspernatur perspiciatis, distinctio quisquam mollitia nobis at
                            voluptatum, iusto eligendi magnam atque, corporis in inventore et?</p>
                    </div>
                </div>
                <div class="review-box">
                    <div class="review-date">
                        <p>August 21, 2023</p>
                        <p>( Review For Purchasing Oxygen From Pawan Cooperation Pvt. Lmt ) </p>
                    </div>
                    <div class="user-content-review">
                        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quibusdam eveniet asperiores
                            commodi obcaecati doloremque aspernatur perspiciatis, distinctio quisquam mollitia nobis at
                            voluptatum, iusto eligendi magnam atque, corporis in inventore et?</p>
                    </div>
                </div>
            </div>
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
@include('staff.include.footer')
 