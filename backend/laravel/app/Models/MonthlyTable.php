<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Finance;

class MonthlyTable extends Model
{
    use HasFactory;


    public function finances(): HasMany
    {
        return $this->hasMany(Finance::class);
    }
}