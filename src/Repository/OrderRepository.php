<?php


namespace App\Repository;


use App\Component\Db;

class OrderRepository
{
    /**
     * @return array
     */
    public function getAllOrders(): array
    {
        return Db::query("
            SELECT `client`.*, `product`.* FROM `order`
            LEFT JOIN `client` ON `client`.`id` = `order`.`client_id`
            LEFT JOIN `product` ON `product`.`id` = `order`.`product_id`
        ");
    }


    public function getOrderById(int $id): array|bool
    {
        $order = Db::query("
            SELECT `client`.*, `product`.* FROM `order`
            LEFT JOIN `client` ON `client`.`id` = `order`.`client_id`
            LEFT JOIN `product` ON `product`.`id` = `order`.`product_id`
            WHERE `order`.`id` = ? LIMIT 1
        ", [
            $id
        ]);
        if (isset($order[0])) {
            return $order[0];
        }
        return false;
    }
}