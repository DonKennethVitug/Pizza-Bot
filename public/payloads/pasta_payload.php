<?php

$bot->answer('payload:BROWSE_PASTA_MENU',[
    [
        "title"     => "Spaghetti Bolognese with Meatballs",
        "image_url" => "http://bini101.com/bot/img/meatballs.jpeg",
        "subtitle"  => "Regular \t\t\t\t₱155.0\nFamily   \t\t\t\t₱419.0",
        "buttons"   => [
             [
                "type"    => "postback",
                "payload" => "ORDER_PASTA_BOLOGNESE_MEATBALLS_REGULAR",
                "title"   => "Regular"
            ],
            [
                "type"    => "postback",
                "payload" => "ORDER_PASTA_BOLOGNESE_MEATBALLS_FAMILY",
                "title"   => "Family"
            ]
        ]
    ],
    [
        "title"     => "Spaghetti Carbonara",
        "image_url" => "http://bini101.com/bot/img/white_spaghetti.jpg",
        "subtitle"  => "Regular \t\t\t\t₱105.0\nFamily   \t\t\t\t₱299.0",
        "buttons"   => [
             [
                "type"    => "postback",
                "payload" => "ORDER_PASTA_WHITE_REGULAR",
                "title"   => "Regular"
            ],
            [
                "type"    => "postback",
                "payload" => "ORDER_PASTA_WHITE_FAMILY",
                "title"   => "Family"
            ]
        ]    
    ],
    [
        "title"     => "Spaghetti Bolognese with Meatsauce",
        "image_url" => "https://bini101.com/bot/img/spaghetti.jpg",
        "subtitle"  => "Regular \t\t\t\t₱105.0\nFamily   \t\t\t\t₱299.0",
        "buttons"   => [
            [
                "type"    => "postback",
                "payload" => "ORDER_PASTA_BOLOGNESE_MEATSAUCE_REGULAR",
                "title"   => "Regular"
            ],
            [
                "type"    => "postback",
                "payload" => "ORDER_PASTA_BOLOGNESE_MEATSAUCE_FAMILY",
                "title"   => "Family"
            ]
        ]   
    ],
]);

$bot->answer('payload:ORDER_PASTA_BOLOGNESE_MEATBALLS_REGULAR', [
    'You have selected Regular Spaghetti Bolognese with Meatballs. How many orders would you like to have?',
    'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => '1',
                'payload' => '1_PBM_REGULAR_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '2',
                'payload' => '2_PBM_REGULAR_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '3',
                'payload' => '3_PBM_REGULAR_PAYLOAD'
            ]
        ]

]);

$bot->answer('payload:ORDER_PASTA_BOLOGNESE_MEATBALLS_FAMILY', [
    'You have selected Family Spaghetti Bolognese with Meatballs. How many orders would you like to have?',
    'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => '1',
                'payload' => '1_PBM_FAMILY_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '2',
                'payload' => '2_PBM_FAMILY_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '3',
                'payload' => '3_PBM_FAMILY_PAYLOAD'
            ]
        ]

]);

$bot->answer('payload:ORDER_PASTA_WHITE_REGULAR', [
    'You have selected Regular Spaghetti Carbonara. How many orders would you like to have?',
    'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => '1',
                'payload' => '1_PW_REGULAR_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '2',
                'payload' => '2_PW_REGULAR_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '3',
                'payload' => '3_PW_REGULAR_PAYLOAD'
            ]
        ]

]);

$bot->answer('payload:ORDER_PASTA_WHITE_FAMILY', [
    'You have selected Family Spaghetti Carbonara. How many orders would you like to have?',
    'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => '1',
                'payload' => '1_PW_FAMILY_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '2',
                'payload' => '2_PW_FAMILY_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '3',
                'payload' => '3_PW_FAMILY_PAYLOAD'
            ]
        ]

]);

$bot->answer('payload:ORDER_PASTA_BOLOGNESE_MEATSAUCE_REGULAR', [
    'You have selected Regular Spaghetti Bolognese with Meatsauce. How many orders would you like to have?',
    'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => '1',
                'payload' => '1_PBMS_REGULAR_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '2',
                'payload' => '2_PBMS_REGULAR_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '3',
                'payload' => '3_PBMS_REGULAR_PAYLOAD'
            ]
        ]

]);

