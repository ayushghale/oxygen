@include('customer.include.header')
<!---User Container-->
<div class="container profile-inline">
    {{-- sidebar  --}}
    @include('customer.include.sidebar')
    {{-- sidebar end --}}

    {{-- user credincals form --}}
    <div class="profile-containers" style="border: none">
        <div class="payment-sucessfull">
            <div class="card">
                <div
                    style="
                        border-radius: 200px;
                        height: 200px;
                        width: 200px;
                        background: #f8faf5;
                        margin: 0 auto;
                    ">
                    <i class="checkmark">✓</i>
                </div>
                <h2>Success</h2>
                <p>
                    We received your purchase request;<br />
                    We'll be in touch shortly!
                </p>
                <a href="{{ route('user.purchaseService') }}"><button>Continue Shopping</button></a>   
            </div>
        </div>

    </div>
    {{-- form end --}}
</div>
@include('customer.include.footer')
