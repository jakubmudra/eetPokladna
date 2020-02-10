<?php


namespace App\models;


class Product
{
    public function getAll()
    {
        return Db::allRows('SELECT * FROM `product` ORDER BY `id` ASC');
    }

    public function getTypes()
    {
        return Db::allRows("SELECT * FROM product_type");
    }

    public function getProductStockQuantity(int $id)
    {
        return Db::singleEntry("SELECT sum(p.quantity) count FROM products_in_stock p WHERE p.product_id = ?", [$id]) ?? 0;
    }

    public function getSingle(int $id)
    {
        return Db::oneRow('SELECT * FROM product WHERE id = ?', [$id]);
    }

    public function saveProduct($product, $id = false)
    {
        if (!$id)
            Db::insert('product', $product);
        else
            Db::update('product', $product, 'WHERE id = ?', [$id]);
    }

    public function removeProduct($id)
    {
        Db::rowCount('DELETE FROM product WHERE id = ?', [$id]);
    }
}