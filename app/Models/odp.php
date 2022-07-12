<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class odp extends Model
{
    use HasFactory;
    protected $fillable=[
        'olt_id','nama','alamat','port','terpakai','total','latitude','longitude'
    ];

    public function olt()
{
    return $this->belongsTo(olt::class);
}

// public function odc()
// {
//     return $this->belongsTo(olt::class);
// }
}
