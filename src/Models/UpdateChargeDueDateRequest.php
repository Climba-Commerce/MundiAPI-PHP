<?php
/*
 * MundiAPILib
 *
 * This file was automatically generated by APIMATIC v2.0 ( https://apimatic.io ).
 */

namespace MundiAPILib\Models;

use JsonSerializable;
use MundiAPILib\Utils\DateTimeHelper;

/**
 * Request for updating a charge due date
 */
class UpdateChargeDueDateRequest implements JsonSerializable
{
    /**
     * The charge's new due date
     * @maps due_at
     * @factory \MundiAPILib\Utils\DateTimeHelper::fromRfc3339DateTime
     * @var \DateTime|null $dueAt public property
     */
    public $dueAt;

    /**
     * Constructor to set initial or default values of member properties
     * @param \DateTime $dueAt Initialization value for $this->dueAt
     */
    public function __construct()
    {
        if (1 == func_num_args()) {
            $this->dueAt = func_get_arg(0);
        }
    }


    /**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        $json = array();
        $json['due_at'] = isset($this->dueAt) ?
            DateTimeHelper::toRfc3339DateTime($this->dueAt) : null;

        return $json;
    }
}
