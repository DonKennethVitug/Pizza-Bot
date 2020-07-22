<?php

namespace bot\Models;

use RedBeanPHP\Finder;
use bot\Services\RedbeanFactory;
use bot\Validators\AppValidator;
use bot\Exceptions\DataDoesNotExist;


class TaxModel{

    private $redbeanFactory;
    
    public function __construct(RedbeanFactory $redbeanFactory){
        $this->redbeanFactory = $redbeanFactory;
    }

    public function findbyID($id) {
        $finder = new Finder($this->redbeanFactory->getRedbeanToolbox());
        $exist = $finder->findOne('tax', ' id = ? ', [$id]);

        return ($exist) ? $exist : false;
    }

public function post_tax($values){

        $v = new AppValidator($values);

        $v->rules([

            'required' => [['tax']]]);

        $v->assert();
        $tb = $this->redbeanFactory->getRedbeanToolbox();
        $r = $tb->getRedBean();

        $data = $r->dispense('tax')->import($values, ['tax']);

        $r->store($data);
        
        return $data;
    } 

    public function put_tax($id, $values){
        $v = new AppValidator($values);

        $v->rules([
            
            'required' => [['id']]]);

        $v->assert();

        $data = $this->findbyID($values['id']);
        $tb = $this->redbeanFactory->getRedbeanToolbox();
        $r = $tb->getRedBean();

        if (!$this->findbyID($values['id']) ) {
            throw new DataDoesNotExist("Tax id $values[id]");
        }

        $data->import($values, ['tax']);

        $r->store($data);
        
        return $data;
    } 

}