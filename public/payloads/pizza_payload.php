<?php

$bot->answer('payload:BROWSE_PIZZA_MENU',[
    [
        "title"     => "Chicken Supreme",
        "image_url" => "http://bini101.com/bot/img/chicken_supreme.png",
        "subtitle"  => "Regular \t\t\t\t₱349.0\nFamily   \t\t\t\t₱499.0",
        "buttons"   => [
             [
                "type"    => "postback",
                "payload" => "ORDER_CHICKEN_SUPREME_REGULAR",
                "title"   => "Regular"
            ],
            [
                "type"    => "postback",
                "payload" => "ORDER_CHICKEN_SUPREME_FAMILY",
                "title"   => "Family"
            ]
        ]
    ],
    [
        "title"     => "Pepperoni Supreme",
        "image_url" => "http://bini101.com/bot/img/pepperoni.png",
        "subtitle"  => "Regular \t\t\t\t₱299.0\nFamily   \t\t\t\t₱459.0",
        "buttons"   => [
             [
                "type"    => "postback",
                "payload" => "ORDER_PEPPERONI_REGULAR",
                "title"   => "Regular"
            ],
            [
                "type"    => "postback",
                "payload" => "ORDER_PEPPERONI_FAMILY",
                "title"   => "Family"
            ]
        ]    
    ],
    [
        "title"     => "Hawaiian Supreme",
        "image_url" => "https://bini101.com/bot/img/hawaiian.png",
        "subtitle"  => "Regular \t\t\t\t₱299.0\nFamily   \t\t\t\t₱499.0",
        "buttons"   => [
            [
                "type"    => "postback",
                "payload" => "ORDER_HAWAIIAN_REGULAR",
                "title"   => "Regular"
            ],
            [
                "type"    => "postback",
                "payload" => "ORDER_HAWAIIAN_FAMILY",
                "title"   => "Family"
            ]
        ]   
    ],
]);

$bot->answer('payload:ORDER_CHICKEN_SUPREME_REGULAR', [ 'You have selected Regular Chicken Supreme pizza. How many orders would you like to have?',
            'quick_replies' => [
                [
                    'content_type' => 'text',
                    'title' => '1',
                    'payload' => '1_CS_REGULAR_PAYLOAD'
                ],
                [
                    'content_type' => 'text',
                    'title' => '2',
                    'payload' => '2_CS_REGULAR_PAYLOAD'
                ],
                [
                    'content_type' => 'text',
                    'title' => '3',
                    'payload' => '3_CS_REGULAR_PAYLOAD'
                ]
            ]
]);
        
        
$bot->answer('payload:ORDER_CHICKEN_SUPREME_FAMILY', [ 'You have selected Family Chicken Supreme pizza. How many orders would you like to have?',
        'quick_replies' => [
                [
                    'content_type' => 'text',
                    'title' => '1',
                    'payload' => '1_CS_FAMILY_PAYLOAD'
                ],
                [
                    'content_type' => 'text',
                    'title' => '2',
                    'payload' => '2_CS_FAMILY_PAYLOAD'
                ],
                [
                    'content_type' => 'text',
                    'title' => '3',
                    'payload' => '3_CS_FAMILY_PAYLOAD'
                ]
        ]
]);

$bot->answer('payload:ORDER_PEPPERONI_REGULAR', [ 'You have selected Regular Pepperoni Supreme pizza. How many orders would you like to have?',
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => '1',
                'payload' => '1_PS_REGULAR_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '2',
                'payload' => '2_PS_REGULAR_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '3',
                'payload' => '3_PS_REGULAR_PAYLOAD'
            ]
        ]
]);

$bot->answer('payload:ORDER_PEPPERONI_FAMILY', [ 'You have selected Family Pepperoni Supreme pizza. How many orders would you like to have?',
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => '1',
                'payload' => '1_PS_FAMILY_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '2',
                'payload' => '2_PS_FAMILY_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '3',
                'payload' => '3_PS_FAMILY_PAYLOAD'
            ]
        ]
]);

$bot->answer('payload:ORDER_HAWAIIAN_REGULAR', [ 'You have selected Regular Hawaiian Supreme pizza. How many orders would you like to have?',
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => '1',
                'payload' => '1_HS_REGULAR_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '2',
                'payload' => '2_HS_REGULAR_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '3',
                'payload' => '3_HS_REGULAR_PAYLOAD'
            ]
        ]
]);

