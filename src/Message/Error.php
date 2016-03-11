<?php
/**
 * Created by PhpStorm.
 * User: bram.vaneijk
 * Date: 11-3-2016
 * Time: 16:10
 */

namespace Omnipay\Curo\Message;


class Error extends AbstractResponse {

    /**
     * Is the response successful?
     *
     * @return boolean
     */
    public function isSuccessful() {
        return false;
    }

    public function getRedirectUrl() {
        // TODO: Implement getRedirectUrl() method.
    }
}