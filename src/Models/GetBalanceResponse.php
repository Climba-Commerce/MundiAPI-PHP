<?php
/*
 * MundiAPILib
 *
 * This file was automatically generated by APIMATIC v2.0 ( https://apimatic.io ).
 */

namespace MundiAPILib\Models;

use JsonSerializable;

/**
 * Balance
 */
class GetBalanceResponse implements JsonSerializable
{
    /**
     * Currency
     * @required
     * @var string $currency public property
     */
    public $currency;

    /**
     * Amount available for transferring
     * @required
     * @maps available_amount
     * @var integer $availableAmount public property
     */
    public $availableAmount;

    /**
     * Recipient
     * @required
     * @var \MundiAPILib\Models\GetRecipientResponse $recipient public property
     */
    public $recipient;

    /**
     * Constructor to set initial or default values of member properties
     * @param string               $currency        Initialization value for $this->currency
     * @param integer              $availableAmount Initialization value for $this->availableAmount
     * @param GetRecipientResponse $recipient       Initialization value for $this->recipient
     */
    public function __construct()
    {
        if (3 == func_num_args()) {
            $this->currency        = func_get_arg(0);
            $this->availableAmount = func_get_arg(1);
            $this->recipient       = func_get_arg(2);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['currency']         = $this->currency;
        $json['available_amount'] = $this->availableAmount;
        $json['recipient']        = $this->recipient;

        return $json;
    }
}
