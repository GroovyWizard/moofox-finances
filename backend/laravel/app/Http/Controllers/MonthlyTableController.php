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
        MonthlyTable::updateOrCreate(
            [
                "year" => $year,
                "month" => $month
            ]
        );

        $table = MonthlyTable::with('finances')->where("year", "=", $year)->where("month", "=", $month)->firstOrFail();
        foreach ($table->finances as $finance) {
            $finance->receiver_name = $finance->receiver->name;
        }

        return Response::json($table, 200);
    }

    public function addFinances(Request $request, $year, $month)
    {
        $table = MonthlyTable::with('finances')->where("year", "=", $year)->where("month", "=", $month)->firstOrFail();

        foreach ($request->input("items") as $item) {
            Finance::buildFinance($item, $table->id);
            $table = MonthlyTable::with('finances')->where("year", "=", $year)->where("month", "=", $month)->firstOrFail();
        }

        return Response::json(['finances' => $table]);

    }
}