<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Receiver extends Model
{
    use HasFactory;
    protected $fillable = ['name'];


    public function finances(): HasMany
    {
        return $this->hasMany(Finance::class);
    }

    public static function listAll($mode)
    {
        if (!isset($mode)) {
             return Receiver::all();
        }

        switch ($mode) {
            default:
                return Receiver::all();
                break;
        }

    }
}