<?php

namespace bot\Models;

use RedBeanPHP\Finder;
use bot\Services\RedbeanFactory;
use bot\Validators\AppValidator;
use bot\Exceptions\AlreadyExistsException;
use bot\Exceptions\DataDoesNotExist;

define('TIMEZONE', 'Asia/Hong_Kong');
date_default_timezone_set(TIMEZONE);

class FeedbackModel{

    private $redbeanFactory;
    
    public function __construct(RedbeanFactory $redbeanFactory){
        $this->redbeanFactory = $redbeanFactory;
    }

    public function findbyCustomerID($id) {
        $finder = new Finder($this->redbeanFactory->getRedbeanToolbox());
        $exist = $finder->findOne('customers', ' id = ? ', [$id]);

        return ($exist) ? $exist : false;
    }

    public function post_feedback($values){
        $v = new AppValidator($values);

        $v->rules([

            'required' => [['idcustomer'], 
                          ['title'],
                          ['details']            
                ]]);

        $v->assert();
        $tb = $this->redbeanFactory->getRedbeanToolbox();
        $r = $tb->getRedBean();

        if ( !$this->findbyCustomerID($values['idcustomer']) ) {
            throw new DataDoesNotExist("Customer# $values[idcustomer]");
        }

        $data = $r->dispense('feedbacks')

        ->import($values, [

                      'idcustomer',
                      'title',
                      'details'                     
        ]);

        $r->store($data);
        
        return $data;
    }

}