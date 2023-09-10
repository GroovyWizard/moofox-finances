<?php

namespace App\Models;

use App\Observers\FinanceObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\MonthlyTable;
use App\Models\Receiver;


class Finance extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'receiver', 'price', 'dueDate', 'monthly_table_id', 'product_id'];

    public static function buildFinance($payload, $tableId)
    {
        $finance = Finance::updateOrCreate(
            [
                'product_id' => $payload["product_id"],
            ],
            [
                'monthly_table_id' => $tableId,
                'name' => $payload["name"],
                'price' => $payload["price"],
                'receiver_id' => null,
                'dueDate' => $payload["dueDate"],
            ]
        );

        if ($payload["receiver_name"]) {
            $receiver = Receiver::updateOrCreate(
                [
                    'name' => $payload["receiver_name"],
                ]
            );

            $finance->receiver_id = $receiver->id;
            $finance->save();
        }

    }

    public function monthlyTable(): BelongsTo
    {
        return $this->belongsTo(MonthlyTable::class);
    }

    public function receiver(): BelongsTo
    {
        return $this->belongsTo(Receiver::class);
    }

}