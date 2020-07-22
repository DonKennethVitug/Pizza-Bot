<?php

namespace bot\Controllers;

use bot\Models\DelivererModel;
use bot\Validators\AppValidator;
use Slim\Http\Request;
use Slim\Http\Response;


class DelivererController extends BaseController{



    public function add_deliverer(Request $request, Response $response){

		$DelivererModel = new DelivererModel($this->redbeanFactory());
		$data = $DelivererModel->add_deliverer($request->getParsedBody());

		if($data){
			return $response->withJson($data->export(),200);
		}

		return $response->withStatus(400);
	}

	public function put_deliverer(Request $request, Response $response, array $args){
        $DelivererModel = new DelivererModel($this->redbeanFactory());
        $data = $DelivererModel->put_deliverer($args['id'], $request->getParsedBody());

        if($data){

            return $response->withJson($data->export(), 200);
        }

        return $response->withStatus(400);

    }
}
