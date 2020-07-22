<?php

namespace bot\Models;

use RedBeanPHP\Finder;
use bot\Services\RedbeanFactory;
use bot\Validators\AppValidator;


class AnnouncementModel{

    private $redbeanFactory;
    
    public function __construct(RedbeanFactory $redbeanFactory){
        $this->redbeanFactory = $redbeanFactory;
    }

public function post_announcement($values){
        $v = new AppValidator($values);

        $v->rules(['required' => [['image'], ['details'], ['linkurl']]]);

        $v->assert();
        $tb = $this->redbeanFactory->getRedbeanToolbox();
        $r = $tb->getRedBean();
        $data = $r->dispense('announcements')->import($values, ['image','details','linkurl']);
        $r->store($data);

        return $data;
        
    }

}