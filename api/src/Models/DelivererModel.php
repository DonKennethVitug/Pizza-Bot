<?php

namespace bot\Models;

use RedBeanPHP\Finder;
use bot\Services\RedbeanFactory;
use bot\Validators\AppValidator;
use bot\Exceptions\DataDoesNotExist;


class DelivererModel{

    private $redbeanFactory;
    
    public function __construct(RedbeanFactory $redbeanFactory){
        $this->redbeanFactory = $redbeanFactory;
    }

     public function findbyID($id) {
        $finder = new Finder($this->redbeanFactory->getRedbeanToolbox());
        $exist = $finder->findOne('deliverer', ' id = ? ', [$id]);

        return ($exist) ? $exist : false;
    }

    public function add_deliverer($values){

        $v = new AppValidator($values);

        $v->rules([

            'required' => [ ['fullname']]]);

        $v->assert();
        $tb = $this->redbeanFactory->getRedbeanToolbox();
        $r = $tb->getRedBean();

        $data = $r->dispense('deliverer')->import($values, ['fullname']);

        $r->store($data);
       
        return $data;
    }


    public function put_deliverer($id, $values){
        $v = new AppValidator($values);

        $v->rules([
            
            'required' => [['id']]]);

        $v->assert();

        $data = $this->findbyID($values['id']);
        $tb = $this->redbeanFactory->getRedbeanToolbox();
        $r = $tb->getRedBean();

        if (!$this->findbyID($values['id']) ) {
            throw new DataDoesNotExist("Deliverer id $values[id]");
        }

        $data->import($values, ['fullname']);

        $r->store($data);

        return $data;
    }
}