$bot->answer('payload:ORDER_HAWAIIAN_FAMILY', [ 'You have selected Family Hawaiian Supreme pizza. How many orders would you like to have?',
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => '1',
                'payload' => '1_HS_FAMILY_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '2',
                'payload' => '2_HS_FAMILY_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '3',
                'payload' => '3_HS_FAMILY_PAYLOAD'
            ]
        ]
]);


$bot->answer('payload:1_CS_REGULAR_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"1CSREGULAR","Regular Chicken Supreme Pizza",1,349); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,349)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"1 order of Regular Chicken Supreme Pizza");  // saving of lead's orders
});

$bot->answer('payload:2_CS_REGULAR_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"2CSREGULAR","Regular Chicken Supreme Pizza",2,698); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,698)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"2 orders of Regular Chicken Supreme Pizza");  // saving of lead's orders
});


$bot->answer('payload:3_CS_REGULAR_PAYLOAD',function($bot,$lead_id){
   $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"3CSREGULAR","Regular Chicken Supreme Pizza",3,1047); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,1047)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"3 orders of  Regular Chicken Supreme Pizza");  // saving of lead's orders
});

$bot->answer('payload:4_CS_REGULAR_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"4CSREGULAR","Regular Chicken Supreme Pizza",4,1396); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,1396)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"4 orders of Regular Chicken Supreme Pizza");  // saving of lead's orders
});


$bot->answer('payload:5_CS_REGULAR_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"5CSREGULAR","Regular Chicken Supreme Pizza",5,1745); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,1745)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"5 order of Regular Chicken Supreme Pizza");  // saving of lead's orders
});


$bot->answer('payload:1_CS_FAMILY_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"1CSFAMILY","Family Chicken Supreme Pizza",1,499); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,499)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"1 order of Family Chicken Supreme Pizza");  // saving of lead's orders
});

$bot->answer('payload:2_CS_FAMILY_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"2CSFAMILY","Family Chicken Supreme Pizza",2,998); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,998)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"2 orders of Family Chicken Supreme Pizza");  // saving of lead's orders
});


$bot->answer('payload:3_CS_FAMILY_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"3CSFAMILY","Family Chicken Supreme Pizza",3,1497); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,1497)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"3 orders of Family Chicken Supreme Pizza");  // saving of lead's orders
});

$bot->answer('payload:4_CS_FAMILY_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"4CSFAMILY","Family Chicken Supreme Pizza",4,1996); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,1996)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"4 orders of Family Chicken Supreme Pizza");  // saving of lead's orders
});

$bot->answer('payload:5_CS_FAMILY_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"5CSFAMILY","Family Chicken Supreme Pizza",5,2495); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,2495)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"5 orders of Family Chicken Supreme Pizza");  // saving of lead's orders
});

$bot->answer('payload:1_HS_REGULAR_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"1HSREGULAR","Regular Hawaiian Supreme Pizza",1,299); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,299)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"1 order of Regular Hawaiian Supreme Pizza");  // saving of lead's orders
});

$bot->answer('payload:2_HS_REGULAR_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"1HSREGULAR","Regular Hawaiian Supreme Pizza",2,598); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,598)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"2 orders of Regular Hawaiian Supreme Pizza");  // saving of lead's orders
});

$bot->answer('payload:3_HS_REGULAR_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"3HSREGULAR","Regular Hawaiian Supreme Pizza",3,897); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,897)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"3 orders of Regular Hawaiian Supreme Pizza");  // saving of lead's orders
});

$bot->answer('payload:4_HS_REGULAR_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"4HSREGULAR","Regular Hawaiian Supreme Pizza",4,1196); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,1196)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"4 orders of Regular Hawaiian Supreme Pizza");  // saving of lead's orders
});

$bot->answer('payload:5_HS_REGULAR_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"5HSREGULAR","Regular Hawaiian Supreme Pizza",5,1495); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,1495)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"5 orders of Regular Hawaiian Supreme Pizza");  // saving of lead's orders
});

