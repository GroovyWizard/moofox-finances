<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;

class MonthlyTableController extends Controller
{
    public function list(Request $request)
    {
        return Response::json([
            "finances" => [
                [
                    "id" => "",
                    "name" => "Game X",
                    "value" => 30
                ]
            ]
        ], 200);

    }

    public function addFinances(Request $request)
    {

    }
}