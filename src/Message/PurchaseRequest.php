<?php

/*
 * Curopayment driver for Omnipay PHP payment processing library
 * https://www.curopayments.com/
 *
 */
namespace Omnipay\Curo\Message;

use Omnipay\Common\CreditCard;
use Omnipay\Common\Exception\InvalidRequestException;
use Guzzle\Http\Exception\BadResponseException;
use Omnipay\Curo\Message\Error;

/**
 * PurchaseRequest class - it registers a transaction
 *
 * @author Martin Schipper martin@cardgate.com
 */
class PurchaseRequest extends AbstractRequest
{

	protected $endpoint = '';

	/**
	 * (non-PHPdoc)
	 *
	 * @see \Omnipay\Common\Message\MessageInterface::getData()
	 */
	public function getData ()
	{

		// PaymentMethod independant checks
		$this->validate( 'transactionReference', 'currency', 'siteId', 'amount', 'description', 'returnUrl',
				'notifyUrl', 'ipaddress' );

		// PaymentMethod specific checks
		$this->validatePaymentMethodSpecific();

		// Transaction data
		$data = array(
				'ref' => $this->getTransactionReference(),
				'currency' => $this->getCurrency(),
				'site_id' => $this->getSiteId(),
				'amount' => $this->getAmountInteger(),
				'description' => $this->getDescription(),
				'control_url' => $this->getNotifyUrl(),
				'return_url' => $this->getReturnUrl(),
				'return_url_failed' => $this->getCancelUrl(),
				'ip_address' => $this->getIpAddress(),
				'language' => $this->getLanguage(),
				'customer' => $this->getCustomer(),
				'bypass_simulator'=>$this->getByPassSimulator()
		);
		if ( $this->getPaymentMethod() == 'ideal' ) {
			$data['issuer_id'] = $this->getIssuer();
		}

		// Customer data
		$customerData = new CreditCard( $_POST );
		if ( $customerData && strlen( $customerData->getFirstName() ) && strlen( $customerData->getLastName() ) ) {
			$data['customer'] = array(
					'first_name' => $customerData->getFirstName(),
					'last_name' => $customerData->getLastName(),
					'company_name' => $customerData->getCompany(),
					'address' => $customerData->getAddress1(),
					'city' => $customerData->getCity(),
					'state' => $customerData->getState(),
					'postal_code' => $customerData->getPostcode(),
					'country_code' => $customerData->getCountry(),
					'phone_number' => $customerData->getPhone(),
					'email' => $customerData->getEmail()
			);
		}

		return $data;
	}

	/**
	 * (non-PHPdoc)
	 *
	 * @see \Omnipay\Common\Message\RequestInterface::sendData()
	 */
	public function sendData ( $data )
	{

		// Test-API SSL cert issue
		$this->setSslVerification();

		$jsonData = json_encode( array(
				'payment' => $data
		) );

		$this->httpClient->setBaseUrl( $this->getUrl() .($this->getIsCuroProtocol() ? '/curo/' : ''). $this->endpoint . $this->getPaymentMethod() . '/payment/' );
		$request = $this->httpClient->post( null, null, $jsonData );
		$request->setAuth( $this->getMerchantId(), $this->getApiKey() );
		$request->setHeader( 'Content-type', 'application/json' );
		$request->addHeader( 'Accept', 'application/json' );

		try {
			$httpResponse = $request->send();
		} catch ( BadResponseException $e ) {
			$e->getResponse()->getBody(1); // ugly; but else ->xml() will fail
			return new PurchaseResponse( $this, $e->getResponse()->json() );
		}

		return new PurchaseResponse( $this, $httpResponse->json() );
	}

	/**
	 * Some PaymentMethod specific validation checks.
	 *
	 * @throws InvalidRequestException
	 */
	private function validatePaymentMethodSpecific ()
	{
		$this->validate( 'paymentMethod' );
		switch ( $this->getPaymentMethod() ) {
			case 'ideal':
				$this->validate( 'issuer' );
				if ( $this->getCurrency() != 'EUR' )
					throw new InvalidRequestException( "Curopayment : iDeal only accepts EUR" );
				break;
			case 'mistercash':
				if ( $this->getCurrency() != 'EUR' )
					throw new InvalidRequestException( "Curopayment : Bancontact/Mistercash only accepts EUR" );
				break;
		}
	}
}
