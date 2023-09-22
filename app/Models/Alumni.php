<?php

namespace App\Models;

use App\Models\Sekolah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Alumni extends Model
{
    use HasFactory;

    protected $guarded = ['id_rekap'];

    public function sekolah(){
        return $this->belongsTo(Sekolah::class, 'npsn_sekolah', 'npsn');
    }

}
