<?php

namespace bot\Controllers;

use bot\Models\PointSystemModel;
use bot\Exceptions\EmailAlreadyExistsException;
use bot\Validators\AppValidator;
use Slim\Http\Request;
use Slim\Http\Response;


class PointSystemController extends BaseController{

	public function post_points(Request $request, Response $response){

		$PointSystemModel = new PointSystemModel($this->redbeanFactory());
		$data = $PointSystemModel->post_points($request->getParsedBody());

		if($data){
			
			return $response->withJson($data->export(),200);
		}

		return $response->withStatus(400);
	}

	public function put_points(Request $request, Response $response, array $args){
        $PointSystemModel = new PointSystemModel($this->redbeanFactory());
        $points = $PointSystemModel->put_points($args['idcustomer_points'], $request->getParsedBody());

        if($points){

            return $response->withJson($points->export(), 200);
        }

        return $response->withStatus(400);

    }
}