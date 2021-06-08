<?php


namespace App\Service;


use App\Component\Db;

class OrderService
{
    public function createOrder($client, $product): bool
    {
        $serviceClient = new ClientService();
        $serviceProduct = new ProductService();
        try {
            Db::beginTransaction();
            $id_client = $serviceClient->createClient($client);
            $id_product = $serviceProduct->createProduct($product);
            if ($id_client > 0 && $id_product > 0) {
                Db::insert("INSERT INTO `order` (`client_id`, `product_id`)
            VALUES (?, ?)", [
                    $id_client, $id_product
                ]);
            }
            Db::commit();
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }
}