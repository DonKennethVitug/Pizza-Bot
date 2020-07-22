<?php

namespace bot\Exceptions;

use bot\Interfaces\APIExceptionInterface;
use ReflectionClass;

class AlreadyExistsException extends ApplicationException implements APIExceptionInterface {

    private $errorSource;

    /**
     * @return int
     */

public function __construct($errorSource) {

        $this->errorSource = $errorSource;
    }

    public function getStatus() {
        return 401;
    }

    /**
     * @return array
     */
    public function getDetails() {
        return [
            'error' => (new ReflectionClass($this))->getShortName(),
            'message' => "$this->errorSource already exists."
        ];
    }

}
