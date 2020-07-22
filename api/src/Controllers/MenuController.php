<?php

namespace bot\Controllers;

use bot\Models\MenuModel;
use bot\Validators\AppValidator;
use Slim\Http\Request;
use Slim\Http\Response;


class MenuController extends BaseController{

public function post_menu(Request $request, Response $response){

		$MenuModel = new MenuModel($this->redbeanFactory());
		$data = $MenuModel->post_menu($request->getParsedBody());

		if($data){
			return $response->withJson($data->export(),200);
		}

		return $response->withStatus(400);
	}

	public function put_menu(Request $request, Response $response, array $args){
        $MenuModel = new MenuModel($this->redbeanFactory());
        $data = $MenuModel->put_menu($args['id'], $request->getParsedBody());

        if($data){

            return $response->withJson($data->export(), 200);
        }

        return $response->withStatus(400);

    }

}