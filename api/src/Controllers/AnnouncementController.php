<?php

namespace bot\Controllers;

use bot\Models\AnnouncementModel;
use bot\Validators\AppValidator;
use Slim\Http\Request;
use Slim\Http\Response;


class AnnouncementController extends BaseController{



public function post_announcement(Request $request, Response $response){
		$AnnouncementModel = new AnnouncementModel($this->redbeanFactory());
		$announcement = $AnnouncementModel->post_announcement($request->getParsedBody());

		if($announcement){
			return $response->withJson($announcement->export(),200);
		}

		return $response->withStatus(400);
	}

}