@extends('layouts.app')

@push('styles')
  <style>
    #card-element {
      height: 50px;
      padding-top: 16px;
      border: 1px solid #ced4da;
      border-radius: 0.25rem;
    }
  </style>
@endpush
@section('content')
  <div class="container-fluid py-5  mt-5">
    <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card mt-5">
          <h3 class="card-header p-3">Confirm Payment</h3>
          <div class="card-body">
            @if (session('success'))
              <div class="alert alert-success" role="alert">
                {{ session('success') }}
              </div>
            @endif
            @if (session('error'))
              <div class="alert alert-danger" role="alert">
                {{ session('error') }}
              </div>
            @endif

            <form id="checkout-form" method="POST" action="{{ route('stripe.store') }}">
              @csrf
              <div class="mb-3">
                <label for="name" class="form-label"><strong>Name</strong></label>
                <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ $user->name }}" required>
              </div>
              <input type="hidden" name="stripeToken" id="stripe-token-id">
              <div class="mb-3">
                <div id="card-element" class="form-control"></div>
              </div>
              <button id="pay-btn" class="btn btn-success w-100 mt-3" type="button" onclick="createToken()">
                Pay ${{ $total_payout }}
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
  @push('scripts')


    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      var stripe = Stripe('{{ env('STRIPE_KEY') }}');
      var elements = stripe.elements();
      var cardElement = elements.create('card');
      cardElement.mount('#card-element');

      function createToken() {
        document.getElementById('pay-btn').disabled = true;
        stripe.createToken(cardElement).then(function (result) {
          if (result.error) {
            document.getElementById('pay-btn').disabled = false;
            alert(result.error.message);
          } else {
            document.getElementById('stripe-token-id').value = result.token.id;
            document.getElementById('checkout-form').submit();
          }
        });
      }
    </script>
  @endpush
@endsection