<?php

namespace App\Observers;
use App\Models\Finance;

class FinanceObserver
{
    public function retrieved(Finance $model)
    {
        if($model->receiver) {
            $model->receiver_name = $model->receiver->name;
        }
    }

}
