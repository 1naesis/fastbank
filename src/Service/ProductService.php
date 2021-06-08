<?php


namespace App\Service;


use App\Component\Db;

class ProductService
{
    public function createProduct($product):int
    {
        if ($product->product_type === $product::CREDIT) {
            $sql = "
                        INSERT INTO `product` (`date_open`, `date_close`, `term`, `amount`, `product_type`)
                        VALUES (?, ?, ?, ?, ?)
                    ";
            $prepare = [
                $product->date_open->format('Y-m-d H:i:s'),
                $product->date_close->format('Y-m-d H:i:s'),
                $product->term,
                $product->amount,
                $product->product_type
            ];
        } else if ($product->product_type === $product::DEPOSIT) {
            $sql = "
                        INSERT INTO `product` (`date_open`, `date_close`, `term`, `rate`, `capitalization`, `product_type`)
                        VALUES (?, ?, ?, ?, ?, ?)
                    ";
            $prepare = [
                $product->date_open->format('Y-m-d H:i:s'),
                $product->date_close->format('Y-m-d H:i:s'),
                $product->term,
                $product->rate,
                $product->capitalization,
                $product->product_type
            ];
        }

        if (isset($sql) && isset($prepare)) {
            Db::insert($sql, $prepare);
            return Db::query("
                SELECT `id` FROM `product` ORDER BY `id` DESC LIMIT 1;
                ")[0]['id'];
        }
        return 0;
    }

}