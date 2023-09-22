<?php

namespace App\Models;

use App\Models\Kab;
use App\Models\Kcd;
use App\Models\Sekolah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wirausaha extends Model
{
    use HasFactory;

    protected $guarded = [''];
    public function sekolah() {
        return $this->belongsTo(Sekolah::class, 'npsn_sekolah', 'npsn');
    }
}
