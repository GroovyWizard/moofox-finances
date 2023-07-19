<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\MonthlyTable;

class Finance extends Model
{
    use HasFactory;


    public function monthlyTable(): BelongsTo
    {
        return $this->belongsTo(MonthlyTable::class);
    }
    
}
