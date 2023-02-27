<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temperature extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    protected $appends = ['time'];

    public function getTimeAttribute()
    {
        return $this->created_at->format('H:i:s');
    }
}
