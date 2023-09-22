<?php

namespace App\Models;

use App\Models\Wirausaha;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sekolah extends Model
{
    use HasFactory;

    protected $fillable = ['npsn', 'nama_sekolah', 'status', 'id_kab', 'jml_wirausaha'];

    public function kab() {
        return $this->belongsTo(Kab::class, 'id_kab');
    }

    public function wirausaha() {
        return $this->hasMany(Wirausaha::class, 'npsn_sekolah', 'npsn');
    }

}
