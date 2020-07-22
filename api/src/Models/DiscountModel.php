<?php

namespace bot\Models;

use RedBeanPHP\Finder;
use bot\Services\RedbeanFactory;
use bot\Validators\AppValidator;
use bot\Exceptions\DataDoesNotExist;


class DiscountModel{

    private $redbeanFactory;
    
    public function __construct(RedbeanFactory $redbeanFactory){
        $this->redbeanFactory = $redbeanFactory;
    }

    public function findbyID($id) {
        $finder = new Finder($this->redbeanFactory->getRedbeanToolbox());
        $exist = $finder->findOne('discounts', ' id = ? ', [$id]);

        return ($exist) ? $exist : false;
    }

    public function post_discount($values){

        $v = new AppValidator($values);

        $v->rules([

            'required' => [['details'], ['discount']]]);

        $v->assert();
        $tb = $this->redbeanFactory->getRedbeanToolbox();
        $r = $tb->getRedBean();

        $data = $r->dispense('discounts')->import($values, ['details','discount']);

        $r->store($data);

        return $data;
    }

    public function put_discount($id, $values){
        $v = new AppValidator($values);

        $v->rules([
            
            'required' => [['id']]]);

        $v->assert();

        $data = $this->findbyID($values['id']);
        $tb = $this->redbeanFactory->getRedbeanToolbox();
        $r = $tb->getRedBean();

        if (!$this->findbyID($values['id']) ) {
            throw new DataDoesNotExist("Discount id $values[id]");
        }

        $data->import($values, ['details', 'discount']);

        $r->store($data);
        
        return $data;
    } 

}