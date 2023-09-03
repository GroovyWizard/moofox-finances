<?php

namespace App\Http\Controllers;

use App\Models\MonthlyTable;
use Illuminate\Http\Request;
use App\Models\Finance;
use Response;

class MonthlyTableController extends Controller
{
    public function list(Request $request, $year, $month)
    {
        $table = MonthlyTable::with('finances')->where("year", "=", $year)->where("month", "=", $month)->firstOrFail();
        return Response::json($table, 200);
    }



    public function save(Request $request, $year, $month)
    {
        $table = MonthlyTable::with('finances')->where("year", "=", $year)->where("month", "=", $month)->firstOrFail();

        foreach ($request->input("items") as $item) {
            Finance::updateOrCreate(
                [
                    'product_id' => $item["product_id"],
                ],
                [
                    'monthly_table_id' => $table["id"],
                    'name' => $item["name"],
                    'price' => $item["price"],
                    'receiver' => $item["receiver"],
                    'dueDate' => $item["dueDate"],
                ]
            );
            $table = MonthlyTable::with('finances')->where("year", "=", $year)->where("month", "=", $month)->firstOrFail();
        }

            return Response::json(['finances' => $table]);

    }
}