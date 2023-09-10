<?php

namespace App\Http\Controllers;

use App\Models\MonthlyTable;
use Illuminate\Http\Request;
use App\Models\Finance;
use Response;
use App\Models\Receiver;

class ReceiverController extends Controller
{

    public function list(Request $request) {
        $mode = $request->input('mode');
        $receivers = Receiver::listAll($mode);

        return Response::json($receivers);
    }

}