<?php

/*
 * Curopayment driver for Omnipay PHP payment processing library
 * https://www.curopayments.com
 *
 */
namespace Omnipay\Curo;

use Omnipay\Common\AbstractGateway;

/**
 * Curopayment Omnipay gateway class
 *
 * @author Martin Schipper martin@cardgate.com
 */
class Gateway extends AbstractGateway
{

	// ------------ Some neccesary evil ------------ //

    /**
     * {@inheritdoc}
     */
	public function getName ()
	{
		return 'Curopayment';
	}

    /**
     * {@inheritdoc}
     */
	public function getDefaultParameters ()
	{
		return array(
				'merchantId' => '',
				'language' => 'nl',
				'apiKey' => '',
				'siteId' => '',
				'notifyUrl' => '',
				'returnUrl' => '',
				'cancelUrl' => '',
				'testMode' => false
		);
	}

	// ------------ Getter'n'Setters ------------ //

	/**
	 *
	 * @return string
	 */
	public function getApiKey ()
	{
		return $this->getParameter( 'apiKey' );
	}

	/**
	 *
	 * @param string $value
	 * @return \Omnipay\Curo\Gateway
	 */
	public function setApiKey ( $value )
	{
		return $this->setParameter( 'apiKey', $value );
	}

	/**
	 *
	 * @return string
	 */
	public function getMerchantId ()
	{
		return $this->getParameter( 'merchantId' );
	}

	/**
	 *
	 * @param string $value
	 * @return \Omnipay\Curo\Gateway
	 */
	public function setMerchantId ( $value )
	{
		return $this->setParameter( 'merchantId', $value );
	}

	/**
	 *
	 * @return string
	 */
	public function getSiteId ()
	{
		return $this->getParameter( 'siteId' );
	}

	/**
	 *
	 * @param string $value
	 * @return \Omnipay\Curo\Gateway
	 */
	public function setSiteId ( $value )
	{
		return $this->setParameter( 'siteId', $value );
	}

	/**
	 *
	 * @return string
	 */
	public function getIpAddress ()
	{
		return $this->getParameter( 'ipaddress' );
	}

	/**
	 *
	 * @param string $value
	 * @return \Omnipay\Curo\Gateway
	 */
	public function setIpAddress ( $value )
	{
		return $this->setParameter( 'ipaddress', $value );
	}

	/**
	 *
	 * @return string
	 */
	public function getNotifyUrl ()
	{
		return $this->getParameter( 'notifyUrl' );
	}

	/**
	 *
	 * @param string $value
	 * @return \Omnipay\Curo\Gateway
	 */
	public function setNotifyUrl ( $value )
	{
		return $this->setParameter( 'notifyUrl', $value );
	}

	/**
	 *
	 * @return string
	 */
	public function getReturnUrl ()
	{
		return $this->getParameter( 'returnUrl' );
	}

	/**
	 *
	 * @param string $value
	 * @return \Omnipay\Curo\Gateway
	 */
	public function setReturnUrl ( $value )
	{
		return $this->setParameter( 'returnUrl', $value );
	}

	/**
	 *
	 * @return string
	 */
	public function getCancelUrl ()
	{
		return $this->getParameter( 'cancelUrl' );
	}

	/**
	 *
	 * @param string $value
	 * @return \Omnipay\Curo\Gateway
	 */
	public function setCancelUrl ( $value )
	{
		return $this->setParameter( 'cancelUrl', $value );
	}

	/**
	 *
	 * @return string
	 */
	public function getLanguage ()
	{
		return $this->getParameter( 'language' );
	}

	/**
	 *
	 * @param string $value
	 * @return \Omnipay\Curo\Gateway
	 */
	public function setLanguage ( $value )
	{
		return $this->setParameter( 'language', $value );
	}

	/**
	 *
	 * @return string
	 */
	/*
	 * public function getPaymentMethod()
	 * {
	 * return $this->getParameter( 'paymentMethod' );
	 * }
	 */
	/**
	 *
	 * @param string $value
	 * @return \Omnipay\Curo\Gateway
	 */
	/*
	 * public function setPaymentMethod( $value )
	 * {
	 * return $this->setParameter( 'paymentMethod', $value );
	 * }
	 */

	// ------------ Requests ------------ //

	/**
	 * Retrieve iDEAL issuers.
	 *
	 * @param array $parameters
	 *        	An array of options
	 *
	 * @return \Omnipay\Curo\Message\FetchIssuersRequest
	 */
	public function fetchIssuers ( array $parameters = array() )
	{
		return $this->createRequest( '\Omnipay\Curo\Message\FetchIssuersRequest', $parameters );
	}

	/**
	 * Retrieve the payment methods.
	 *
	 * @param array $parameters
	 *        	An array of options
	 *
	 * @return \Omnipay\Curo\Message\FetchPaymentMethodsRequest
	 */
	public function fetchPaymentMethods ( array $parameters = array() )
	{
		return $this->createRequest( '\Omnipay\Curo\Message\FetchPaymentMethodsRequest', $parameters );
	}

	/**
	 * Start a purchase request.
	 *
	 * @param array $parameters
	 *        	An array of options
	 *
	 * @return \Omnipay\Curo\Message\PurchaseRequest
	 */
	public function purchase ( array $parameters = array() )
	{
		return $this->createRequest( '\Omnipay\Curo\Message\PurchaseRequest', $parameters );
	}

	/**
	 * Complete a purchase / retreive transaction status
	 *
	 * @param array $parameters
	 *        	An array of options ( array ( 'transactionId' => $id ) )
	 *
	 * @return \Omnipay\Curo\Message\CompletePurchaseRequest
	 */
	public function completePurchase ( array $parameters = array() )
	{
		return $this->createRequest( '\Omnipay\Curo\Message\CompletePurchaseRequest', $parameters );
	}
}
