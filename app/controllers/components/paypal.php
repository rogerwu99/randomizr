<?php 
/**
 * Paypal Direct Payment API Component class file.
 */
App::import('Vendor','paypal' ,array('file'=>'paypal/Paypal.php'));
class PaypalComponent extends Object{
    
    function processPayment($paymentInfo,$function){
        $paypal = new Paypal();
        if ($function=="DoDirectPayment")
            return $paypal->DoDirectPayment($paymentInfo);
        elseif ($function=="SetExpressCheckout")
            return $paypal->SetExpressCheckout($paymentInfo);
        elseif ($function=="GetExpressCheckoutDetails")
            return $paypal->GetExpressCheckoutDetails($paymentInfo);
        elseif ($function=="DoExpressCheckoutPayment")
            return $paypal->DoExpressCheckoutPayment($paymentInfo);
        elseif ($function=="CreateRecurringPayments")
            return $paypal->CreateRecurringPayments($paymentInfo);
        elseif ($function=="UpdateRecurringPaymentsProfile")
            return $paypal->UpdateRecurringPaymentsProfile($paymentInfo);
        elseif ($function=="ManageRecurringPaymentsProfileStatus")
			return $paypal->ManageRecurringPaymentsProfileStatus($paymentInfo);
		else
            return "Function Does Not Exist!";
    }
}
?>
