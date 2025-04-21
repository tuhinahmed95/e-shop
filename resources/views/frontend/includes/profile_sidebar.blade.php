<div class="col-lg-3 m-auto py-3">
    <div class="card" style="width: 18rem;">
        @if (Auth::guard('customer')->user()->photo == null)
            <img width="70" class="m-auto mt-2" src="{{ Avatar::create(Auth::guard('customer')->user()->fname)->toBase64() }}" />
        @else
             <img width="70" class="m-auto mt-2" src="{{ asset('uploads/customer') }}/{{ Auth::guard('customer')->user()->photo }}" alt="">
        @endif
        <div class="card-body">
          <h5 class="card-title text-center">{{ Auth::guard('customer')->user()->fname.' '. Auth::guard('customer')->user()->lname }}</h5>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item text-center bg-light py-1"><a href="" class="text-dark">My Profile</a></li>
          <li class="list-group-item text-center bg-light py-1"><a href="" class="text-dark">My Whish List</a></li>
          <li class="list-group-item text-center bg-light py-1"><a href="{{ route('my.orders') }}" class="text-dark">My Order</a></li>
          <li class="list-group-item text-center bg-light py-1"><a href="{{ route('customer.logout') }}" class="text-dark">Logout</a></li>
        </ul>
    </div>
</div>
