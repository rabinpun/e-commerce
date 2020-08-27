(function(){
    // Create a Stripe client.   put your stripe public key
var stripe = Stripe('pk_test_51HJxjUDz3bVbK0pwK1wbZRaFtwXX1jOutKukh4dE8RxP3EiCK0I4EgBhsxFsvCuvYtKTQe9vIT2WuXqeQCG5mKqR00TkXZv8Kt');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {
    style: style,
    hidePostalCode : true // hiding the postal code since we already haave a field for it in the form
});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  //disabling the submit order so that the customer cannot or mistakely press submit twice and get charged twice
  document.getElementById('complete-order').disabled = true;

  var options = {//adding the recommended information by stripe official documentation
      name : document.getElementById('cardName').value,
      address_line1 : document.getElementById('address').value,
      address_city : document.getElementById('district').value,
      address_state : document.getElementById('province').value,
      address_zip :document.getElementById('postalcode').value,

  }

  stripe.createToken(card , options).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;

      //enabling the submit button if there is an error so that customer can submit again
      document.getElementById('complete-order').disabled = false;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
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
  })();