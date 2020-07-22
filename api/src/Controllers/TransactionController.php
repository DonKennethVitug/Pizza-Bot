<?php

namespace bot\Controllers;

use bot\Models\TransactionModel;
use bot\Models\OrderModel;
use bot\Validators\AppValidator;
use Slim\Http\Request;
use Slim\Http\Response;


class TransactionController extends BaseController{

//function used for POST request
public function post_transaction(Request $request, Response $response, array $args){

		//instantiate model
		$TransactionModel = new TransactionModel($this->redbeanFactory());

		// Get the returned data from model
		$data = $TransactionModel->post_transaction($request->getParsedBody());

		if($data){

			//create personalized JSON reponse with status code OK 200
			return $response->withJson(static::exportData($data), 200);

		}

		return $response->withStatus(400);
	}

	//function used for GET request
	public function get_transactions(Request $request, Response $response){

		//instantiate model
		$transactionModel = new TransactionModel($this->redbeanFactory());

		//transfer returned data from model
		$data = $transactionModel->get_transactions();
		$orderModel = new OrderModel($this->redbeanFactory());


		if($data){

			//create personalized JSON reponse with status code OK 200
			return $response->withJson(self::exportTransactions($data, $transactionModel),200);
		}

		return $response->withStatus(400);
	}



	public function stress_transaction(Request $request, Response $response, array $args){

		//instantiate model
		$TransactionModel = new TransactionModel($this->redbeanFactory());

		// Get the returned data from model
		$data = $TransactionModel->stress_transaction($request->getParsedBody());

		if($data){

			//create personalized JSON reponse with status code OK 200
			return $response->withJson(static::exportData($data), 200);

		}

		return $response->withStatus(400);
	}








	//EDIT HOW YOUR JSON WILL LOOK LIKE WHEN CALLING ONE OF THESE FUNCTIONS

	//this function is used for GET.
	private static function exportTransactions($data, $transactionModel){
		$export = [];

		foreach($data as $data){

		//select orders that match the transaction number of selected data.
		$orders = $transactionModel->findByTransactionID($data['transactionnum']);

		//call another function that will get all the orders based on transaction number
        $orders = static::exportOrdered($orders);

        	//this is how your JSON should be formatted
			$export[] = [

				'id' => $data->id,
				'idcustomer' => $data->idcustomer,
				'idtrans_status' => $data->idtrans_status,
				'idstore' => $data->idstore,
				'iddiscount' => $data->iddiscount,
                'transactionnum' => $data->transactionnum,
                'idtax' => $data->idtax,
                'dt_created' => $data->dt_created,
                'orders' => $orders //this was produced by exportOrdered function

			];
		}
		
		return $export;
	}

	//JSON format for ORDERS
	private static function exportOrdered($orders){
        $export = [];
       foreach($orders as $orders){
            $export[] = [

                'id' => $orders['id'],
                'idmenu' =>  $orders['idmenu'],
                'transactionnum' => $orders['transactionnum'],
                'qty' => $orders['qty'],
                'amount' => $orders['amount']
            ];
        }

        return $export;
    }

    //this function is used to return JSON as a result of newly registered data (POST)
    //Sends data to "transactions" table
	private static function exportData($data){
        $export = [];

        $orders = static::exportOrders($data);
     
            $export[] = [ 
                'id' => $data[0]['id'],
                'idcustomer' => $data[0]['idcustomer'],
                'idtrans_status' => $data[0]['idtrans_status'],
                'idstore' => $data[0]['idstore'],
                'iddiscount' => $data[0]['iddiscount'],
                'transactionnum' => $data[0]['transactionnum'],
                'idtax' => $data[0]['idtax'],
                'dt_created' => $data[0]['dt_created'],
                'orders' => $orders //this was produced ty exportOrders Function

               ];
        
        return $export;
    }

    //Separate function for orders that iterates and save to "orders" table.
    private static function exportOrders($data){
        $export = [];

       	for($i = 1; $i < count($data); $i++){

            $export[] = [

               	    'id' => $data[$i]['id'],
                	'idmenu' =>  $data[$i]['idmenu'],
                	'transactionnum' => $data[0]['transactionnum'],
                	'qty' => $data[$i]['qty'],
                	'amount' => $data[$i]['amount']
            ];
        }
        return $export;
    }
}