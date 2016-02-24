<?php

/*
 * CardGate driver for Omnipay PHP payment processing library
 * https://www.curopayments.com/
 *
 */

namespace Omnipay\Curo\Message;

use Guzzle\Http\Exception\BadResponseException;

/**
 * FetchIssuersRequest class - it fetches Issuers.
 *
 * @author Martin Schipper martin@cardgate.com
 */
class FetchIssuersRequest extends AbstractRequest {

    protected $endpoint = 'ideal/issuers/';

    /**
     * {@inheritdoc}
     */
    public function getData() {
        return array();
    }

    /**
     * {@inheritdoc}
     */
    public function sendData( $data ) {

        // Test-API SSL cert issue
        $this->setSslVerification();

        $request = $this->httpClient->get( $this->getUrl() .($this->getIsCuroProtocol() ? '/curo/' : ''). $this->endpoint );
        $request->setAuth( $this->getMerchantId(), $this->getApiKey() );
        $request->setHeader( 'Content-type', 'application/json' );
        $request->addHeader( 'Accept', 'application/json' );

        try {
            $httpResponse = $request->send();
        } catch (BadResponseException $e) {
            if ( $this->getTestMode() ) throw new BadResponseException( "CuroPayment RESTful API gave : " . $e->getResponse()->getBody( true ) );
            throw $e;
        }

        return $this->response = new FetchIssuersResponse ($this, $httpResponse->json() );

    }

}
