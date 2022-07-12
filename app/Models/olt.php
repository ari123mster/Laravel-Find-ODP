<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class olt extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'alamat', 'slot', 'port', 'latitude', 'longitude'
    ];

    public function odc()
    {
        return $this->hashMany(olt::class);
    }
}
