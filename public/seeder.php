<?php
date_default_timezone_set("Asia/Manila");

$bot = require_once __DIR__ . '/../bootstrap/bot.php';

$time = date("h:i");

require 'payloads/payload.php';

// the get started
$bot->answer('payload:GIGA_GET_STARTED_PAYLOAD', function($bot,$lead_id){
	if($bot->storage->isVerified($lead_id)){
		$bot->say('Welcome back [first_name]!');
		$bot->say('Please enter your 4 digit password to sign-in!')->wait('password');
	}else{
		$bot->say('Welcome to Pizza Prototype!');
		$bot->say('New user? Just type your 4 digit password to sign-in!')->wait('password_new');
	}
});

// on-boarding process goes on
$bot->answer('@password_new',function($bot,$lead_id,$input){
	if(strlen($input) == 4 && filter_var($input,FILTER_VALIDATE_INT) && !$bot->storage->isVerified($lead_id)){
		$bot->storage->setLeadPass($lead_id,$input);
		$bot->say('You\'ll receive an SMS to verify your identity, please enter your number')->wait('phone_new');
	}else{
		$bot->keep('The password you gave contains an invalid digit like 0, please enter again.');
		return;
	}
});

$bot->answer('@phone_new', function($bot,$lead_id,$input){
	if((strlen($input) == 11) && is_numeric($input) && !$bot->storage->isVerified($lead_id)){
		$bot->storage->setLeadPhone($lead_id,$input);
		$bot->storage->generateLeadCode($lead_id,$input);
		$bot->say('Please enter the 4 digit code we\'ve just texted you')->wait('code_new');
	}else{
		$bot->keep('The phone number you gave is invalid, please enter again.');
		return;
	}
});

$bot->answer('@code_new', function($bot,$lead_id,$input){
	if((strlen($input) == 4) && is_numeric($input) && !$bot->storage->isVerified($lead_id) && $input == $bot->storage->getLeadCode($lead_id)){
		$bot->say('Almost there! Please tell us your name.')->wait('name_new');
	}else{
		$bot->keep('The code you entered is not valid, please enter again.');
		return;
	}
});

$bot->answer('@name_new', function($bot,$lead_id,$input){
	if(!is_numeric($input) && !preg_match('/[^a-zA-Z\d]/' && str_replace(' ', '', $input)) && !$bot->storage->isVerified($lead_id)){
		$bot->storage->setLeadName($lead_id,$input);
		$bot->say('Where do we deliver your order?')->wait('address_new');
	}else{
		$bot->keep('I don\'t think that is a name, please enter again.');
		return;
	} 
});

$bot->answer('@address_new', function($bot,$lead_id,$input){
	if(!$bot->storage->isVerified($lead_id)){
		$bot->storage->setLeadAddress($lead_id,$input);
		$bot->say([
			    'To ensure smooth and speedy delivery, please confirm your location!',
			    'quick_replies' => [
			        [
			            'content_type' => 'location',
			            'title' => 'Get My Location',
			            'payload' => 'USER_TAPPED_ONBOARDING_LOCATION'
			        ]
			    ]
			])->then(function($bot,$lead_id,$input){

				return [
					    [
					        "title"     => "Welcome to Pizza Hut!",
					        "image_url" => "https://bini101.com/bot/img/cover3.png",
					        "subtitle"  => "Your one stop online automated pizza ordering!",
					        "buttons"   => [
					            [
					                "type"  => "postback",
					                "payload" => "START_ORDERING_PAYLOAD",
					                "title" => "Start Ordering"
					            ]
					        ]
					    ]
					  ];
			});
	}
}); // on-boarding ends here

// flow for verified user goes on
$bot->answer('@password',function($bot,$lead_id,$input){
	if(strlen($input) == 4 && filter_var($input,FILTER_VALIDATE_INT) && $input==$bot->storage->getLeadPass($lead_id)){
		$order = $bot->storage->getOrderTransactions($lead_id);
	    $order = $order['orders'];
	    $carts = json_decode($order, true);
	    $carts = "{}";
	    $total_cost = 0;
	    $bot_orders_transactions = [
	                    'user_id' => $lead_id,
	                    'orders' => $carts,
	                    'total_cost' => $total_cost
	                ];

	    //setOrderTransactions
	    $bot->storage->setOrderTransactions($bot_orders_transactions);

	    $bot->say([
	    [
	        "title"     => "Welcome to Pizza Hut!",
	        "image_url" => "https://bini101.com/bot/img/cover3.png",
	        "subtitle"  => "Your one stop online automated pizza ordering!",
	        "buttons"   => [
	            [
	                "type"  => "postback",
	                "payload" => "START_ORDERING_PAYLOAD",
	                "title" => "Start Ordering"
	            ]
	        ]
	    ]
	  ]);
	}else{
		$bot->keep('Your password is invalid, please enter your password again.');
		return;
	}
});

// Print some message to the browser when done
dd('Nodes seeded!');