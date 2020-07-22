<?php

namespace bot\Exceptions;

use bot\Interfaces\APIExceptionInterface;
use ReflectionClass;

class DataDoesNotExist extends ApplicationException implements APIExceptionInterface {

    private $errorSource;

    /**
     * @return int
     */
    public function getStatus() {
        return 400;
    }

    /**
     * @return array
     */
    public function getDetails() {
        return [
            'error' => (new ReflectionClass($this))->getShortName(),
            'message' =>  "$this->errorSource does not exist"
        ];
    }

    public function __construct($errorSource) {

        $this->errorSource = $errorSource;
    }

}
