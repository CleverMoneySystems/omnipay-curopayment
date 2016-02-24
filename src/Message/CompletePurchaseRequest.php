<?php

/*
 * CardGate driver for Omnipay PHP payment processing library
 * https://www.curopayments.com/
 */
namespace Omnipay\Curo\Message;

use Guzzle\Http\Exception\BadResponseException;

/**
 * CompletePurchaseRequest class - It requests information about the
 * transaction's status
 *
 * @author Martin Schipper martin@cardgate.com
 */
class CompletePurchaseRequest extends PurchaseRequest
{

	protected $endpoint = 'transactions/';

    /**
     * {@inheritdoc}
     */
	public function getData ()
	{
		$this->validate( 'transactionId' );
		return array(
				'id' => $this->getTransactionId()
		);
	}

    /**
     * {@inheritdoc}
     */
	public function sendData ( $data )
	{

		// Test-API SSL cert issue
		$this->setSslVerification();

		$this->httpClient->setBaseUrl( $this->getUrl() .($this->getIsCuroProtocol() ? '/curo/' : ''). $this->endpoint . $this->getTransactionId() );
		$request = $this->httpClient->get( null, null, array(
				'transaction' => $data
		) );

		$request->setAuth( $this->getMerchantId(), $this->getApiKey() );
		$request->addHeader( 'Accept', 'application/json' );

		try {
			$httpResponse = $request->send();
		} catch ( BadResponseException $e ) {
			if ( $this->getTestMode() ) {
				throw new BadResponseException( "Curopayment RESTful API gave : " . $e->getResponse()->getBody( true ) );
			} else {
				throw $e;
			}
		}

		return new CompletePurchaseResponse( $this, $httpResponse->json() );
	}
}
