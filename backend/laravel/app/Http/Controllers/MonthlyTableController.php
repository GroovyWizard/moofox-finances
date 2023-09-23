<?php

namespace App\Http\Controllers;

use App\Models\MonthlyTable;
use Illuminate\Http\Request;
use App\Models\Finance;
use Response;
use Exception;

class MonthlyTableController extends Controller
{

    public function convertToCsv(Request $request, $year, $month)
    {
        $table = MonthlyTable::where(
            [
                "year" => $year,
                "month" => $month
            ]
        )->firstOrFail();

        $fileName = "$year-$month-table_export.csv";
        $output = fopen('php://temp', 'w');
        $header = ['name', 'price', 'dueDate', 'product_id'];
        fputcsv($output, $header);


        foreach ($table->finances as $row) {
            $rowData = [
                $row->name,
                $row->price,
                $row->dueDate,
                $row->product_id
            ];
            fputcsv($output, $rowData);
        }

        rewind($output);

        $csv = stream_get_contents($output);
        return Response::stream(function () use ($csv, $fileName) {
            header("Content-type: text/csv");
            header("Content-Disposition: attachment; filename=$fileName");
            echo $csv;
        }, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);


    }
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

        try {
            foreach ($request->input("items") as $item) {
                Finance::buildFinance($item, $table->id);
                $table = MonthlyTable::with('finances')->where("year", "=", $year)->where("month", "=", $month)->firstOrFail();
            }
        } catch (Exception $e) {
            return Response::json(['message' => $e->getMessage()], 500);
        }
        return Response::json(['finances' => $table]);

    }
}