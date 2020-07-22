<?php

namespace bot\Models;

use RedBeanPHP\Finder;
use bot\Services\RedbeanFactory;
use bot\Validators\AppValidator;
use bot\Exceptions\DataDoesNotExist;

define('TIMEZONE', 'Asia/Manila');
date_default_timezone_set(TIMEZONE);

class TransactionModel{

    private $redbeanFactory;
    
    public function __construct(RedbeanFactory $redbeanFactory){
        $this->redbeanFactory = $redbeanFactory;
    }

    //this function is used to check if there is an existing store.
    public function findById($id) {
        $finder = new Finder($this->redbeanFactory->getRedbeanToolbox());
        $store = $finder->findOne('stores', ' id = ? ', [
            $id,
        ]);


        return ($store) ? $store : false;
    }

    public function findByTransactionID($transactionnum){
        $finder = new Finder($this->redbeanFactory->getRedbeanToolbox());
        $orders = $finder->find('orders', ' transactionnum = ? ', [
            $transactionnum,
        ]);

        return ($orders) ? $orders : false;
    }

    //this function is used to check for duplicate transaction ID's
     public function findDuplicateID($id) {
        $finder = new Finder($this->redbeanFactory->getRedbeanToolbox());
        $exist = $finder->findOne('transactions', ' id = ? ', [$id]);

        return ($exist) ? $exist : false;
    }

    //The purpose of this function is to target the menu item and get its amount.
     public function findMenubyID($id) {
        $finder = new Finder($this->redbeanFactory->getRedbeanToolbox());
        $exist = $finder->findOne('menus', ' id = ? ', [$id,]);

        return ($exist) ? $exist : false;
    }

     //Model for POST Request
     public function post_transaction($values){

        $v = new AppValidator($values);

        $v->rules([

            'required' => [['idcustomer'],
                          ['idtrans_status'],
                          ['idstore'],
                          ['iddiscount'],
                          ['idtax'],
                          ['iddeliverer'],
                          ['transactionnum'],
                          ['orders']
                          ]]);

        $v->assert();

       
        $tb = $this->redbeanFactory->getRedbeanToolbox();
        $r = $tb->getRedBean();

        $store = $this->findById($values['idstore']);
        
        if(!$store){

            throw new DataDoesNotExist("Store id $values[idstore]");
        }

        //stores data to transaction table
        $data[0] = $r->dispense('transactions')

        ->import($values, ['idcustomer',
                           'idtrans_status',
                           'idstore',
                           'iddiscount',
                           'idtax',
                           'iddeliverer',
                           'transactionnum'])

        ->import(['dt_created' => date("Y-m-d H:i:s")]);

        $r->store($data[0]);
        
       //iterate to insert all orders
        for($i =0; $i < count($values['orders']); $i++){

        //find the matched id
        $menu = $this->findMenubyID($values['orders'][$i]['idmenu']);
        $values['amount'] = $menu->price * $values['orders'][$i]['qty'];

        //transfer data from orders array to the their respective container.
        $values['idmenu'] = $values['orders'][$i]['idmenu'];
        $menu[$i] = $this->findMenubyID($values['orders'][$i]['idmenu']);

        $values['transactionnum'] = $values['transactionnum'];
        $values['qty'] = $values['orders'][$i]['qty'];
      
       
        //data[0] is reserved for transactions table. data[1] and up are reserved for individual menu orders.
        //stores data to orders table
        $data[$i+1] = $r->dispense('orders')->import ($values, ['idmenu','transactionnum','qty','amount']);

        $r->store($data[$i+1]);

        }

        //stores data to have table. 
        $values['idtransaction_have'] = $values['transactionnum'];
        $values['idcustomer_have'] = $values['idcustomer'];
        $have = $r->dispense('have')->import($values, ['idtransaction_have','idcustomer_have']);
        $r->store($have);


        //send all info to Transaction controller to produce JSON data.
        return $data;
    }  

    //Model for GET Request
    public function get_transactions() {
        $finder = new Finder($this->redbeanFactory->getRedbeanToolbox());
        $data = $finder->find('transactions');

        return ($data) ? $data : false;
    } 


