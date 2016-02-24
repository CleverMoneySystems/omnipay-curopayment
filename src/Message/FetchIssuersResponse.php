<?php

/*
 * Curopayment driver for Omnipay PHP payment processing library
 * https://www.curopayments.com/
 *
 */

namespace Omnipay\Curo\Message;

use Omnipay\Common\Message\AbstractResponse as BaseAbstractResponse;
use Omnipay\Common\Message\FetchIssuersResponseInterface;
use Omnipay\Common\Issuer;

/**
 * FetchIssuersResponse class - it should contain a list of fetched Issuers.
 *
 * @author Martin Schipper martin@cardgate.com
 */
class FetchIssuersResponse extends BaseAbstractResponse implements FetchIssuersResponseInterface {

    /**
     * {@inheritdoc}
     */
    public function isSuccessful() {
        return isset( $this->data['issuers'] );
    }

    /**
     * {@inheritdoc}
     */
    public function getIssuers() {

        $issuers = array();
        if ( isset( $this->data->issuers ) ) {
            foreach ( $this->data['issuers']['issuer'] as $issuer ) {
                $issuers[] = new Issuer( ( string ) $issuer->id, ( string ) $issuer->name );
            }
        }
        return $issuers;
    }

    public function getRedirectUrl() {
        // TODO: Implement getRedirectUrl() method.
    }
}