$bot->answer('payload:ORDER_PASTA_BOLOGNESE_MEATSAUCE_FAMILY', [
    'You have selected Family Spaghetti Bolognese with Meatsauce. How many orders would you like to have?',
    'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => '1',
                'payload' => '1_PBMS_FAMILY_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '2',
                'payload' => '2_PBMS_FAMILY_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '3',
                'payload' => '3_PBMS_FAMILY_PAYLOAD'
            ]
        ]

]);

$bot->answer('payload:1_PBM_REGULAR_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '1PBMREGULAR';
    $order_title = '1 order of Regular Pasta Bolognese w/ Meatballs';
    $order_cost = 155;
    $user_id = $lead_id;
    $first_name = $lead['first_name'];
    $last_name = $lead['last_name'];
    $customer_name = [
        'first_name' => $first_name,
        'last_name' => $last_name
    ];
    $customer_name = json_encode($customer_name);
    $orders = [];
    $total_cost = 0;

    if($order == "" || $order == "null" || $order == "{}") {
        $orders = [
            [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]
        ]; 
        $total_cost = $order_cost;
    } else {
        $orders = json_decode($order, true);
        array_push($orders, [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]);
        foreach($orders as $order) {
            $total_cost += $order['order_cost'];
        }
    }

    $orders = json_encode($orders);

    $bot_orders_transactions = [
                    'user_id' => $user_id,
                    'orders' => $orders,
                    'total_cost' => $total_cost
                ];

    //setOrderTransactions
    $bot->storage->setOrderTransactions($bot_orders_transactions);
    
    return [
        $order_title . " is added to your cart.",
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => 'Continue Ordering',
                'payload' => 'START_ORDERING_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Show Cart',
                'payload' => 'SHOW_ORDERS_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Check Out',
                'payload' => 'START_CHECKOUT_PAYLOAD'
            ]
        ]
    ]; 
});

$bot->answer('payload:2_PBM_REGULAR_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '2PBMREGULAR';
    $order_title = '2 orders of Regular Pasta Bolognese w/ Meatballs';
    $order_cost = 310;
    $user_id = $lead_id;
    $first_name = $lead['first_name'];
    $last_name = $lead['last_name'];
    $customer_name = [
        'first_name' => $first_name,
        'last_name' => $last_name
    ];
    $customer_name = json_encode($customer_name);
    $orders = [];
    $total_cost = 0;

    if($order == "" || $order == "null" || $order == "{}") {
        $orders = [
            [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]
        ]; 
        $total_cost = $order_cost;
    } else {
        $orders = json_decode($order, true);
        array_push($orders, [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]);
        foreach($orders as $order) {
            $total_cost += $order['order_cost'];
        }
    }

    $orders = json_encode($orders);

    $bot_orders_transactions = [
                    'user_id' => $user_id,
                    'orders' => $orders,
                    'total_cost' => $total_cost
                ];

    //setOrderTransactions
    $bot->storage->setOrderTransactions($bot_orders_transactions);
    
    return [
        $order_title . " is added to your cart.",
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => 'Continue Ordering',
                'payload' => 'START_ORDERING_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Show Cart',
                'payload' => 'SHOW_ORDERS_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Check Out',
                'payload' => 'START_CHECKOUT_PAYLOAD'
            ]
        ]
    ]; 
});

$bot->answer('payload:3_PBM_REGULAR_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '3PBMREGULAR';
    $order_title = '3 orders of Regular Pasta Bolognese w/ Meatballs';
    $order_cost = 465;
    $user_id = $lead_id;
    $first_name = $lead['first_name'];
    $last_name = $lead['last_name'];
    $customer_name = [
        'first_name' => $first_name,
        'last_name' => $last_name
    ];
    $customer_name = json_encode($customer_name);
    $orders = [];
    $total_cost = 0;

    if($order == "" || $order == "null" || $order == "{}") {
        $orders = [
            [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]
        ]; 
        $total_cost = $order_cost;
    } else {
        $orders = json_decode($order, true);
        array_push($orders, [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]);
        foreach($orders as $order) {
            $total_cost += $order['order_cost'];
        }
    }

    $orders = json_encode($orders);

    $bot_orders_transactions = [
                    'user_id' => $user_id,
                    'orders' => $orders,
                    'total_cost' => $total_cost
                ];

    //setOrderTransactions
    $bot->storage->setOrderTransactions($bot_orders_transactions);
    
    return [
        $order_title . " is added to your cart.",
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => 'Continue Ordering',
                'payload' => 'START_ORDERING_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Show Cart',
                'payload' => 'SHOW_ORDERS_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Check Out',
                'payload' => 'START_CHECKOUT_PAYLOAD'
            ]
        ]
    ]; 
});

