<?php

namespace bot\Models;

use RedBeanPHP\Finder;
use bot\Services\RedbeanFactory;
use bot\Validators\AppValidator;
use bot\Exceptions\AlreadyExistsException;
use bot\Exceptions\DataDoesNotExist;


class CategoryModel{

    private $redbeanFactory;
    
    public function __construct(RedbeanFactory $redbeanFactory){
        $this->redbeanFactory = $redbeanFactory;
    }

    public function findbyID($id) {
        $finder = new Finder($this->redbeanFactory->getRedbeanToolbox());
        $exist = $finder->findOne('categories', ' id = ? ', [$id]);

        return ($exist) ? $exist : false;
    }

    public function findDuplicateCategory($category) {
        $finder = new Finder($this->redbeanFactory->getRedbeanToolbox());
        $exist = $finder->findOne('categories', ' category = ? ', [$category]);

        return ($exist) ? $exist : false;
    }

    public function post_category($values){

        $v = new AppValidator($values);

        $v->rules([

            'required' => [ ['category'], ['image'], ['details']]]);

        $v->assert();
        $tb = $this->redbeanFactory->getRedbeanToolbox();
        $r = $tb->getRedBean();

        if ($this->findDuplicateCategory($values['category']) ) {
            throw new AlreadyExistsException("Category $values[category]");
        }

        $data = $r->dispense('categories')->import($values, ['category','image','details']);

        $r->store($data);
        
        return $data;
    }

    public function put_category($id, $values){
        $v = new AppValidator($values);

        $v->rules([
            
            'required' => [['id']]]);

        $v->assert();

        $category = $this->findbyID($values['id']);
        $tb = $this->redbeanFactory->getRedbeanToolbox();
        $r = $tb->getRedBean();

        if (!$this->findbyID($values['id']) ) {
            throw new DataDoesNotExist("Category id $values[id]");
        }

        $category->import($values, ['category', 'image', 'details']);

        $r->store($category);

        return $category;
    }

}