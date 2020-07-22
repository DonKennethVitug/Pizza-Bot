<?php

namespace bot\Controllers;

use bot\Models\FeedbackModel;
use bot\Validators\AppValidator;
use Slim\Http\Request;
use Slim\Http\Response;


class FeedbackController extends BaseController{

public function post_feedback(Request $request, Response $response){
		$FeedbackModel = new FeedbackModel($this->redbeanFactory());
		$feedback = $FeedbackModel->post_feedback($request->getParsedBody());

		if($feedback){
			return $response->withJson($feedback->export(),200);
		}

		return $response->withStatus(400);
	}

}