$bot->answer('payload:1_PBM_FAMILY_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '1PBMFAMILY';
    $order_title = '1 order of Family Pasta Bolognese w/ Meatballs';
    $order_cost = 419;
    $user_id = $lead_id;
    $first_name = $lead['first_name'];
    $last_name = $lead['last_name'];
    $customer_name = [
        'first_name' => $first_name,
        'last_name' => $last_name
    ];
    $customer_name = json_encode($customer_name);
    $orders = [];
    $total_cost = 0;

    if($order == "" || $order == "null" || $order == "{}") {
        $orders = [
            [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]
        ]; 
        $total_cost = $order_cost;
    } else {
        $orders = json_decode($order, true);
        array_push($orders, [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]);
        foreach($orders as $order) {
            $total_cost += $order['order_cost'];
        }
    }

    $orders = json_encode($orders);

    $bot_orders_transactions = [
                    'user_id' => $user_id,
                    'orders' => $orders,
                    'total_cost' => $total_cost
                ];

    //setOrderTransactions
    $bot->storage->setOrderTransactions($bot_orders_transactions);
    
    return [
        $order_title . " is added to your cart.",
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => 'Continue Ordering',
                'payload' => 'START_ORDERING_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Show Cart',
                'payload' => 'SHOW_ORDERS_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Check Out',
                'payload' => 'START_CHECKOUT_PAYLOAD'
            ]
        ]
    ]; 
});

$bot->answer('payload:2_PBM_FAMILY_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '2PBMFAMILY';
    $order_title = '2 orders of Family Pasta Bolognese w/ Meatballs';
    $order_cost = 838;
    $user_id = $lead_id;
    $first_name = $lead['first_name'];
    $last_name = $lead['last_name'];
    $customer_name = [
        'first_name' => $first_name,
        'last_name' => $last_name
    ];
    $customer_name = json_encode($customer_name);
    $orders = [];
    $total_cost = 0;

    if($order == "" || $order == "null" || $order == "{}") {
        $orders = [
            [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]
        ]; 
        $total_cost = $order_cost;
    } else {
        $orders = json_decode($order, true);
        array_push($orders, [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]);
        foreach($orders as $order) {
            $total_cost += $order['order_cost'];
        }
    }

    $orders = json_encode($orders);

    $bot_orders_transactions = [
                    'user_id' => $user_id,
                    'orders' => $orders,
                    'total_cost' => $total_cost
                ];

    //setOrderTransactions
    $bot->storage->setOrderTransactions($bot_orders_transactions);
    
    return [
        $order_title . " is added to your cart.",
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => 'Continue Ordering',
                'payload' => 'START_ORDERING_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Show Cart',
                'payload' => 'SHOW_ORDERS_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Check Out',
                'payload' => 'START_CHECKOUT_PAYLOAD'
            ]
        ]
    ]; 
});

$bot->answer('payload:3_PBM_FAMILY_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '3PBMFAMILY';
    $order_title = '3 orders of Family Spaghetti with Carbonara';
    $order_cost = 1257;
    $user_id = $lead_id;
    $first_name = $lead['first_name'];
    $last_name = $lead['last_name'];
    $customer_name = [
        'first_name' => $first_name,
        'last_name' => $last_name
    ];
    $customer_name = json_encode($customer_name);
    $orders = [];
    $total_cost = 0;

    if($order == "" || $order == "null" || $order == "{}") {
        $orders = [
            [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]
        ]; 
        $total_cost = $order_cost;
    } else {
        $orders = json_decode($order, true);
        array_push($orders, [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]);
        foreach($orders as $order) {
            $total_cost += $order['order_cost'];
        }
    }

    $orders = json_encode($orders);

    $bot_orders_transactions = [
                    'user_id' => $user_id,
                    'orders' => $orders,
                    'total_cost' => $total_cost
                ];

    //setOrderTransactions
    $bot->storage->setOrderTransactions($bot_orders_transactions);
    
    return [
        $order_title . " is added to your cart.",
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => 'Continue Ordering',
                'payload' => 'START_ORDERING_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Show Cart',
                'payload' => 'SHOW_ORDERS_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Check Out',
                'payload' => 'START_CHECKOUT_PAYLOAD'
            ]
        ]
    ]; 
});

