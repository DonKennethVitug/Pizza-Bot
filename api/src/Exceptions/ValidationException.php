<?php

namespace bot\Exceptions;

use bot\Interfaces\APIExceptionInterface;
/**
 * Description of ValidationException
 *
 * @author Philip
 */
class ValidationException extends ApplicationException implements APIExceptionInterface {

    /**
     * @var string[]
     */
    private $messages;

    /**
     * @param array $messages Validation messages
     */
    public  function __construct(array $messages) {
        parent::__construct();
        $this->messages = $messages;
    }

    /**
     * @return string[]
     */
    public function getMessages() {
        return $this->messages;
    }

    public function getDetails() {
        return [
            'error' => (new \ReflectionClass($this))->getShortName(),
            'message' => 'There were invalid values in the input.',
            'invalidFields' => $this->messages
        ];
    }

    public function getStatus() {
        return 400;
    }

}
