<?php
date_default_timezone_set("Asia/Manila");

include 'pizza_payload.php';
include 'pasta_payload.php';
include 'chicken_payload.php';

$bot->answer('default:', function($bot,$lead_id){
   if($bot->storage->isVerified($lead_id)){
        return [
        'Hi [first_name]! You typed an unknown command. Do you need something else?', 
         'quick_replies' => [
                [
                    'content_type' => 'text',
                    'title' => 'Check Out',
                    'payload' => 'START_CHECKOUT_PAYLOAD'
                ],
                [
                    'content_type' => 'text',
                    'title' => 'Show Cart',
                    'payload' => 'SHOW_ORDERS_PAYLOAD'
                ],
                [
                    'content_type' => 'text',
                    'title' => 'Clear Cart',
                    'payload' => 'CLEAR_ORDERS_PAYLOAD'
                ],
                [
                    'content_type' => 'text',
                    'title' => 'Continue Ordering',
                    'payload' => 'START_ORDERING_PAYLOAD'
                ]
            ]
       ];
    }else{
        return [
         'Hi [first_name], Kindly on-board yourself to the store and get a one-time 50% discount!', 
         'quick_replies' => [
                [
                    'content_type' => 'text',
                    'title' => 'Get Started',
                    'payload' => 'GIGA_GET_STARTED_PAYLOAD'
                ]
            ]
       ];
    }
});

$bot->answer('demo', function($bot,$lead_id){
    $orders = "";
    $orders = $bot->storage->getLeadOrder($lead_id);
    $x = json_decode($orders,true);
    $z = [];
    $countx = count($x);

    foreach($x as $order){
        $z = array(
                  '"title"=> ' => $order['order_title'],
                  '"subtitle"=>' => "Pizza Prototype",
                  '"quantity"=> ' => $order['order_count'],
                  '"price"=> ' => $order['order_cost'],
                  '"currency"=> ' => "PHP"
                );
    }

    return $orders;
});

$bot->answer('receipt', function($bot,$lead_id){

    $orders = [];
    $orders = $bot->storage->getLeadOrder($lead_id);
    $x = json_decode($orders,true);
    $y = $x;
    $z = [];

        foreach ($x as $order) {
                array_push($z,[
                  
                      'title' => $order['order_title'],
                      'subtitle' => "Pizza Prototype",
                      'quantity' => (string)$order['order_count'],
                      'price' => (string)$order['order_cost'],
                      'currency' => "PHP"
                  
                ]);
        }

    return [
        "recipient_name" => $bot->storage->getLeadName($lead_id),
        "order_number" => rand(0, 100000),
        "currency" => "PHP",
        "payment_method" => "Cash on delivery",
        "timestamp" => "1428444852",
        "elements" => [
            
                print_r($z)
            
        ],
        "address" => [
            "street_1" => "1 Hacker Way",
            "street_2" => "",
            "city" => "Menlo Park",
            "postal_code" => "94025",
            "state" => "CA",
            "country" => "US"
        ],
        "summary" => [
            "subtotal" => 75.00,
            "shipping_cost" => 4.95,
            "total_tax" => 6.19,
            "total_cost" => 56.14
        ],
        "adjustments" => [
            [
                "name" => "New Customer Discount",
                "amount" => 20
            ],
            [
                "name" => "$10 Off Coupon",
                "amount" => 10
            ]
        ]
    ];
});

