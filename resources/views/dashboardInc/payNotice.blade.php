

<div id="pricelist" style="display:none">
    @if($status->status=='discount')
        <div>
            <span>week price{{$price->week_price/2}}</span>
            <span><a href="/pay/{{$price->week_price/2}}" class="btn btn-info">chose</a></span>
        </div>
        <div class>
            <span>week price{{$price->dweeks_price/2}}</span>
            <span><a href="/pay/{{$price->dweeks_price/2}}" class="btn btn-info">chose</a></span>
        </div>
        <div>
            <span> mon price{{$price->month_price/2}}</span>
            <span><button  class="btn btn-info show-card" value="{{$price->month_price/2}}">chose</button></span>
        </div>
    @else
        <div>
            <span>week price{{$price->week_price}}</span>
            <span><a href="/pay/{{$price->week_price}}" class="btn btn-primary">chose</a></span>
        </div>
        <div class>
            <span>week price{{$price->dweeks_price}}</span>
            <span><a href="/pay/{{$price->dweeks_price}}" class="btn btn-primary">chose</a></span>
        </div>
        <div>
            <span> mon price{{$price->month_price}}</span>
            <span><a href="/pay/{{$price->month_price}}" class="btn btn-primary">chose</a></span>
        </div>
    @endif
</div>


<div id="card" style="display:none">
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
  html {
  height: 100%;
}



form {
  width: 480px;
  margin: 20px 0;
}

.group {
  background: white;
  box-shadow: 0 7px 14px 0 rgba(49, 49, 93, 0.10), 0 3px 6px 0 rgba(0, 0, 0, 0.08);
  border-radius: 4px;
  margin-bottom: 20px;
}

label {
  position: relative;
  color: #8898AA;
  font-weight: 300;
  height: 40px;
  line-height: 40px;
  margin-left: 20px;
  display: flex;
  flex-direction: row;
}

.group label:not(:last-child) {
  border-bottom: 1px solid #F0F5FA;
}

label > span {
  width: 120px;
  text-align: right;
  margin-right: 30px;
}

.field {
  background: transparent;
  font-weight: 300;
  border: 0;
  color: #31325F;
  outline: none;
  flex: 1;
  padding-right: 10px;
  padding-left: 10px;
  cursor: text;
}

.field::-webkit-input-placeholder {
  color: #CFD7E0;
}

.field::-moz-placeholder {
  color: #CFD7E0;
}



.success,
.error {
  display: none;
  font-size: 13px;
}

.success.visible,
.error.visible {
  display: inline;
}

.error {
  color: #E4584C;
}

.success {
  color: #666EE8;
}

.success .token {
  font-weight: 500;
  font-size: 13px;
}

</style>

<form action="/charge" method="post" id="payment-form">
    <div class="form-row">
        @csrf
      <input hidden name="amount" value="">
      <label for="card-element">
        Credit or debit card
      </label>
      <div id="card-element">
        <!-- A Stripe Element will be inserted here. -->
      </div>
  
      <!-- Used to display Element errors. -->
      <div id="card-errors" role="alert"></div>
    </div>
  
    <button>Submit Payment1</button>
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
</div>

<script>
    
    function showPricelist(){
        var x = document.getElementById("pricelist");
        if (x.style.display === "none") {
            x.style.display = "block";
        } else {
            x.style.display = "none";
        }
    }
</script>

<script>
  $(document).ready(function(){
    $(".show-card1").click(function(e){
      
      //var amt=$('#')
      e.preventDefault();
      $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                  });
      
      //var card = document.getElementById("card");
      $.ajax({
          type: "POST",
          url: "/updateAmt",
          data: { 
              amt:$(this).val()
              //amt:$(this).attri('data-amt')
              
          },
          success: function(result) {
              
              //card.style.display = "block";
              alert('ok');
          },
          error: function(result) {
            console.log(result);
              alert('error');
          }
        });
      });
  
  });
  </script>
  
  <script>
  $(document).ready(function() {
    $(".show-card").click(function(e) {
      e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var card = document.getElementById("card");
        $.ajax({
            type: 'POST',
            url: '/ajtest',
            data: {
                amt:$(this).val()
            },
            dataType: 'json',
            success: function(data) {
                console.log(data);
                card.style.display = "block";
            },
            error: function(data) {
                alert(data);
            }
        });
    });
    
});

  
</script>

