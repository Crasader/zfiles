<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
    <!-- Identify your business so that you can collect the payments. -->
    <input type="hidden" name="business" value="company1996@gmail.com">

    <!-- Specify a Buy Now button. -->
    <input type="hidden" name="cmd" value="_xclick">

    <!-- Specify details about the item that buyers will purchase. -->
    <input type="hidden" name="item_name" value="VIP PLAN">
    <input type="hidden" name="item_number" value="1">
    <input type="hidden" name="amount" value="99.99">
    <input type="hidden" name="currency_code" value="USD">

    <!-- Specify URLs -->
    <input type='hidden' name='cancel_return' value=''>
    <input type='hidden' name='return' value='{{ url('testPaySuccess123') }}'>

    <!-- Display the payment button. -->
    <input type="image" name="submit" border="0"
           src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal - The safer, easier way to pay online">
    <img alt="" border="0" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
</form>