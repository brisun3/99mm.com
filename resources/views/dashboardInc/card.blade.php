@extends('layouts.app')

@section('content')
<style type="text/css">
  * {
  font-family: "Helvetica Neue", Helvetica;
  font-size: 15px;
  font-variant: normal;
  padding: 0;
  margin: 0;
  }
    .form-row {
    display: inherit;

  }

        <form action="/charge" method="post" id="payment-form">
            <div class="form-row">
                @csrf
              <label for="card-element">
                Credit or debit card
              </label>
              <div id="card-element">
                <!-- A Stripe Element will be inserted here. -->
              </div>
          
              <!-- Used to display Element errors. -->
              <div id="card-errors" role="alert"></div>
            </div>
          
            <button>Submit Payment</button>
          </form>
          <script src="https://js.stripe.com/v3/"></script>
          <script>
        var stripe = Stripe('pk_test_jQcVogvHYK3N7UGbEjAUsJV900IRHHsk5b');
        var elements = stripe.elements();
        var style = {
            base: {
              // Add your base input styles here. For example:
              
              fontSize: '16px',
              color: "#32325d",
            }
          };
          
          // Create an instance of the card Element.
          var card = elements.create('card', {style: style});
          
          // Add an instance of the card Element into the `card-element` <div>.
          card.mount('#card-element');
          card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
              displayError.textContent = event.error.message;
            } else {
              displayError.textContent = 'rongKard';
            }
          });
        
         // Step 3: Create a token to securely transmit card information

    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
      event.preventDefault();
    
      stripe.createToken(card).then(function(result) {
        if (result.error) {
          // Inform the customer that there was an error.
          var errorElement = document.getElementById('card-errors');
          errorElement.textContent = result.error.message;
        } else {
          // Send the token to your server.
          stripeTokenHandler(result.token);
        }
      });
    });
    //last step
    function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
</script>
@endsection