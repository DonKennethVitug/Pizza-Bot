<?php

namespace bot\Models;

use RedBeanPHP\Finder;
use bot\Services\RedbeanFactory;
use bot\Validators\AppValidator;
use bot\Exceptions\DataDoesNotExist;


class StoreModel{

    private $redbeanFactory;
    
    public function __construct(RedbeanFactory $redbeanFactory){
        $this->redbeanFactory = $redbeanFactory;
    }

public function findbyStoreID($id) {
        $finder = new Finder($this->redbeanFactory->getRedbeanToolbox());
        $exist = $finder->findOne('stores', ' id = ? ', [$id]);

        return ($exist) ? $exist : false;
    }

    public function findById($id) {
        $finder = new Finder($this->redbeanFactory->getRedbeanToolbox());
        $status = $finder->findOne('store_status', ' id = ? ', [$id]);

        return ($status) ? $status : false;
    }

public function post_store($values){

        $v = new AppValidator($values);

        $v->rules([

            'required' => [['idstore_status'],['branch'],['location_longitude'],['location_latitude'],['phonenumber']]]);

        $v->assert();
        $tb = $this->redbeanFactory->getRedbeanToolbox();
        $r = $tb->getRedBean();

        $store_status = $this->findById($values['idstore_status']);

        if(!$store_status){

            throw new DataDoesNotExist("Store id $values[idstore_status]");
        }       

        $data = $r->dispense('stores')->import($values, ['idstore_status','branch','location_longitude','location_latitude','phonenumber']);

        $r->store($data);
        $response_array['status'] = 'success';
        
        return $data;
    } 

    public function put_store($id, $values){
        $v = new AppValidator($values);

        $v->rules([
            
            'required' => [['id']]]);

        $v->assert();

        $data = $this->findbyStoreID($values['id']);
        $tb = $this->redbeanFactory->getRedbeanToolbox();
        $r = $tb->getRedBean();

        if (!$this->findbyStoreID($values['id']) ) {
            throw new DataDoesNotExist("Store id $values[id]");
        }

        $store_status = $this->findById($values['idstore_status']);

        $data->import($values, ['idstore_status','branch','location_longitude','location_latitude','phonenumber']);

        $r->store($data);

        return $data;
    }

}