$bot->answer('payload:1_PW_REGULAR_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '1PWREGULAR';
    $order_title = '1 order of Regular Spaghetti Carbonara';
    $order_cost = 105;
    $user_id = $lead_id;
    $first_name = $lead['first_name'];
    $last_name = $lead['last_name'];
    $customer_name = [
        'first_name' => $first_name,
        'last_name' => $last_name
    ];
    $customer_name = json_encode($customer_name);
    $orders = [];
    $total_cost = 0;

    if($order == "" || $order == "null" || $order == "{}") {
        $orders = [
            [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]
        ]; 
        $total_cost = $order_cost;
    } else {
        $orders = json_decode($order, true);
        array_push($orders, [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]);
        foreach($orders as $order) {
            $total_cost += $order['order_cost'];
        }
    }

    $orders = json_encode($orders);

    $bot_orders_transactions = [
                    'user_id' => $user_id,
                    'orders' => $orders,
                    'total_cost' => $total_cost
                ];

    //setOrderTransactions
    $bot->storage->setOrderTransactions($bot_orders_transactions);
    
    return [
        $order_title . " is added to your cart.",
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => 'Continue Ordering',
                'payload' => 'START_ORDERING_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Show Cart',
                'payload' => 'SHOW_ORDERS_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Check Out',
                'payload' => 'START_CHECKOUT_PAYLOAD'
            ]
        ]
    ]; 
});

$bot->answer('payload:2_PW_REGULAR_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '2PWREGULAR';
    $order_title = '2 orders of Regular Spaghetti Carbonara';
    $order_cost = 210;
    $user_id = $lead_id;
    $first_name = $lead['first_name'];
    $last_name = $lead['last_name'];
    $customer_name = [
        'first_name' => $first_name,
        'last_name' => $last_name
    ];
    $customer_name = json_encode($customer_name);
    $orders = [];
    $total_cost = 0;

    if($order == "" || $order == "null" || $order == "{}") {
        $orders = [
            [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]
        ]; 
        $total_cost = $order_cost;
    } else {
        $orders = json_decode($order, true);
        array_push($orders, [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]);
        foreach($orders as $order) {
            $total_cost += $order['order_cost'];
        }
    }

    $orders = json_encode($orders);

    $bot_orders_transactions = [
                    'user_id' => $user_id,
                    'orders' => $orders,
                    'total_cost' => $total_cost
                ];

    //setOrderTransactions
    $bot->storage->setOrderTransactions($bot_orders_transactions);
    
    return [
        $order_title . " is added to your cart.",
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => 'Continue Ordering',
                'payload' => 'START_ORDERING_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Show Cart',
                'payload' => 'SHOW_ORDERS_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Check Out',
                'payload' => 'START_CHECKOUT_PAYLOAD'
            ]
        ]
    ]; 
});

$bot->answer('payload:3_PW_REGULAR_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '3PWREGULAR';
    $order_title = '3 orders of Regular Spaghetti Carbonara';
    $order_cost = 315;
    $user_id = $lead_id;
    $first_name = $lead['first_name'];
    $last_name = $lead['last_name'];
    $customer_name = [
        'first_name' => $first_name,
        'last_name' => $last_name
    ];
    $customer_name = json_encode($customer_name);
    $orders = [];
    $total_cost = 0;

    if($order == "" || $order == "null" || $order == "{}") {
        $orders = [
            [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]
        ]; 
        $total_cost = $order_cost;
    } else {
        $orders = json_decode($order, true);
        array_push($orders, [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]);
        foreach($orders as $order) {
            $total_cost += $order['order_cost'];
        }
    }

    $orders = json_encode($orders);

    $bot_orders_transactions = [
                    'user_id' => $user_id,
                    'orders' => $orders,
                    'total_cost' => $total_cost
                ];

    //setOrderTransactions
    $bot->storage->setOrderTransactions($bot_orders_transactions);
    
    return [
        $order_title . " is added to your cart.",
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => 'Continue Ordering',
                'payload' => 'START_ORDERING_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Show Cart',
                'payload' => 'SHOW_ORDERS_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Check Out',
                'payload' => 'START_CHECKOUT_PAYLOAD'
            ]
        ]
    ]; 
});

