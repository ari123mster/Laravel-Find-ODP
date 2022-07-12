<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class odc extends Model
{
    use HasFactory;
    protected $fillable = [
        'olt_id', 'nama', 'alamat', 'latitude', 'longitude'
    ];
    public function olt()
    {
        return  $this->belongsTo(olt::class);
    }

    // public function odp()
    // {
    //     return $this->hashMany(odp::class);
    // }
}
