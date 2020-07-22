<?php

namespace bot\Controllers;

use bot\Models\StoreModel;
use bot\Validators\AppValidator;
use Slim\Http\Request;
use Slim\Http\Response;


class StoreController extends BaseController{

public function post_store(Request $request, Response $response){

		$StoreModel = new StoreModel($this->redbeanFactory());
		$data = $StoreModel->post_store($request->getParsedBody());

		if($data){
			return $response->withJson($data->export(),200);
		}

		return $response->withStatus(400);
	}

	public function put_store(Request $request, Response $response, array $args){
        $StoreModel = new StoreModel($this->redbeanFactory());
        $data = $StoreModel->put_store($args['id'], $request->getParsedBody());

        if($data){

            return $response->withJson($data->export(), 200);
        }

        return $response->withStatus(400);

    }

}