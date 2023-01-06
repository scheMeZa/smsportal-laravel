<?php

namespace ScheMeZa\SMSPortal;

class ReplacementsException extends \Exception
{

    /**
     * codes: 1001 = using replacements with single phone number (string); 1002 = phonenumber array and replacements array mismatch
     */
    public function __construct($message, $code = 1000, \Throwable $previous = null) {
        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
    
}