<?php


namespace App\Controllers;


use App\models\Stock;

class StockController extends Controller
{

    function process($params)
    {
        $this->checkSecurity();

        $stockModel = new Stock();
        $stocks = $stockModel->getAll();

        $this->setData("stocks", $stocks);

        $this->setTitle("Stock");
        $this->setTemplate("stock/stockList");
    }
}