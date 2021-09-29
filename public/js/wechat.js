   document.getElementById('jsTrigger').addEventListener('click', function() {
      console.log(this.dataset.myAttribute);
    });
    

 function pagarWeChat(){

   var key = '{{Config::get('services.stripe.test')}}';
    // var stripe = Stripe('pk_live_B8B7T9QhAZpsQFWe7kbGPrz900Rnd6hht5');
    var stripe = Stripe(key);

    stripe.createSource({
    type: 'wechat',
    amount: 1099,
    currency: 'hkd',
    }).then(function(data) {
      // handle result.error or result.source
      console.log(data.source.wechat.qr_code_url);
      pollForSourceStatus(data);

    });

    var MAX_POLL_COUNT = 10;
    var pollCount = 0;

 }

 function pollForSourceStatus(data) {

      console.log(pollCount);
     stripe.retrieveSource({id: data.source.id, client_secret:  data.source.client_secret}).then(function(result) {

      var source = result.source;
      if (source.status === 'chargeable') {
        // Make a request to your server to charge the Source.
        // Depending on the Charge status, show your customer the relevant message.
        console.log(result)
        console.log('aprobado')
      } else if (source.status === 'pending' && pollCount < MAX_POLL_COUNT) {
        // Try again in a second, if the Source is still `pending`:
        pollCount += 1;
        setTimeout(function () {
          pollForSourceStatus(result)
        }, 10000);
        console.log(result)
      } else {
        console.log('rechazado')
        console.log(result)
        // Depending on the Source status, show your customer the relevant message.
      }
    });
  }
