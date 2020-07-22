<?php

namespace bot\Validators;

use bot\Exceptions\ValidationException;
use Valitron\Validator;

class AppValidator extends Validator {

    private $data;

    static public function create($data, $fields = array(), $lang = null, $langDir = null) {
        return new static($data, $fields, $lang, $langDir);
    }

    public function __construct($data, $fields = [], $lang = null, $langDir = null) {
        parent::__construct($data, $fields, $lang, $langDir);

        static::$_ruleMessages['notEmptyString'] = 'should not be an empty string.';
    }

    public function assert() {
        if( !$this->validate() )
            throw new ValidationException($this->errors());
    }

    public function rules($rules) {
        parent::rules($rules);
        return $this;
    }

    protected function existingGetPart($data, $identifiers) {
        // Catches the case where the field is an array of discrete values
        if (is_array($identifiers) && count($identifiers) === 0) {
            return array($data, false);
        }

        $identifier = array_shift($identifiers);
        // Glob match
        if ($identifier === '*') {
            $values = array();

            foreach ($data as $key => $row) {
                list($value, $multiple) = $this->existingGetPart($row, $identifiers);
                if ( $multiple === true ) {
                    $values = array_merge($values, $value);
                }
                else if( $multiple === false ) {
                    $values[$key] = $value;
                }

            }

            return array($values, true);
        }

        // Dead end, abort
        elseif ($identifier === NULL ) {
            return array(null, false);
        }

        elseif( !key_exists($identifier,$data) ) {
            return array(null, null);
        }

        // Match array element
        elseif (count($identifiers) === 0) {
            if( key_exists($identifier, $data) )
                return array($data[$identifier], false);
        }

        // We need to go deeper
        else {
            return $this->existingGetPart($data[$identifier], $identifiers);
        }
    }

    /**
     * Overridden specifically for JSON objects.
     * Difference with original implementation is that when a field is "required"
     * it only means that the key is present. Original implementation treats
     * nulls and empty strings and nonpresent values as the same.
     */
    public function validate() {
        foreach ($this->_validations as $v) {
            foreach ($v['fields'] as $field) {
                $fieldParts = explode('.', $field);
                list($values, $multiple) = $this->existingGetPart($this->_fields, $fieldParts);

                // Don't validate if the field is not required and there is no value set

                if ($v['rule'] !== 'required' && !$this->hasRule('required', $field) ) {
                    if ( $multiple === NULL )
                        continue;
                }

                // Edge cases for when the field is required
                else {

                    // TODO -- needs group requires: when a field is specified,
                    // other parts of the same group must also be specified


                    // if field is multiple, but values are not set, fail
                    if( $multiple === true )  {
                        $actualValues = $this->getPart($this->_fields, explode('.', $field) );

                        if( count($values) < count($actualValues) ) {
                            $this->error($field, $v['message'], $v['params']);
                            continue;
                        }

                    }

                }

                // Callback is user-specified or assumed method on class
                if (isset(static::$_rules[$v['rule']])) {
                    $callback = static::$_rules[$v['rule']];
                } else {
                    $callback = array($this, 'validate' . ucfirst($v['rule']));
                }

                if (!$multiple) {
                    $values = array($values);
                }

                $result = true;
                foreach ($values as $value) {
                    $result = $result && call_user_func($callback, $field, $value, $v['params']);
                }

                if (!$result) {
                    $this->error($field, $v['message'], $v['params']);
                }
            }
        }

        return count($this->errors()) === 0;
    }

    protected function validateNotEmptyString($field, $value) {
        return ( $value !== '' && is_string($value) );
    }

    protected function validateFloat($field, $value) {
        return ( is_float($value) );
    }

}