$bot->answer('payload:1_PW_FAMILY_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '1PWFAMILY';
    $order_title = '1 order of Family Spaghetti Carbonara';
    $order_cost = 299;
    $user_id = $lead_id;
    $first_name = $lead['first_name'];
    $last_name = $lead['last_name'];
    $customer_name = [
        'first_name' => $first_name,
        'last_name' => $last_name
    ];
    $customer_name = json_encode($customer_name);
    $orders = [];
    $total_cost = 0;

    if($order == "" || $order == "null" || $order == "{}") {
        $orders = [
            [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]
        ]; 
        $total_cost = $order_cost;
    } else {
        $orders = json_decode($order, true);
        array_push($orders, [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]);
        foreach($orders as $order) {
            $total_cost += $order['order_cost'];
        }
    }

    $orders = json_encode($orders);

    $bot_orders_transactions = [
                    'user_id' => $user_id,
                    'orders' => $orders,
                    'total_cost' => $total_cost
                ];

    //setOrderTransactions
    $bot->storage->setOrderTransactions($bot_orders_transactions);
    
    return [
        $order_title . " is added to your cart.",
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => 'Continue Ordering',
                'payload' => 'START_ORDERING_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Show Cart',
                'payload' => 'SHOW_ORDERS_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Check Out',
                'payload' => 'START_CHECKOUT_PAYLOAD'
            ]
        ]
    ]; 
});

$bot->answer('payload:2_PW_FAMILY_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '2PWFAMILY';
    $order_title = '2 orders of Family Spaghetti Carbonara';
    $order_cost = 598;
    $user_id = $lead_id;
    $first_name = $lead['first_name'];
    $last_name = $lead['last_name'];
    $customer_name = [
        'first_name' => $first_name,
        'last_name' => $last_name
    ];
    $customer_name = json_encode($customer_name);
    $orders = [];
    $total_cost = 0;

    if($order == "" || $order == "null" || $order == "{}") {
        $orders = [
            [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]
        ]; 
        $total_cost = $order_cost;
    } else {
        $orders = json_decode($order, true);
        array_push($orders, [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]);
        foreach($orders as $order) {
            $total_cost += $order['order_cost'];
        }
    }

    $orders = json_encode($orders);

    $bot_orders_transactions = [
                    'user_id' => $user_id,
                    'orders' => $orders,
                    'total_cost' => $total_cost
                ];

    //setOrderTransactions
    $bot->storage->setOrderTransactions($bot_orders_transactions);
    
    return [
        $order_title . " is added to your cart.",
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => 'Continue Ordering',
                'payload' => 'START_ORDERING_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Show Cart',
                'payload' => 'SHOW_ORDERS_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Check Out',
                'payload' => 'START_CHECKOUT_PAYLOAD'
            ]
        ]
    ]; 
});

$bot->answer('payload:3_PW_FAMILY_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '3PWFAMILY';
    $order_title = '3 orders of Family Spaghetti Carbonara';
    $order_cost = 897;
    $user_id = $lead_id;
    $first_name = $lead['first_name'];
    $last_name = $lead['last_name'];
    $customer_name = [
        'first_name' => $first_name,
        'last_name' => $last_name
    ];
    $customer_name = json_encode($customer_name);
    $orders = [];
    $total_cost = 0;

    if($order == "" || $order == "null" || $order == "{}") {
        $orders = [
            [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]
        ]; 
        $total_cost = $order_cost;
    } else {
        $orders = json_decode($order, true);
        array_push($orders, [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]);
        foreach($orders as $order) {
            $total_cost += $order['order_cost'];
        }
    }

    $orders = json_encode($orders);

    $bot_orders_transactions = [
                    'user_id' => $user_id,
                    'orders' => $orders,
                    'total_cost' => $total_cost
                ];

    //setOrderTransactions
    $bot->storage->setOrderTransactions($bot_orders_transactions);
    
    return [
        $order_title . " is added to your cart.",
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => 'Continue Ordering',
                'payload' => 'START_ORDERING_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Show Cart',
                'payload' => 'SHOW_ORDERS_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Check Out',
                'payload' => 'START_CHECKOUT_PAYLOAD'
            ]
        ]
    ]; 
});

