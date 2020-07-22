<?php

namespace bot\Controllers;

use bot\Models\OrderModel;
use bot\Validators\AppValidator;
use Slim\Http\Request;
use Slim\Http\Response;


class OrderController extends BaseController{

public function post_orders(Request $request, Response $response){

		$OrderModel = new OrderModel($this->redbeanFactory());
		$data = $OrderModel->post_orders($request->getParsedBody());

		if($data){
			return $response->withJson($data->export(),200);
		}

		return $response->withStatus(400);


	}

}