<?php

namespace bot\Controllers;

use bot\Models\CustomerModel;
use bot\Validators\AppValidator;
use Slim\Http\Request;
use Slim\Http\Response;


class CustomerController extends BaseController{

public function post_customer(Request $request, Response $response){

		$CustomerModel = new CustomerModel($this->redbeanFactory());
		$data = $CustomerModel->post_customer($request->getParsedBody());

		if($data){

			return $response->withJson($data->export(),200);
		}

		return $response->withStatus(400);
	}


	public function put_customer(Request $request, Response $response, array $args){
        $CustomerModel = new CustomerModel($this->redbeanFactory());
        $data = $CustomerModel->put_customer($args['id'], $request->getParsedBody());

        if($data){

            return $response->withJson($data->export(), 200);
        }

        return $response->withStatus(400);

    }
}