$bot->answer('payload:1_PBMS_REGULAR_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '1PBMSREGULAR';
    $order_title = '1 order of Regular Spaghetti Bolognese with Meatsauce';
    $order_cost = 105;
    $user_id = $lead_id;
    $first_name = $lead['first_name'];
    $last_name = $lead['last_name'];
    $customer_name = [
        'first_name' => $first_name,
        'last_name' => $last_name
    ];
    $customer_name = json_encode($customer_name);
    $orders = [];
    $total_cost = 0;

    if($order == "" || $order == "null" || $order == "{}") {
        $orders = [
            [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]
        ]; 
        $total_cost = $order_cost;
    } else {
        $orders = json_decode($order, true);
        array_push($orders, [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]);
        foreach($orders as $order) {
            $total_cost += $order['order_cost'];
        }
    }

    $orders = json_encode($orders);

    $bot_orders_transactions = [
                    'user_id' => $user_id,
                    'orders' => $orders,
                    'total_cost' => $total_cost
                ];

    //setOrderTransactions
    $bot->storage->setOrderTransactions($bot_orders_transactions);
    
    return [
        $order_title . " is added to your cart.",
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => 'Continue Ordering',
                'payload' => 'START_ORDERING_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Show Cart',
                'payload' => 'SHOW_ORDERS_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Check Out',
                'payload' => 'START_CHECKOUT_PAYLOAD'
            ]
        ]
    ]; 
});

$bot->answer('payload:2_PBMS_REGULAR_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '2PBMSREGULAR';
    $order_title = '2 orders of Regular Spaghetti Bolognese with Meatsauce';
    $order_cost = 210;
    $user_id = $lead_id;
    $first_name = $lead['first_name'];
    $last_name = $lead['last_name'];
    $customer_name = [
        'first_name' => $first_name,
        'last_name' => $last_name
    ];
    $customer_name = json_encode($customer_name);
    $orders = [];
    $total_cost = 0;

    if($order == "" || $order == "null" || $order == "{}") {
        $orders = [
            [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]
        ]; 
        $total_cost = $order_cost;
    } else {
        $orders = json_decode($order, true);
        array_push($orders, [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]);
        foreach($orders as $order) {
            $total_cost += $order['order_cost'];
        }
    }

    $orders = json_encode($orders);

    $bot_orders_transactions = [
                    'user_id' => $user_id,
                    'orders' => $orders,
                    'total_cost' => $total_cost
                ];

    //setOrderTransactions
    $bot->storage->setOrderTransactions($bot_orders_transactions);
    
    return [
        $order_title . " is added to your cart.",
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => 'Continue Ordering',
                'payload' => 'START_ORDERING_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Show Cart',
                'payload' => 'SHOW_ORDERS_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Check Out',
                'payload' => 'START_CHECKOUT_PAYLOAD'
            ]
        ]
    ]; 
});

$bot->answer('payload:3_PBMS_REGULAR_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '3PBMSREGULAR';
    $order_title = '3 orders of Regular Spaghetti Bolognese with Meatsauce';
    $order_cost = 315;
    $user_id = $lead_id;
    $first_name = $lead['first_name'];
    $last_name = $lead['last_name'];
    $customer_name = [
        'first_name' => $first_name,
        'last_name' => $last_name
    ];
    $customer_name = json_encode($customer_name);
    $orders = [];
    $total_cost = 0;

    if($order == "" || $order == "null" || $order == "{}") {
        $orders = [
            [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]
        ]; 
        $total_cost = $order_cost;
    } else {
        $orders = json_decode($order, true);
        array_push($orders, [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]);
        foreach($orders as $order) {
            $total_cost += $order['order_cost'];
        }
    }

    $orders = json_encode($orders);

    $bot_orders_transactions = [
                    'user_id' => $user_id,
                    'orders' => $orders,
                    'total_cost' => $total_cost
                ];

    //setOrderTransactions
    $bot->storage->setOrderTransactions($bot_orders_transactions);
    
    return [
        $order_title . " is added to your cart.",
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => 'Continue Ordering',
                'payload' => 'START_ORDERING_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Show Cart',
                'payload' => 'SHOW_ORDERS_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Check Out',
                'payload' => 'START_CHECKOUT_PAYLOAD'
            ]
        ]
    ]; 
});

