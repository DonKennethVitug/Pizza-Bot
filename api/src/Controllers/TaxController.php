<?php

namespace bot\Controllers;

use bot\Models\TaxModel;
use bot\Validators\AppValidator;
use Slim\Http\Request;
use Slim\Http\Response;


class TaxController extends BaseController{

public function post_tax(Request $request, Response $response){

		$TaxModel = new TaxModel($this->redbeanFactory());
		$data = $TaxModel->post_tax($request->getParsedBody());

		if($data){
			return $response->withJson($data->export(),200);
		}

		return $response->withStatus(400);
	}

public function put_tax(Request $request, Response $response, array $args){
        $TaxModel = new TaxModel($this->redbeanFactory());
        $data = $TaxModel->put_tax($args['id'], $request->getParsedBody());

        if($data){

            return $response->withJson($data->export(), 200);
        }

        return $response->withStatus(400);

    }

}