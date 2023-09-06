@include('customer.include.header')
<!---User Container-->
<div class="container profile-inline">
    {{-- sidebar  --}}
    @include('customer.include.sidebar')
    {{-- sidebar end --}}

    {{-- user credincals form --}}
    <div class="profile-containers" style="border: none">
        <div class="payment-unsucessfull" >
            <div class="card">
                <div
                    style="
                        border-radius: 200px;
                        height: 200px;
                        width: 200px;
                        background: #f8faf5;
                        margin: 0 auto;
                    ">
                    <i class="ri-close-line cross"></i>
                </div>
                <h2 class="unsuccess">Unsuccess</h2>
                <p>
                    Order Was Unsuccessful Please<br />
                    Try Again Later!
                </p>
                <a href="{{ route('user.purchaseService') }}"><button style="background-color: rgb(218, 10, 34)">
                    Try Again !
                </button></a>
            </div>
        </div>

    </div>
    {{-- form end --}}
</div>
@include('customer.include.footer')
