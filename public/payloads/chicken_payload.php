<?php

$bot->answer('payload:BROWSE_CHICKEN_MENU', function() {

    $query = file_get_contents("mock/menu.json");

    $result = json_decode($query, true);

    return $result;
});

$bot->answer('payload:ORDER_BUFFFALO_WINGS_FOUR', [ 'You have selected 4pcs of Buffalo Wings. How many orders would you like to have?',
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => '1',
                'payload' => '1_BW_FOUR_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '2',
                'payload' => '2_BW_FOUR_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '3',
                'payload' => '3_BW_FOUR_PAYLOAD'
            ]
        ]
]);

$bot->answer('payload:ORDER_BUFFFALO_WINGS_SIX', [ 'You have selected 6pcs of Buffalo Wings. How many orders would you like to have?',
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => '1',
                'payload' => '1_BW_SIX_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '2',
                'payload' => '2_BW_SIX_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '3',
                'payload' => '3_BW_SIX_PAYLOAD'
            ]
        ]
]);

$bot->answer('payload:ORDER_CREAMY_CHICKEN_FOUR', [ 'You have selected 4pcs of Creamy White Chicken. How many orders would you like to have?',
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => '1',
                'payload' => '1_CC_FOUR_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '2',
                'payload' => '2_CC_FOUR_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '3',
                'payload' => '3_C_FOUR_PAYLOAD'
            ]
        ]
]);

$bot->answer('payload:ORDER_CREAMY_CHICKEN_SIX', [ 'You have selected 6pcs of Creamy White Chicken. How many orders would you like to have?',
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => '1',
                'payload' => '1_CC_SIX_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '2',
                'payload' => '2_CC_SIX_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '3',
                'payload' => '3_CC_SIX_PAYLOAD'
            ]
        ]
]);

$bot->answer('payload:ORDER_GLAZED_CHICKEN_FOUR', [ 'You have selected 4pcs of Ginger Soy Glazed Chicken. How many orders would you like to have?',
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => '1',
                'payload' => '1_GSGC_FOUR_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '2',
                'payload' => '2_GSGC_FOUR_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '3',
                'payload' => '3_GSGC_FOUR_PAYLOAD'
            ]
        ]
]);

$bot->answer('payload:ORDER_GLAZED_CHICKEN_SIX', [ 'You have selected 6pcs of Ginger Soy Glazed Chicken. How many orders would you like to have?',
        'quick_replies' => [
            [
                'content_type' => 'text',
                'title' => '1',
                'payload' => '1_GSGC_SIX_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '2',
                'payload' => '2_GSGC_SIX_PAYLOAD'
            ],
            [
                'content_type' => 'text',
                'title' => '3',
                'payload' => '3_GSGC_SIX_PAYLOAD'
            ]
        ]
]);

$bot->answer('payload:1_BW_FOUR_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '1BW4PCS';
    $order_title = '1 order of 4pcs Buffalo Wings';
    $order_cost = 159;
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

$bot->answer('payload:2_BW_FOUR_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '2BW4PCS';
    $order_title = '2 orders of 4pcs Buffalo Wings';
    $order_cost = 318;
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

$bot->answer('payload:3_BW_FOUR_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '3BW4PCS';
    $order_title = '3 orders of 4pcs Buffalo Wings';
    $order_cost = 477;
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

$bot->answer('payload:1_BW_SIX_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '1BW6PCS';
    $order_title = '1 order of 6pcs Buffalo Wings';
    $order_cost = 229;
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

$bot->answer('payload:2_BW_SIX_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '2BW6PCS';
    $order_title = '2 orders of 6pcs Buffalo Wings';
    $order_cost = 458;
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

$bot->answer('payload:3_BW_SIX_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '3BW6PCS';
    $order_title = '3 orders of 6pcs Buffalo Wings';
    $order_cost = 687;
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

$bot->answer('payload:1_CC_FOUR_PAYLOAD',function($bot,$lead_id){
     $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '1CC4PCS';
    $order_title = '1 order of 4pcs Creamy Chicken';
    $order_cost = 159;
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

$bot->answer('payload:2_CC_FOUR_PAYLOAD',function($bot,$lead_id){
     $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '2CC4PCS';
    $order_title = '2 orders of 4pcs Creamy Chicken';
    $order_cost = 318;
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

$bot->answer('payload:3_CC_FOUR_PAYLOAD',function($bot,$lead_id){
     $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '3CC4PCS';
    $order_title = '3 orders of 4pcs Creamy Chicken';
    $order_cost = 477;
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

$bot->answer('payload:1_CC_SIX_PAYLOAD',function($bot,$lead_id){
     $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '1CC6PCS';
    $order_title = '1 order of 6pcs Creamy Chicken';
    $order_cost = 159;
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

$bot->answer('payload:2_CC_SIX_PAYLOAD',function($bot,$lead_id){
     $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '2CC6PCS';
    $order_title = '2 orders of 6pcs Creamy Chicken';
    $order_cost = 458;
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

$bot->answer('payload:3_CC_SIX_PAYLOAD',function($bot,$lead_id){
     $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '3CC6PCS';
    $order_title = '3 orders of 6pcs Creamy Chicken';
    $order_cost = 687;
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

$bot->answer('payload:1_GSGC_FOUR_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '1GSGC4PCS';
    $order_title = '1 order of 4pcs Ginger Soy Glazed Chicken';
    $order_cost = 159;
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

$bot->answer('payload:2_GSGC_FOUR_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '2GSGC4PCS';
    $order_title = '2 orders of 4pcs Ginger Soy Glazed Chicken';
    $order_cost = 318;
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

$bot->answer('payload:3_GSGC_FOUR_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '3GSGC4PCS';
    $order_title = '3 orders of 4pcs Ginger Soy Glazed Chicken';
    $order_cost = 477;
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

$bot->answer('payload:1_GSGC_SIX_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '1GSGC6PCS';
    $order_title = '1 order of 6pcs Ginger Soy Glazed Chicken';
    $order_cost = 229;
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

$bot->answer('payload:2_GSGC_SIX_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '2GSGC6PCS';
    $order_title = '2 orders of 6pcs Ginger Soy Glazed Chicken';
    $order_cost = 458;
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

$bot->answer('payload:3_GSGC_SIX_PAYLOAD',function($bot,$lead_id){
    $lead = $bot->storage->get($lead_id);
    $order = $bot->storage->getOrderTransactions($lead_id);
    $order = $order['orders'];
    $order_code = '3GSGC6PCS';
    $order_title = '3 orders of 6pcs Ginger Soy Glazed Chicken';
    $order_cost = 687;
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