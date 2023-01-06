<?php

namespace ScheMeZa\SMSPortal;

class EmptyPhoneNumberException extends \Exception
{

    /**
     * codes: 3001 = specific code for string (single) phone number. 3002 = specific code for multiple (array) phone numbers
     */

    public function __construct($message, $code = 3000, \Throwable $previous = null) {
        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
    
}