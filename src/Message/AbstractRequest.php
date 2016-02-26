<?php

/*
 * Curopayment driver for Omnipay PHP payment processing library
 * https://www.curopayments.com
 *
 */
namespace Omnipay\Curo\Message;

use \Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;

/**
 * AbstractRequest class
 *
 * @author Martin Schipper martin@cardgate.com
 */
abstract class AbstractRequest extends BaseAbstractRequest
{

    /**
     * Get live- or testURL.
     */
    public function getUrl()
    {
        if ($this->getTestMode()) {
            return 'https://secure-staging.curopayments.net/rest/v1/';
        } else {
            return 'https://secure.curopayments.net/rest/v1/';
        }
    }

    /**
     *
     */
    protected function setSslVerification()
    {
        if ($this->getTestMode())
            $this->httpClient->setSslVerification(false, false, 0); // disable ssl cert check
        else
            $this->httpClient->setSslVerification(); // set to defaults
    }

    // ------------ Request specific Getter'n'Setters ------------ //

    // ------------ Getter'n'Setters ------------ //

    /**
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->getParameter('apiKey');
    }

    /**
     *
     * @param string $value
     * @return \Omnipay\Curo\Gateway
     */
    public function setApiKey($value)
    {
        return $this->setParameter('apiKey', $value);
    }

    /**
     *
     * @return string
     */
    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    /**
     *
     * @param string $value
     * @return \Omnipay\Curo\Gateway
     */
    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

    /**
     *
     * @return string
     */
    public function getSiteId()
    {
        return $this->getParameter('siteId');
    }

    /**
     *
     * @param string $value
     * @return \Omnipay\Curo\Gateway
     */
    public function setSiteId($value)
    {
        return $this->setParameter('siteId', $value);
    }

    /**
     *
     * @return string
     */
    public function getIpAddress()
    {
        return $this->getParameter('ipaddress');
    }

    /**
     *
     * @param string $value
     * @return \Omnipay\Curo\Gateway
     */
    public function setIpAddress($value)
    {
        return $this->setParameter('ipaddress', $value);
    }

    /**
     *
     * @return string
     */
    public function getNotifyUrl()
    {
        return $this->getParameter('notifyUrl');
    }

    /**
     *
     * @param string $value
     * @return \Omnipay\Curo\Gateway
     */
    public function setNotifyUrl($value)
    {
        return $this->setParameter('notifyUrl', $value);
    }

    /**
     *
     * @return string
     */
    public function getReturnUrl()
    {
        return $this->getParameter('returnUrl');
    }

    /**
     *
     * @param string $value
     * @return \Omnipay\Curo\Gateway
     */
    public function setReturnUrl($value)
    {
        return $this->setParameter('returnUrl', $value);
    }

    /**
     *
     * @return string
     */
    public function getCancelUrl()
    {
        return $this->getParameter('cancelUrl');
    }

    /**
     *
     * @param string $value
     * @return \Omnipay\Curo\Gateway
     */
    public function setCancelUrl($value)
    {
        return $this->setParameter('cancelUrl', $value);
    }

    /**
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->getParameter('language');
    }

    /**
     *
     * @param string $value
     * @return \Omnipay\Curo\Gateway
     */
    public function setLanguage($value)
    {
        return $this->setParameter('language', $value);
    }

    /**
     *
     * @return string
     */
    public function getIsCuroProtocol()
    {
        return $this->getParameter('isCuroProtocol');
    }

    /**
     *
     * @param string $value
     * @return \Omnipay\Curo\Gateway
     */
    public function setIsCuroProtocol($value)
    {
        return $this->setParameter('isCuroProtocol', $value);
    }

    /**
     * @return mixed
     */
    public function getCustomer()
    {
        return $this->getParameter('customer');
    }

    /**
     *
     * @param string $value
     * @return \Omnipay\Curo\Gateway
     */
    public function setCustomer($value)
    {
        return $this->setParameter('customer', $value);
    }
}
