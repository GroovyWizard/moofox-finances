<?php

namespace App\Http\Controllers;

use App\Models\MonthlyTable;
use Illuminate\Http\Request;
use Response;

class MonthlyTableController extends Controller
{
    public function list(Request $request, $year, $month)
    {
        $table = MonthlyTable::with('finances')->where("year", "=", $year)->where("month", "=", $month)->firstOrFail();
        return Response::json($table, 200);
    }

    public function addFinances(Request $request)
    {

    }
}