$bot->answer('payload:1_PBMS_FAMILY_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '1PBMSFAMILY';
    $order_title = '1 order of Family Spaghetti Bolognese with Meatsauce';
    $order_cost = 299;
    $user_id = $lead_id;
    $first_name = $lead['first_name'];
    $last_name = $lead['last_name'];
    $customer_name = [
        'first_name' => $first_name,
        'last_name' => $last_name
    ];
    $customer_name = json_encode($customer_name);
    $orders = [];
    $total_cost = 0;

    if($order == "" || $order == "null" || $order == "{}") {
        $orders = [
            [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]
        ]; 
        $total_cost = $order_cost;
    } else {
        $orders = json_decode($order, true);
        array_push($orders, [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]);
        foreach($orders as $order) {
            $total_cost += $order['order_cost'];
        }
    }

    $orders = json_encode($orders);

    $bot_orders_transactions = [
                    'user_id' => $user_id,
                    'orders' => $orders,
                    'total_cost' => $total_cost
                ];

    //setOrderTransactions
    $bot->storage->setOrderTransactions($bot_orders_transactions);
    
    return [
        $order_title . " is added to your cart.",
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => 'Continue Ordering',
                'payload' => 'START_ORDERING_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Show Cart',
                'payload' => 'SHOW_ORDERS_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Check Out',
                'payload' => 'START_CHECKOUT_PAYLOAD'
            ]
        ]
    ]; 
});

$bot->answer('payload:2_PBMS_FAMILY_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '2PBMSFAMILY';
    $order_title = '2 orders of Family Spaghetti Bolognese with Meatsauce';
    $order_cost = 598;
    $user_id = $lead_id;
    $first_name = $lead['first_name'];
    $last_name = $lead['last_name'];
    $customer_name = [
        'first_name' => $first_name,
        'last_name' => $last_name
    ];
    $customer_name = json_encode($customer_name);
    $orders = [];
    $total_cost = 0;

    if($order == "" || $order == "null" || $order == "{}") {
        $orders = [
            [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]
        ]; 
        $total_cost = $order_cost;
    } else {
        $orders = json_decode($order, true);
        array_push($orders, [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]);
        foreach($orders as $order) {
            $total_cost += $order['order_cost'];
        }
    }

    $orders = json_encode($orders);

    $bot_orders_transactions = [
                    'user_id' => $user_id,
                    'orders' => $orders,
                    'total_cost' => $total_cost
                ];

    //setOrderTransactions
    $bot->storage->setOrderTransactions($bot_orders_transactions);
    
    return [
        $order_title . " is added to your cart.",
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => 'Continue Ordering',
                'payload' => 'START_ORDERING_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Show Cart',
                'payload' => 'SHOW_ORDERS_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Check Out',
                'payload' => 'START_CHECKOUT_PAYLOAD'
            ]
        ]
    ]; 
});

$bot->answer('payload:3_PBMS_FAMILY_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '3PBMSFAMILY';
    $order_title = '3 orders of Family Spaghetti Bolognese with Meatsauce';
    $order_cost = 897;
    $user_id = $lead_id;
    $first_name = $lead['first_name'];
    $last_name = $lead['last_name'];
    $customer_name = [
        'first_name' => $first_name,
        'last_name' => $last_name
    ];
    $customer_name = json_encode($customer_name);
    $orders = [];
    $total_cost = 0;

    if($order == "" || $order == "null" || $order == "{}") {
        $orders = [
            [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]
        ]; 
        $total_cost = $order_cost;
    } else {
        $orders = json_decode($order, true);
        array_push($orders, [
                'order_code' => $order_code,
                'order_title' => $order_title,
                'order_cost' => $order_cost
            ]);
        foreach($orders as $order) {
            $total_cost += $order['order_cost'];
        }
    }

    $orders = json_encode($orders);

    $bot_orders_transactions = [
                    'user_id' => $user_id,
                    'orders' => $orders,
                    'total_cost' => $total_cost
                ];

    //setOrderTransactions
    $bot->storage->setOrderTransactions($bot_orders_transactions);
    
    return [
        $order_title . " is added to your cart.",
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => 'Continue Ordering',
                'payload' => 'START_ORDERING_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Show Cart',
                'payload' => 'SHOW_ORDERS_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => 'Check Out',
                'payload' => 'START_CHECKOUT_PAYLOAD'
            ]
        ]
    ]; 
});
?>