$bot->answer('payload:1_HS_FAMILY_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"1HSFAMILY","Family Hawaiian Supreme Pizza",1,459); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,459)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"1 order of Family Hawaiian Supreme Pizza");  // saving of lead's orders
});

$bot->answer('payload:2_HS_FAMILY_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"2HSFAMILY","Family Hawaiian Supreme Pizza",2,918); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,918)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"2 orders of Family Hawaiian Supreme Pizza");  // saving of lead's orders
});

$bot->answer('payload:3_HS_FAMILY_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"3HSFAMILY","Family Hawaiian Supreme Pizza",3,1377); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,1377)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"3 orders of Family Hawaiian Supreme Pizza");  // saving of lead's orders
});

$bot->answer('payload:4_HS_FAMILY_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"4HSFAMILY","Family Hawaiian Supreme Pizza",4,1836); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,1836)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"4 orders of Family Hawaiian Supreme Pizza");  // saving of lead's orders
});

$bot->answer('payload:5_HS_FAMILY_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"5HSFAMILY","Family Hawaiian Supreme Pizza",5,2295); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,2295)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"5 orders of Family Hawaiian Supreme Pizza");  // saving of lead's orders
});

$bot->answer('payload:1_PS_REGULAR_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"1PSREGULAR","Regular Pepperoni Supreme Pizza",1,299); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,299)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"1 order of Regular Pepperoni Supreme Pizza");  // saving of lead's orders
});

$bot->answer('payload:2_PS_REGULAR_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"2PSREGULAR","Regular Pepperoni Supreme Pizza",2,598); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,598)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"2 orders of Regular Pepperoni Supreme Pizza");  // saving of lead's orders
});

$bot->answer('payload:3_PS_REGULAR_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"3PSREGULAR","Regular Pepperoni Supreme Pizza",3,897); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,897)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"3 orders of Regular Pepperoni Supreme Pizza");  // saving of lead's orders
});

$bot->answer('payload:4_PS_REGULAR_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"4PSREGULAR","Regular Pepperoni Supreme Pizza",4,1196); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,1196)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"4 orders of Regular Pepperoni Supreme Pizza");  // saving of lead's orders
});

$bot->answer('payload:5_PS_REGULAR_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"5PSREGULAR","Regular Pepperoni Supreme Pizza",5,1495); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,1495)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"5 orders of Regular Pepperoni Supreme Pizza");  // saving of lead's orders
});

$bot->answer('payload:1_PS_FAMILY_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"1PSFAMILY","Family Pepperoni Supreme Pizza",1,459); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,459)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"1 order of Family Pepperoni Supreme Pizza");  // saving of lead's orders
});

$bot->answer('payload:2_PS_FAMILY_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"2PSFAMILY","Family Pepperoni Supreme Pizza",2,918); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,918)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"2 orders of Family Pepperoni Supreme Pizza");  // saving of lead's orders
});

$bot->answer('payload:3_PS_FAMILY_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"3PSFAMILY","Family Pepperoni Supreme Pizza",3,1377); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,1377)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"3 orders of Family Pepperoni Supreme Pizza");  // saving of lead's orders
});

$bot->answer('payload:4_PS_FAMILY_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"4PSFAMILY","Family Pepperoni Supreme Pizza",4,1836); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,1836)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"4 orders of Family Pepperoni Supreme Pizza");  // saving of lead's orders
});

$bot->answer('payload:5_PS_FAMILY_PAYLOAD',function($bot,$lead_id){
    $orders = [];
    $lead = $bot->storage->get($lead_id); // retrieving lead's information
    $order = $bot->storage->getOrderTransactions($lead_id); // retrieving  lead's order information
    $customer_name = json_encode(['first_name' => $lead['first_name'],'last_name' => $lead['last_name']]); // tailoring customer's name
    $orders = $bot->storage->validateOrder($order['orders'],"5PSFAMILY","Family Pepperoni Supreme Pizza",5,2295); // validating order
    $bot_orders_transactions = ['user_id' => $lead_id, 'customer_name' => $customer_name, 'orders' => $orders,'total_cost' => $bot->storage->generateTotalCost($orders,2295)]; // data struct.
    return $bot->storage->setOrderTransactions($bot_orders_transactions,"5 orders of Family Pepperoni Supreme Pizza");  // saving of lead's orders
});

?>