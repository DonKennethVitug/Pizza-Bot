<?php

namespace bot\Models;

use RedBeanPHP\Finder;
use bot\Services\RedbeanFactory;
use bot\Validators\AppValidator;
use bot\Exceptions\DataDoesNotExist;


class MenuModel{

    private $redbeanFactory;
    
    public function __construct(RedbeanFactory $redbeanFactory){
        $this->redbeanFactory = $redbeanFactory;
    }

    public function findmenuID($id) {
        $finder = new Finder($this->redbeanFactory->getRedbeanToolbox());
        $exist = $finder->findOne('menus', ' id = ? ', [$id]);

        return ($exist) ? $exist : false;
    }

    public function findById($id) {
        $finder = new Finder($this->redbeanFactory->getRedbeanToolbox());
        $status = $finder->findOne('categories', ' id = ? ', [
            $id,
        ]);

        return ($status) ? $status : false;
    }

    public function post_menu($values){

        $v = new AppValidator($values);

        $v->rules([

            'required' => [ ['idcategory'], ['image'], ['name'], ['details'], ['price']]]);

        $v->assert();
        $tb = $this->redbeanFactory->getRedbeanToolbox();
        $r = $tb->getRedBean();

         $exist = $this->findById($values['idcategory']);

        if(!$exist){

            throw new DataDoesNotExist("Category id $values[idcategory]");
        }     

        $data = $r->dispense('menus')->import($values, ['idcategory','image','name','details','price']);

        $r->store($data);
        
        return $data;
    }

    public function put_menu($id, $values){
        $v = new AppValidator($values);

        $v->rules([
            
            'required' => [['id']]]);

        $v->assert();

        $data = $this->findmenuID($values['id']);
        $tb = $this->redbeanFactory->getRedbeanToolbox();
        $r = $tb->getRedBean();

        if (!$this->findmenuID($values['id']) ) {
            throw new DataDoesNotExist("Menu id $values[id]");
        }

        $data->import($values, ['idcategory','image','name','details','price']);

        $r->store($data);
        
        return $data;   
    } 

}