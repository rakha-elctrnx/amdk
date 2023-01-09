<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class ReportController extends CoreController
{
    // List Laporan :
    // Pembelian
    // Penjualan
    // Transaksi Kas
    // Produksi
    // Penggunaan Bahan
    // Biaya Produksi
    // Laba Rugi
    public function report()
    {
        return view("modules/report");
    }
    public function report_buy_print(){
        $type = $this->request->getGet("type");

        $rows = $this->db->table("buy_items");

        $rows->select("buys.number as buy_number");
        $rows->select("buys.invoice_reference as buy_reference");
        $rows->select("buys.date as buy_date");
        $rows->select("suppliers.name as supplier_name");
        $rows->select("buy_items.snapshot_material_name as material_name");
        $rows->select("buy_items.snapshot_material_unit as material_unit");
        $rows->select("buy_items.price as item_price");
        $rows->select("buy_items.quantity as item_quantity");
        $rows->select("buy_items.discount as item_discount");

        $rows->join("buys","buy_items.buy_id=buys.id","left");
        $rows->join("suppliers","buys.supplier_id=suppliers.id","left");

        if($type == "date"){
            $begin_date = $this->request->getGet("begin_date");
            $end_date = $this->request->getGet("end_date");
            $month = NULL;
            $year = NULL;

            $rows->where("buys.date >=", $begin_date);
            $rows->where("buys.date <=", $end_date);
        }elseif($type == "month"){
            $begin_date = NULL;
            $end_date = NULL;
            $month = $this->request->getGet("month");
            $year = $this->request->getGet("year");

            $rows->where("buys.date >=", $year."-".$month."-01");
            $rows->where("buys.date <=", $year."-".$month."-31");
        }elseif($type == "year"){
            $begin_date = NULL;
            $end_date = NULL;
            $month = NULL;
            $year = $this->request->getGet("year");

            $rows->where("buys.date >=", $year."-01-01");
            $rows->where("buys.date <=", $year."-12-31");
        }

        // $rows->where("buys.admin_id",$this->session->admin_id);

        $rows->orderBy("buys.date","desc");
        $rows->orderBy("buy_items.id","desc");

        $rows = $rows->get();
        $rows = $rows->getResultObject();

        $data = ([
            "db"    => $this->db,
            "title" => "Pembelian",
            "type"  => $type,
            "begin_date" => $begin_date,
            "end_date" => $end_date,
            "month" => $month,
            "year" => $year,
            "rows"=>$rows,
        ]);

        return view("modules/report_buy_print",$data);
    }
    public function report_sale_print(){
        $type = $this->request->getGet("type");

        $rows = $this->db->table("sale_items");

        $rows->select("sales.number as sale_number");
        $rows->select("sales.date as sale_date");
        $rows->select("customers.name as customer_name");
        $rows->select("sale_items.snapshot_product_name as product_name");
        $rows->select("sale_items.snapshot_product_unit as product_unit");
        $rows->select("sale_items.price as item_price");
        $rows->select("sale_items.quantity as item_quantity");
        $rows->select("sale_items.discount as item_discount");

        $rows->join("sales","sale_items.sale_id=sales.id","left");
        $rows->join("customers","sales.customer_id=customers.id","left");

        if($type == "date"){
            $begin_date = $this->request->getGet("begin_date");
            $end_date = $this->request->getGet("end_date");
            $month = NULL;
            $year = NULL;

            $rows->where("sales.date >=", $begin_date);
            $rows->where("sales.date <=", $end_date);
        }elseif($type == "month"){
            $begin_date = NULL;
            $end_date = NULL;
            $month = $this->request->getGet("month");
            $year = $this->request->getGet("year");

            $rows->where("sales.date >=", $year."-".$month."-01");
            $rows->where("sales.date <=", $year."-".$month."-31");
        }elseif($type == "year"){
            $begin_date = NULL;
            $end_date = NULL;
            $month = NULL;
            $year = $this->request->getGet("year");

            $rows->where("sales.date >=", $year."-01-01");
            $rows->where("sales.date <=", $year."-12-31");
        }

        // $rows->where("sales.admin_id",$this->session->admin_id);
        $rows->orderBy("sales.date","desc");
        $rows->orderBy("sale_items.id","desc");

        $rows = $rows->get();
        $rows = $rows->getResultObject();

        $data = ([
            "db"    => $this->db,
            "title" => "Penjualan",
            "type"  => $type,
            "begin_date" => $begin_date,
            "end_date" => $end_date,
            "month" => $month,
            "year" => $year,
            "rows"=>$rows,
        ]);

        return view("modules/report_sale_print",$data);
    }
    public function report_transaction_print(){
        $type = $this->request->getGet("type");

        $rows = $this->db->table("transactions");
        if($type == "date"){
            $begin_date = $this->request->getGet("begin_date");
            $end_date = $this->request->getGet("end_date");
            $month = NULL;
            $year = NULL;

            $rows->where("date >=", $begin_date);
            $rows->where("date <=", $end_date);
        }elseif($type == "month"){
            $begin_date = NULL;
            $end_date = NULL;
            $month = $this->request->getGet("month");
            $year = $this->request->getGet("year");

            $rows->where("date >=", $year."-".$month."-01");
            $rows->where("date <=", $year."-".$month."-31");
        }elseif($type == "year"){
            $begin_date = NULL;
            $end_date = NULL;
            $month = NULL;
            $year = $this->request->getGet("year");

            $rows->where("date >=", $year."-01-01");
            $rows->where("date <=", $year."-12-31");
        }
        $rows->orderBy("date","desc");
        $rows->orderBy("id","desc");

        $rows = $rows->get();
        $rows = $rows->getResultObject();

        $data = ([
            "db"    => $this->db,
            "title" => "Transaksi Kas",
            "type"  => $type,
            "begin_date" => $begin_date,
            "end_date" => $end_date,
            "month" => $month,
            "year" => $year,
            "rows"=>$rows,
        ]);

        return view("modules/report_transaction_print",$data);
    }
    public function report_production_print(){
        $type = $this->request->getGet("type");

        $rows = $this->db->table("productions");
        if($type == "date"){
            $begin_date = $this->request->getGet("begin_date");
            $end_date = $this->request->getGet("end_date");
            $month = NULL;
            $year = NULL;

            $rows->where("production_date >=", $begin_date);
            $rows->where("production_date <=", $end_date);
        }elseif($type == "month"){
            $begin_date = NULL;
            $end_date = NULL;
            $month = $this->request->getGet("month");
            $year = $this->request->getGet("year");

            $rows->where("production_date >=", $year."-".$month."-01");
            $rows->where("production_date <=", $year."-".$month."-31");
        }elseif($type == "year"){
            $begin_date = NULL;
            $end_date = NULL;
            $month = NULL;
            $year = $this->request->getGet("year");

            $rows->where("production_date >=", $year."-01-01");
            $rows->where("production_date <=", $year."-12-31");
        }
        $rows->where("finish_date !=",NULL);
        $rows->orderBy("production_date","desc");
        $rows->orderBy("id","desc");

        $rows = $rows->get();
        $rows = $rows->getResultObject();

        $data = ([
            "db"    => $this->db,
            "title" => "Produksi",
            "type"  => $type,
            "begin_date" => $begin_date,
            "end_date" => $end_date,
            "month" => $month,
            "year" => $year,
            "rows"=>$rows,
        ]);

        return view("modules/report_production_print",$data);
    }
    public function report_use_print(){
        $type = $this->request->getGet("type");

        $rows = $this->db->table("ingredients");

        $rows->select("productions.number as production_number");
        $rows->select("productions.production_date as production_date");
        $rows->select("ingredients.snapshot_material_name as material_name");
        $rows->select("ingredients.snapshot_material_unit as material_unit");
        $rows->select("ingredients.quantity as item_quantity");

        $rows->join("productions","ingredients.production_id=productions.id","left");

        if($type == "date"){
            $begin_date = $this->request->getGet("begin_date");
            $end_date = $this->request->getGet("end_date");
            $month = NULL;
            $year = NULL;

            $rows->where("productions.production_date >=", $begin_date);
            $rows->where("productions.production_date <=", $end_date);
        }elseif($type == "month"){
            $begin_date = NULL;
            $end_date = NULL;
            $month = $this->request->getGet("month");
            $year = $this->request->getGet("year");

            $rows->where("productions.production_date >=", $year."-".$month."-01");
            $rows->where("productions.production_date <=", $year."-".$month."-31");
        }elseif($type == "year"){
            $begin_date = NULL;
            $end_date = NULL;
            $month = NULL;
            $year = $this->request->getGet("year");

            $rows->where("productions.production_date >=", $year."-01-01");
            $rows->where("productions.production_date <=", $year."-12-31");
        }

        // $rows->where("sales.admin_id",$this->session->admin_id);
        $rows->orderBy("productions.production_date","desc");
        $rows->orderBy("ingredients.id","desc");

        $rows = $rows->get();
        $rows = $rows->getResultObject();

        $data = ([
            "db"    => $this->db,
            "title" => "Penggunaan Bahan",
            "type"  => $type,
            "begin_date" => $begin_date,
            "end_date" => $end_date,
            "month" => $month,
            "year" => $year,
            "rows"=>$rows,
        ]);

        return view("modules/report_use_print",$data);
    }
    public function report_cost_print(){
        $type = $this->request->getGet("type");

        $rows = $this->db->table("costs");

        $rows->select("productions.number as production_number");
        $rows->select("productions.production_date as production_date");
        $rows->select("costs.details as cost_details");
        $rows->select("costs.price as cost_price");

        $rows->join("productions","costs.production_id=productions.id","left");

        if($type == "date"){
            $begin_date = $this->request->getGet("begin_date");
            $end_date = $this->request->getGet("end_date");
            $month = NULL;
            $year = NULL;

            $rows->where("productions.production_date >=", $begin_date);
            $rows->where("productions.production_date <=", $end_date);
        }elseif($type == "month"){
            $begin_date = NULL;
            $end_date = NULL;
            $month = $this->request->getGet("month");
            $year = $this->request->getGet("year");

            $rows->where("productions.production_date >=", $year."-".$month."-01");
            $rows->where("productions.production_date <=", $year."-".$month."-31");
        }elseif($type == "year"){
            $begin_date = NULL;
            $end_date = NULL;
            $month = NULL;
            $year = $this->request->getGet("year");

            $rows->where("productions.production_date >=", $year."-01-01");
            $rows->where("productions.production_date <=", $year."-12-31");
        }

        // $rows->where("sales.admin_id",$this->session->admin_id);
        $rows->orderBy("productions.production_date","desc");
        $rows->orderBy("costs.id","desc");

        $rows = $rows->get();
        $rows = $rows->getResultObject();

        $data = ([
            "db"    => $this->db,
            "title" => "Pembiayaan Produksi",
            "type"  => $type,
            "begin_date" => $begin_date,
            "end_date" => $end_date,
            "month" => $month,
            "year" => $year,
            "rows"=>$rows,
        ]);

        return view("modules/report_cost_print",$data);
    }
    public function report_summary_print(){
        $type = $this->request->getGet("type");
        if($type == "date"){
            $begin_date = $this->request->getGet("begin_date");
            $end_date = $this->request->getGet("end_date");
            $month = NULL;
            $year = NULL;
        }elseif($type == "month"){
            $month = $this->request->getGet("month");
            $year = $this->request->getGet("year");
            $begin_date = $year."-".$month."-01";
            $end_date = $year."-".$month."-31";
        }elseif($type == "year"){            
            $month = NULL;
            $year = $this->request->getGet("year");
            $begin_date = $year."-01-01";
            $end_date = $year."-12-31";
        }

        // Sales
        $sales = $this->db->table("sale_items");
        $sales->join("sales","sale_items.sale_id=sales.id");
        $sales->where("date >=", $begin_date);
        $sales->where("date <=", $end_date);
        $sales = $sales->get();
        $sales = $sales->getResultObject();
        $totalSales = 0;
        foreach($sales as $sale){
            $totalSales = $totalSales + ($sale->price * $sale->quantity - ($sale->price * $sale->quantity * $sale->discount / 100));
        }
        // Ins
        $ins = $this->db->table("transactions");
        $ins->where("debit !=",NULL);
        $ins->where("reference_table",NULL);
        $ins->where("date >=", $begin_date);
        $ins->where("date <=", $end_date);
        $ins = $ins->get();
        $ins = $ins->getResultObject();
        $totalIns = 0;
        foreach($ins as $in){
            $totalIns = $totalIns + $in->debit;
        }

        // Buys
        $buys = $this->db->table("buy_items");
        $buys->join("buys","buy_items.buy_id=buys.id");
        $buys->where("date >=", $begin_date);
        $buys->where("date <=", $end_date);
        $buys = $buys->get();
        $buys = $buys->getResultObject();
        $totalBuys = 0;
        foreach($buys as $buy){
            $totalBuys = $totalBuys + ($buy->price * $buy->quantity - ($buy->price * $buy->quantity * $buy->discount / 100));
        }
        // Outs
        $outs = $this->db->table("transactions");
        $outs->where("credit !=",NULL);
        $outs->where("reference_table",NULL);
        $outs->where("date >=", $begin_date);
        $outs->where("date <=", $end_date);
        $outs = $outs->get();
        $outs = $outs->getResultObject();
        $totalOuts = 0;
        foreach($outs as $out){
            $totalOuts = $totalOuts + $out->credit;
        }
        // Faileds
        $faileds = $this->db->table("productions");
        $faileds->where("production_date >=", $begin_date);
        $faileds->where("production_date <=", $end_date);
        $faileds = $faileds->get();
        $faileds = $faileds->getResultObject();
        $totalFaileds = 0;
        foreach($faileds as $failed){
            $totalFaileds = $totalFaileds + ($failed->faileds * $failed->snapshot_product_price);
        }
        // Costs
        $costs = $this->db->table("costs");
        $costs->join("productions","costs.production_id=productions.id");
        $costs->where("production_date >=", $begin_date);
        $costs->where("production_date <=", $end_date);
        $costs = $costs->get();
        $costs = $costs->getResultObject();
        $totalCosts = 0;
        foreach($costs as $cost){
            $totalCosts = $totalCosts + $cost->price;
        }

        $data = ([
            "db"    => $this->db,
            "title" => "Laba Rugi",
            "type"  => $type,
            "begin_date" => $begin_date,
            "end_date" => $end_date,
            "month" => $month,
            "year" => $year,
            "totalSales"=>$totalSales,
            "totalIns"=>$totalIns,
            "totalBuys"=>$totalBuys,
            "totalOuts"=>$totalOuts,
            "totalFaileds"=>$totalFaileds,
            "totalCosts"=>$totalCosts,
        ]);
        return view("modules/report_summary_print",$data);
    }
}
