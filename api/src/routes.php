<?php
// Routes

$package = 'bot\Controllers';

// API


//post
$app->post ('/add/announcement', "$package\AnnouncementController:post_announcement"); 
$app->post ('/add/category', "$package\CategoryController:post_category");
$app->post ('/add/menu', "$package\MenuController:post_menu");
$app->post ('/add/deliverer', "$package\DelivererController:add_deliverer");
$app->post ('/add/discount', "$package\DiscountController:post_discount");
$app->post ('/add/tax', "$package\TaxController:post_tax");
$app->post ('/add/order', "$package\OrderController:post_orders");
$app->post ('/add/transaction', "$package\TransactionController:post_transaction");
$app->post ('/add/store', "$package\StoreController:post_store");
$app->post ('/add/customer', "$package\CustomerController:post_customer");
$app->post ('/add/feedback', "$package\FeedbackController:post_feedback");
$app->post ('/add/points', "$package\PointSystemController:post_points");


//stress test
$app->post ('/stress/transaction', "$package\TransactionController:stress_transaction");



//put
$app->put('/update/points', "$package\PointSystemController:put_points");
$app->put('/update/category', "$package\CategoryController:put_category");
$app->put('/update/deliverer', "$package\DelivererController:put_deliverer");
$app->put('/update/discount', "$package\DiscountController:put_discount");
$app->put('/update/tax', "$package\TaxController:put_tax");
$app->put('/update/menu', "$package\MenuController:put_menu");
$app->put('/update/customer', "$package\CustomerController:put_customer");
$app->put('/update/store', "$package\StoreController:put_store");

//get
$app->get('/get/transactions', "$package\TransactionController:get_transactions");
//$app->get('/get/transactions/transno/{transactionnum}', "$package\TransactionController:get_transactions");
//$app->get('/get/transactions/store/{idstore}', "$package\TransactionController:get_transactions");
//$app->get('/get/transactions/customer/{idcustomer}', "$package\TransactionController:get_transactions");
//$app->get('/get/transactions/delivery/{idtrans_status}', "$package\TransactionController:get_transactions");
//$app->get('/get/transactions/date/{dt_created}', "$package\TransactionController:get_transactions")