    public function stress_transaction($values){

        $tb = $this->redbeanFactory->getRedbeanToolbox();
        $r = $tb->getRedBean();
       
       $t = microtime(true);
       $micro = sprintf("%06d",($t - floor($t)) * 1000000);
       $date = date('YmdHis'.$micro, $t);


        $values['idcustomer'] = rand(1,100); //random from 100 different customers
        $values['idtrans_status'] = 1; //id transaction is always preparing mode.
        $values['idstore'] = rand(1,20); //random from 10 different stores
        $values['iddiscount'] = rand(0,1); //random between senior discount and no discount
        $values['idtax'] = 1; //
        $values['iddeliverer'] = rand(1,10); // random from 10 different deliverers
        $values['transactionnum'] = "OR$date"; //orno example "OR20170328101235465742" (combination of string OR + year,month,day,hour,minute,second,microsecond)


        //stores data to transaction table
        $data[0] = $r->dispense('transactions')

        ->import($values, ['idcustomer',
                           'idtrans_status',
                           'idstore',
                           'iddiscount',
                           'idtax',
                           'iddeliverer',
                           'transactionnum'])

        ->import(['dt_created' => date("Y-m-d H:i:s")]);

        $r->store($data[0]);
        
       
       //my randomness!!! 
        $rand_different_pizzas = rand(1,3); //random select of how many types of pizza going to be ordered
       
        $rand_include_pasta = rand(0,1); //determines if will include pasta in orders
        $rand_different_pastas = rand(0,3); //determines how many varieties of pastas will be included
        
        $rand_include_chicken = rand(0,1); //randomly determines if chicken order will be inclded
        $rand_different_chicken = rand(0,3); //randomly determines how many varieties of chicken should be included

        $rand_include_sides = rand(0,1); //randomly determines if sides will be included
        $rand_include_drinks = rand(0,1); //randomly determines if drinks will be included
        

        //INSERTING RANDOM ORDERS

        $global_array_index = 0;
        $rand_pizza_prev = 1;

        for($i = 0; $i < $rand_different_pizzas; $i++){

          $rand_pizza = rand(1,83); //selects random pizza. Pizzas included in the database is from (1-83)
          $rand_pizza_quantity = rand(1,3); //randomly determines quantity of pizza

          if($rand_pizza != $rand_pizza_prev){

              $rand_pizza_prev = $rand_pizza;
              $menu = $this->findMenubyID($rand_pizza); //get details of the menu based on the random id provided.
              $values['qty'] = $rand_pizza_quantity;
              $values['amount'] = $menu->price*$values['qty'];
              $values['idmenu'] = $rand_pizza;
              $values['transactionnum'] = $values['transactionnum'];
          
              $data[$global_array_index+1] = $r->dispense('orders')->import ($values, ['idmenu','transactionnum','qty','amount']);
              $r->store($data[$global_array_index+1]);

              $global_array_index++;

           }

        }

        //random pasta orders
        $rand_pasta_prev = 1;
        if($rand_include_pasta > 0){

           for($i = 0; $i < $rand_different_pastas; $i++){

              $rand_pasta = rand(84,91); //select random IDs of pasta. Pasta ID's included in the database is from (84-91)
              $rand_pasta_quantity = rand(1,3); //get random quantity

              if($rand_pasta != $rand_pasta_prev){

                  $rand_pasta_prev = $rand_pasta;
                  $menu = $this->findMenubyID($rand_pasta);
                  $values['qty'] = $rand_pasta_quantity;
                  $values['amount'] = $menu->price*$values['qty'];
                  $values['idmenu'] = $rand_pasta;
                  $values['transactionnum'] = $values['transactionnum'];
             

                  $data[$global_array_index+1] = $r->dispense('orders')->import ($values, ['idmenu','transactionnum','qty','amount']);
                  $r->store($data[$global_array_index+1]);

                  $global_array_index++;

              }              
           }
        }

        //random chicken orders
        $rand_chicken_prev = 1;

        if($rand_include_chicken > 0){

           for($i = 0; $i < $rand_different_chicken; $i++){

               $rand_chicken = rand(92,98); //select random IDs for chicken. Chicken ID included in the database is from (92-98)
               $rand_chicken_quantity = rand(1,3); //randomly select the no of quantity.

              if($rand_chicken != $rand_chicken_prev){

                  $rand_chicken_prev = $rand_chicken;
                  $menu = $this->findMenubyID($rand_chicken);
                  $values['qty'] = $rand_chicken_quantity;
                  $values['amount'] = $menu->price*$values['qty'];
                  $values['idmenu'] = $rand_chicken;
                  $values['transactionnum'] = $values['transactionnum'];
             

                  $data[$global_array_index+1] = $r->dispense('orders')->import ($values, ['idmenu','transactionnum','qty','amount']);
                  $r->store($data[$global_array_index+1]);

                  $global_array_index++;

              }              
           }
        }


        if($rand_include_sides > 0){

            $rand_sides = rand(99,100); // randomly selects the ID of sides
            $rand_sides_quantity = rand(1,5); //randomly select the quantity of sides

            $menu = $this->findMenubyID($rand_sides);
            $values['qty'] = $rand_sides_quantity;
            $values['amount'] = $menu->price*$values['qty'];
            $values['idmenu'] = $rand_sides;
            $values['transactionnum'] = $values['transactionnum'];
             

            $data[$global_array_index+1] = $r->dispense('orders')->import ($values, ['idmenu','transactionnum','qty','amount']);
            $r->store($data[$global_array_index+1]);

            $global_array_index++;             
           
        }

        if($rand_include_drinks > 0){

           $rand_drinks = rand(101,103); //randomly determines what kind of drinks
           $rand_drinks_quantity = rand(1,3); //randomly determines how many drinks


            $menu = $this->findMenubyID($rand_drinks);
            $values['qty'] = $rand_drinks_quantity;
            $values['amount'] = $menu->price*$values['qty'];
            $values['idmenu'] = $rand_drinks;
            $values['transactionnum'] = $values['transactionnum'];
             

            $data[$global_array_index+1] = $r->dispense('orders')->import ($values, ['idmenu','transactionnum','qty','amount']);
            $r->store($data[$global_array_index+1]);

            $global_array_index++;             
           
        }

        //stores data to "have" table. 
       $values['idtransaction_have'] = $values['transactionnum'];
       $values['idcustomer_have'] = $values['idcustomer'];
       $have = $r->dispense('have')->import($values, ['idtransaction_have','idcustomer_have']);
       $r->store($have);

        //send all info to Transaction controller to produce JSON data.
        return $data;
    }
}