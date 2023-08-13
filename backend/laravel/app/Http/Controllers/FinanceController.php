<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Finance;
use Response;
use Exception;

class FinanceController extends Controller
{
     public function delete(Request $request, $itemId) {
        try { 
            $finance = Finance::firstOrFail();
            $finance->delete();
        } catch (Exception $e) {
            $message =  "Exception deleting finance" . $e->getMessage();
            error_log($message);
            return Response::json(["message" => $message],500);
        }

        return Response::json(["Finance deleted succesfully"], 200);
    }
}
