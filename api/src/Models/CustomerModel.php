<?php

namespace bot\Models;

use RedBeanPHP\Finder;
use bot\Services\RedbeanFactory;
use bot\Validators\AppValidator;
use bot\Exceptions\AlreadyExistsException;
use bot\Exceptions\DataDoesNotExist;

define('TIMEZONE', 'Asia/Manila');
date_default_timezone_set(TIMEZONE);

class CustomerModel{

    private $redbeanFactory;
    
    public function __construct(RedbeanFactory $redbeanFactory){
        $this->redbeanFactory = $redbeanFactory;
    }

    public function findbyID($id) {
        $finder = new Finder($this->redbeanFactory->getRedbeanToolbox());
        $exist = $finder->findOne('customers', ' id = ? ', [$id]);

        return ($exist) ? $exist : false;
    }

    public function findbyCustomerNum($customernum) {
        $finder = new Finder($this->redbeanFactory->getRedbeanToolbox());
        $user = $finder->findOne('customers', ' customernum = ? ', [$customernum]);

        return ($user) ? $user : false;
    }

    public function post_customer($values){
        $v = new AppValidator($values);

        $v->rules([

            'required' =>  
                
                          ['password'],
                          ['fname'],
                          ['lname'],
                          ['address'],
                          ['phonenumber']
                          //I will uncomment both once its in production or needed okay :) 
                         // ['prev_location'], 
                        //['pres_location'],
                
                ]);

        $v->assert();
        $tb = $this->redbeanFactory->getRedbeanToolbox();
        $r = $tb->getRedBean();

        if ( $this->findbyCustomerNum($values['customernum']) ) {
            throw new AlreadyExistsException("Customer# $values[customernum]");
            
        }

        //GENERATES UNIQUE ID FOR CUSTOMER BASED ON THE DATE REGISTERED
       $t = microtime(true);
       $micro = sprintf("%06d",($t - floor($t)) * 1000);
       $UNIQ = date('YmHis'.$micro, $t);
       $values['customernum'] = "CUST-$UNIQ";

        $data = $r->dispense('customers')

      
        ->import($values, [

                      'customernum',
                      'fname',
                      'lname',
                      'address',
                      'phonenumber'

                      //I will uncomment both once its in production or needed okay :) 
                      //'prev_location',
                      //'pres_location'
        ])

        ->import([

                      'password' => md5($values['password']), //encrypt password
                      'datejoined' => date("Y-m-d H:i:s")
                    
        ]);

        $r->store($data);

        return $data;
    }

    public function put_customer($id, $values){
        $v = new AppValidator($values);

        $v->rules([
            
            'required' => [['id']]]);

        $v->assert();

        $data = $this->findbyID($values['id']);
        $tb = $this->redbeanFactory->getRedbeanToolbox();
        $r = $tb->getRedBean();

        if (!$this->findbyID($values['id']) ) {
            throw new DataDoesNotExist("Customer id $values[id]");
        }

        $data->import($values, ['idpoint',
                                'customernum',
                                'fname',
                                'lname',
                                'address',
                                'phonenumber',
                                'prev_location',
                                'pres_location' ])
        ->import([
                      'password' => md5($values['password']),
                      'datejoined' => date("Y-m-d H:i:s")
        ]);

        $r->store($data);
        
        return $data;
    } 

}