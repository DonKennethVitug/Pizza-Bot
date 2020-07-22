<?php

namespace bot\Controllers;

use bot\Models\DiscountModel;
use bot\Validators\AppValidator;
use Slim\Http\Request;
use Slim\Http\Response;


class DiscountController extends BaseController{

public function post_discount(Request $request, Response $response){

		$DiscountModel = new DiscountModel($this->redbeanFactory());
		$data = $DiscountModel->post_discount($request->getParsedBody());

		if($data){
			return $response->withJson($data->export(),200);
		}

		return $response->withStatus(400);
	}

	public function put_discount(Request $request, Response $response, array $args){
        $DiscountModel = new DiscountModel($this->redbeanFactory());
        $data = $DiscountModel->put_discount($args['id'], $request->getParsedBody());

        if($data){

            return $response->withJson($data->export(), 200);
        }

        return $response->withStatus(400);

    }
}