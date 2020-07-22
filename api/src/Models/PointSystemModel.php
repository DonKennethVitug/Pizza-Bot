<?php

namespace bot\Models;

use RedBeanPHP\Finder;
use bot\Services\RedbeanFactory;
use bot\Validators\AppValidator;
use bot\Exceptions\DataDoesNotExist;
use bot\Exceptions\AlreadyExistsException;


class PointSystemModel{

    private $redbeanFactory;
    
    public function __construct(RedbeanFactory $redbeanFactory){
        $this->redbeanFactory = $redbeanFactory;
    }

     public function findbyCustomerID($id) {
        $finder = new Finder($this->redbeanFactory->getRedbeanToolbox());
        $exist = $finder->findOne('customers', ' id = ? ', [$id]);

        return ($exist) ? $exist : false;
    }

     public function findDuplicateID($idcustomer_points) {
        $finder = new Finder($this->redbeanFactory->getRedbeanToolbox());
        $exist = $finder->findOne('points_system', ' idcustomer_points = ? ', [$idcustomer_points]);

        return ($exist) ? $exist : false;
    }

    public function post_points($values){

        $v = new AppValidator($values);

        $v->rules([

            'required' => [['idcustomer_points'], ['points']]]);

        $v->assert();
        $tb = $this->redbeanFactory->getRedbeanToolbox();
        $r = $tb->getRedBean();

          if ( !$this->findbyCustomerID($values['idcustomer_points']) ) {
            throw new DataDoesNotExist("Customer# $values[idcustomer_points]");
        }

        else if ($this->findDuplicateID($values['idcustomer_points']) ) {
            throw new AlreadyExistsException("Perform Update: Customer# $values[idcustomer_points]");
        }

        $data = $r->dispense('points_system')->import($values, ['idcustomer_points','points']);

        $r->store($data);

        return $data;
    } 


    public function put_points($id, $values){
        $v = new AppValidator($values);

        $v->rules([
            
            'required' => [['idcustomer_points'],['points']]]);

        $v->assert();

        $points = $this->findDuplicateID($values['idcustomer_points']);
        $tb = $this->redbeanFactory->getRedbeanToolbox();
        $r = $tb->getRedBean();

        $values['points'] += $points->points; //continuously add points (- value deducts points)
        $points->import($values, ['points']);

        $r->store($points);

        return $points;
    }

}