<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
 


</head>
<body>
    <h2>MERCADOPAGO</h2>

    <form action="/success" method="POST" id="form-pay">
        <script
                src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"
                data-preference-id="{{$preference }}">
        </script>
    </form>
</body>


 <script>

 </script>
</html>