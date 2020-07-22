<?php

namespace bot\Models;

use RedBeanPHP\Finder;
use bot\Services\RedbeanFactory;
use bot\Validators\AppValidator;
use bot\Exceptions\DataDoesNotExist;


class OrderModel{

    private $redbeanFactory;
    
    public function __construct(RedbeanFactory $redbeanFactory){
        $this->redbeanFactory = $redbeanFactory;
    }

    

    public function post_orders($values){


        $v = new AppValidator($values);

        $v->rules([

            'required' => [['idmenu'],['idtransaction'],['qty'],['amount']]
            ]);

        $v->assert();
        $tb = $this->redbeanFactory->getRedbeanToolbox();
        $r = $tb->getRedBean();

        //

        $data = $r->dispense('orders')->import($values, ['idmenu','idtransaction','qty','amount']);
        $r->store($data);
        return $data;

       // }
        
    } 
}