$bot->answer('payload:START_ORDERING_PAYLOAD', function($bot,$lead_id) {
    if($bot->storage->isVerified($lead_id)){
        $lead = $bot->storage->get($lead_id);
        $user_id = $lead_id;

        $first_name = $lead['first_name'];
        $last_name = $lead['last_name'];

        $customer_name = json_encode([
            'first_name' => $first_name,
            'last_name' => $last_name
        ]);

        $bot_orders_transactions = [
                        'user_id' => $user_id,
                        'customer_name' => $customer_name
                    ];

        //setOrderTransactions
        $bot->storage->setUserTransactions($bot_orders_transactions);

        return [
            [
                "title"     => "Pizza Hut's Pizza",
                "image_url" => "http://bini101.com/bot/img/super_supreme.png",
                "subtitle"  => "Taste our pizza made with finest recipes and purely crafted by good people!",
                "buttons"   => [
                    [
                        "type"  => "postback",
                        "payload" => "BROWSE_PIZZA_MENU",
                        "title" => "Pizza"
                    ]
                ]
            ],
            [
                "title"     => "Pizza Hut's Pasta",
                "image_url" => "http://bini101.com/bot/img/pazta.png",
                "subtitle"  => "Savor our delicious pasta that will make you feel young!",
                "buttons"   => [
                    [
                        "type"    => "postback",
                        "payload" => "BROWSE_PASTA_MENU",
                        "title"   => "Pasta"
                    ]
                
                ]    
            ],
            [
                "title"     => "Pizza Hut's Chicken",
                "image_url" => "https://bini101.com/bot/img/chicken.jpg",
                "subtitle"  => "Try our mouth watering chicken seasoned with authentic spices and fried to perfection!",
                "buttons"   => [
                    [
                        "type"    => "postback",
                        "payload" => "BROWSE_CHICKEN_MENU",
                        "title"   => "Chicken"
                    ]
                
                ]   
            ],
        ];
    }else{
        return [
         'Hi [first_name], Kindly on-board yourself to the store and get a one-time 50% discount!', 
         'quick_replies' => [
                [
                    'content_type' => 'text',
                    'title' => 'Get Started',
                    'payload' => 'GIGA_GET_STARTED_PAYLOAD'
                ]
            ]
       ];
    }
});

$bot->answer('payload:START_CHECKOUT_PAYLOAD', function($bot,$lead_id){
    if($bot->storage->isVerified($lead_id)){
        return [
            'Please confirm your location to ensure smooth and speedy delivery of your food.',
            'quick_replies' => [
                [
                    'content_type' => 'location',
                    'title' => 'Location',
                    'payload' => 'USER_TAPPED_LOCATION'
                ]
            ]
        ];
    }else{
        return [
         'Hi [first_name], Kindly on-board yourself to the store and get a one-time 50% discount!', 
         'quick_replies' => [
                [
                    'content_type' => 'text',
                    'title' => 'Get Started',
                    'payload' => 'GIGA_GET_STARTED_PAYLOAD'
                ]
            ]
       ];
    }
});

$bot->answer('attachment:location', function ($bot, $lead_id,$input) {
    if($bot->storage->isVerified($lead_id)){
        $lead = $bot->storage->get($lead_id);
        $user_id = $lead_id;
        $location = $bot->getLocation();
        $location = json_encode($location);

        $bot_orders_transactions = [
                        'user_id' => $user_id,
                        'location' => $location
                    ];

        $nearest_store = $bot->storage->setOrderLocation($bot_orders_transactions);
        if(!isset($nearest_store['name'])){
            $nearest_store['name'] = "PH Kia";
        }
        
        return [
            "[first_name], " . $nearest_store['name'] . " has confirmed your order. Expect your food to arrive in 30 minutes.\n\nThank you for choosing Pizza Hut and enjoy your meal!",
            'quick_replies' => [
                [
                    'content_type' => 'text',
                    'title' => 'View Receipt',
                    'payload' => 'VIEW_RECEIPT_PAYLOAD'
                ]
            ]
        ];
    }else{
        $bot->storage->setLeadAddressMap($lead_id,$input);
        $bot->storage->setLeadStatus($lead_id);
        $bot->say('Congratulations, you are qualified for a 50% discount on any family pan pizza of your choice!');
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
    }
});

$bot->answer('payload:USER_TAPPED_YES', function ($bot, $user_id) {
    if($bot->storage->isVerified($lead_id)){
        $location = $bot->getLocation();
        return "Thanks for choosing Pizza Hut! We are now processing your order and will start delivering your order as soon as possible.";
    }else{
        return [
         'Hi [first_name], Kindly on-board yourself to the store and get a one-time 50% discount!', 
         'quick_replies' => [
                [
                    'content_type' => 'text',
                    'title' => 'Get Started',
                    'payload' => 'GIGA_GET_STARTED_PAYLOAD'
                ]
            ]
       ];
    }
});

