# Omnipay: Curopayment

**Curopayment gateway for the Omnipay PHP payment processing library**

[Omnipay](https://github.com/omnipay/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements Curopayment support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "CleverMoneySystems/omnipay-curopayment": "~1.0"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Basic Usage

The following gateways are provided by this package:

* Curopayment

For general usage instructions, please see the main [Omnipay](https://github.com/omnipay/omnipay)
repository. See also the [Cardgate RESTFul Documentation](https://www.cardgate.com/api-docs/cg-api-rest.html)

## Example

```php

	$gateway = Omnipay::create( 'Curopayment' );
	$gateway->initialize( 
		array(
				'siteId' => '<siteid>',
				'merchantId' => '<merchantid>',
				'apiKey' => '<apikey>',
				'notifyUrl' => '<notifyurl>',
				'returnUrl' => '<returnurl>',
				'cancelUrl' => '<cancelurl>',
				'testMode' => <bool:enabled>
		) );

	// Start the purchase
    
	$response = $gateway->purchase( 
 		array(
 				'paymentMethod' => '<paymentmethodid>',
 				'issuer' => <nummeric-issuerid>,
 				'description' => "Test description.",
 				'transactionReference' => 'TEST_TransactionReference_000123_mustBeUnique',
 				'amount' => '10.00',
 				'currency' => 'EUR',
 				'ipaddress' => '10.10.10.10'
 		) )->send();
    
    if ( $response->isSuccessful() ) {
        // payment was successful: update database
        print_r( $response );
    } elseif ( $response->isRedirect() ) {
        // redirect to offsite payment oGateway
        $response->redirect();
    } else {
        // payment failed: display message to customer
        echo $response->getMessage();
    }

```

**Use the fetchIssuers response to see the available issuers**

```php
$response = $oGateway->fetchIssuers()->send();
if($response->isSuccessful()){
    $oIssuers = $response->getIssuers();
}
```    
    
The billing/shipping data are set with the `card` parameter, with an array or [CreditCard object](https://github.com/omnipay/omnipay#credit-card--payment-form-input).


