<?php

namespace App\Models;

use App\Models\Kab;
use App\Models\Wirausaha;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kcd extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nama_kcd', 'singkatan'];

    public function kab() {
        return $this->hasMany(Kab::class);
    }

    // public function wirausaha() {
    //     return $this->hasMany(Wirausaha::class);
    // }
}
