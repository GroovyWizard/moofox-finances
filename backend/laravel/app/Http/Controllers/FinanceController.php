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

            //Item id is always 0 when the item is only created in frontend and was never saved to database
            if($itemId == 0) {
                return Response::json(["Finance wasnt saved to database, therefore no need to deletion, but no problems found"], 200);
            }

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