$bot->answer('payload:VIEW_RECEIPT_PAYLOAD',function($bot,$lead_id){
    if($bot->storage->isVerified($lead_id)){
        date_default_timezone_set("Asia/Manila");
        $data = $bot->storage->getOrderTransactions($lead_id);
        $name_arr = json_decode($data['customer_name'],true);
        $name = $name_arr['first_name'] . " " . $name_arr['last_name'];
        $time = date("h:i a");
        $total = number_format($data['total_cost']) . '.0';
        return [
            [
                "title"     => "Pizza Hut's Order Receipt",
                "image_url" => "https://bini101.com/bot/img/cover3.png",
                "subtitle"  => "Customer name: {$name}\nTotal cost: ₱ {$total}\nTime received: {$time}"
            ]
        ];
    }else{
        return [
         'Hi [first_name], Kindly on-board yourself to the store and get a one-time 50% discount!', 
         'quick_replies' => [
                [
                    'content_type' => 'text',
                    'title' => 'Get Started',
                    'payload' => 'GIGA_GET_STARTED_PAYLOAD'
                ]
            ]
       ];
    }
});

$bot->answer('payload:CHECK_USER_BILL_PAYLOAD',function($bot,$lead_id){
    if($bot->storage->isVerified($lead_id)){
        $data = $bot->storage->getOrderTransactions($lead_id);
        return [
                    "In total you have: ₱" . number_format($data['total_cost']) . ".0",
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
    }else{
        return [
         'Hi [first_name], Kindly on-board yourself to the store and get a one-time 50% discount!', 
         'quick_replies' => [
                [
                    'content_type' => 'text',
                    'title' => 'Get Started',
                    'payload' => 'GIGA_GET_STARTED_PAYLOAD'
                ]
            ]
       ];
    }
});

$bot->answer('payload:CLEAR_ORDERS_PAYLOAD',function($bot,$lead_id){
    if($bot->storage->isVerified($lead_id)){
        $user_id = $lead_id;
        $order = $bot->storage->getOrderTransactions($lead_id);
        $order = $order['orders'];
        $carts = json_decode($order, true);
        $carts = "{}";
        $total_cost = 0;
        $bot_orders_transactions = ['user_id' => $user_id,'orders' => $carts,'total_cost' => $total_cost];
        //setOrderTransactions
        $bot->storage->setOrderTransactions($bot_orders_transactions);
        return [
                    "Cart cleared!",
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
    }else{
       return [
         'Hi [first_name], Kindly on-board yourself to the store and get a one-time 50% discount!', 
         'quick_replies' => [
                [
                    'content_type' => 'text',
                    'title' => 'Get Started',
                    'payload' => 'GIGA_GET_STARTED_PAYLOAD'
                ]
            ]
       ];
    }
});

$bot->answer('payload:SHOW_ORDERS_PAYLOAD',function($bot,$lead_id){
    if($bot->storage->isVerified($lead_id)){
            $order = $bot->storage->getOrderTransactions($lead_id);
            $order = $order['orders'];
            $carts = json_decode($order, true);
            $cart_list = "";
            for($i=0;$i<sizeof($carts);$i++) {
                if($i==sizeof($carts)) {
                    $cart_list = $cart_list.$carts[$i]['order_title'];
                } else {
                    $cart_list = $cart_list.$carts[$i]['order_title'].", ";      
                } 
            }
            if(!sizeof($carts)) {
                return [
                    "There are no orders in the cart.",
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
            }else{
                return [
                    "You have: " . $cart_list . " in the cart.",
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
        }
    }else{
        return [
         'Hi [first_name], Kindly on-board yourself to the store and get a one-time 50% discount!', 
         'quick_replies' => [
                [
                    'content_type' => 'text',
                    'title' => 'Get Started',
                    'payload' => 'GIGA_GET_STARTED_PAYLOAD'
                ]
            ]
       ];
    }
});

$bot->answer('payload:COUNT_ORDERS_PAYLOAD',function($bot,$lead_id){
    if($bot->storage->isVerified($lead_id)){
        $order = $bot->storage->getOrderTransactions($lead_id);
        $order = $order['orders'];
        $carts = json_decode($order, true);
        return "We've found " . sizeof($carts) . " items in your cart.";
    }else{
        return [
         'Hi [first_name], Kindly on-board yourself to the store and get a one-time 50% discount!', 
         'quick_replies' => [
                [
                    'content_type' => 'text',
                    'title' => 'Get Started',
                    'payload' => 'GIGA_GET_STARTED_PAYLOAD'
                ]
            ]
       ];
    }
});

?>

