<?php


namespace App\Controllers;


use App\models\Messages;
use App\models\Product;

class ProductController extends Controller
{

    function process($params)
    {
        // TODO: Implement process() method.
        $this->checkSecurity();
        $productModel = new Product();

        if (!empty($params[1]) && $params[0] == 'remove')
        {
            $productModel->removeProduct($params[1]);
            Messages::addMessage("Product succesfully removed");
            $this->redirect("product");
        }

        $products = $productModel->getAll();
        $this->setData("products", $products);

        if (isset($params[0])
            && $params[0] == "edit")
        {
            $this->setData("product", ["id" => "","name" => "", "price" => "", "type" => ""]);

            if( isset($_POST)
                && !empty($_POST['name'])
                && !empty($_POST['price'])
                && !empty($_POST['visibility'])
                && !empty($_POST['type'])) {

                $keys = ["name", "price", "visibility", "type"];
                $product = array_intersect_key($_POST, array_flip($keys));

                $productModel->saveProduct($product, $_POST['id']);
                Messages::addMessage("Product was saved");
                $this->redirect("product");
            }

            if (isset($params[1])) {
                $product = $productModel->getSingle($params[1]);
                if ($product) {
                    $this->setData("product", $product);
                }
            }

            $this->setData("types", $productModel->getTypes());


            $this->setTitle("Product edit");#
            $this->setTemplate("product/product-edit");
        } else {
            $this->setData("productModel", $productModel);

            $this->setTitle("Product List");#
            $this->setTemplate("product/productList");
        }


    }
}