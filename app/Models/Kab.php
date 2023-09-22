<?php

namespace App\Models;

use App\Models\Kcd;
use App\Models\Sekolah;
use App\Models\Wirausaha;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kab extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kab', 'id_kcd'];

    public function kcd()
    {
        return $this->belongsTo(Kcd::class, 'id_kcd');
    }

    public function sekolah()
    {
        return $this->hasMany(Sekolah::class);
    }

    // public function wirausaha()
    // {
    //     return $this->hasMany(Wirausaha::class);
    // }
}
