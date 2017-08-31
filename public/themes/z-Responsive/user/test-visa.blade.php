<html>
<head>
    <script type="text/javascript">
        function onVisaCheckoutReady(){
            V.init( {
                apikey: "7O07VN664O10JW6A9ESS113p8sf9JeGzr6_2haC9F9m_ANtLM",
                paymentRequest:{
                    currencyCode: "USD",
                    total: "10.00"
                }
            });
            V.on("payment.success", function(payment)
            {alert("ok"); });
            V.on("payment.cancel", function(payment)
            {alert("fail"); });
            V.on("payment.error", function(payment, error)
            {alert("error");});
        }
    </script>
</head>
<body>
<img alt="Visa Checkout" class="v-button" role="button"
     src="https://sandbox.secure.checkout.visa.com/wallet-services-web/xo/button.png"/>
<script type="text/javascript"
        src="https://sandbox-assets.secure.checkout.visa.com/checkout-widget/resources/js/integration/v1/sdk.js">
</script>
</body>
</html>