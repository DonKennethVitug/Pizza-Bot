<?php

namespace bot\Controllers;

use bot\Models\CategoryModel;
use bot\Validators\AppValidator;
use Slim\Http\Request;
use Slim\Http\Response;


class CategoryController extends BaseController{

public function post_category(Request $request, Response $response){
		$CategoryModel = new CategoryModel($this->redbeanFactory());
		$category = $CategoryModel->post_category($request->getParsedBody());

		if($category){
			return $response->withJson($category->export(),200);
		}

		return $response->withStatus(400);
	}

	public function put_category(Request $request, Response $response, array $args){
        $CategoryModel = new CategoryModel($this->redbeanFactory());
        $category = $CategoryModel->put_category($args['id'], $request->getParsedBody());

        if($category){

            return $response->withJson($category->export(), 200);
        }

        return $response->withStatus(400);

    }

}