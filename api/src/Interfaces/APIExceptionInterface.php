<?php

namespace bot\Interfaces;

interface APIExceptionInterface {
    /**
     * @return int
     */
    public function getStatus();
    /**
     * @return array
     */
    public function getDetails();

}