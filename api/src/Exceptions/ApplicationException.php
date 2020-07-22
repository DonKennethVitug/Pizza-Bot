<?php

namespace bot\Exceptions;

use Exception;
use ReflectionClass;
use bot\Interfaces\APIExceptionInterface;

class ApplicationException extends Exception implements APIExceptionInterface {

    public function getDetails() {
        $message = $this->getMessage();
        if( !empty($message) ) $message = " $message";

        return [
            'error' => (new ReflectionClass($this))->getShortName(),
            'userMessage' => 'Server error.' .  $message
        ];
    }

    public function getStatus() {
        return 500;
    }

}