<?php

ini_set('display_errors', 1);

use App\Component\Router;
use App\Model\Client;
use App\Model\Product;
use App\Service\OrderService;
use App\Repository\OrderRepository;

include __DIR__.'/vendor/autoload.php';

Router::route('/', function(){
    if (!empty($_POST)) {
        $client = new Client($_POST['type_client']);
        $product = new Product($_POST['type_product']);
        $client->fillData($_POST[$_POST['type_client']]);
        $product->fillData($_POST['product'][$_POST['type_product']]);
        if ($client->validate() && $product->validate()) {
            $order = new OrderService();
            if ($order->createOrder($client, $product)) {
                $success = "Заявка отправлена";
            } else {
                $error = "Проблемы на сервере. Пожалуйста, повторите позже";
            }
        }
        $error_client = $client->getError();
        $error_product = $product->getError();
    }
    include __DIR__.'/view/new_order.php';
});

Router::route('/list([/]*)', function(){
    $orderRepository = new OrderRepository();
    $orders = $orderRepository->getAllOrders();
    include __DIR__.'/view/all_order.php';
});

Router::route('/list/(\d+)', function($id){
    $orderRepository = new OrderRepository();
    $order = $orderRepository->getOrderById($id);
    if (!$order) {
       header('Location: /list');
       exit();
    }
    include __DIR__.'/view/order.php';
});
Router::execute($_SERVER['REQUEST_URI']);