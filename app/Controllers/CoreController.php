<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class CoreController extends BaseController
{
    protected $session;
    protected $db;
    protected $adminModel;
    protected $supplierModel;
    protected $customerModel;
    protected $materialModel;
    protected $transactionModel;
    protected $productModel;
    protected $productVariantModel;
    protected $buyModel;
    protected $saleModel;
    protected $stockModel;
    
    public function __construct(){
        $this->session = \Config\Services::session();
        $this->db      = \Config\Database::connect();
        $this->adminModel = new \App\Models\AdministratorModel();
        $this->supplierModel = new \App\Models\SupplierModel();
        $this->customerModel = new \App\Models\CustomerModel();
        $this->materialModel = new \App\Models\MaterialModel();
        $this->transactionModel = new \App\Models\TransactionModel();
        $this->productModel = new \App\Models\ProductModel();
        $this->productVariantModel = new \App\Models\ProductVariantModel();
        $this->buyModel = new \App\Models\BuyModel();
        $this->buyItemModel = new \App\Models\BuyItemModel();
        $this->ingredientModel = new \App\Models\IngredientModel();
        $this->saleModel = new \App\Models\SaleModel();
        $this->stockModel = new \App\Models\StockModel();

        if ($this->session->admin_id == null) {
            $this->session->setFlashdata('msg', 'Login terlebih dahulu!');
            header("location:" . base_url('/'));
            exit();
        }
    }
}
