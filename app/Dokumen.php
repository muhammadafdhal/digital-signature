<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    //
    
    protected $primaryKey = 'dk_id';

    protected $fillable = ['dk_user_id','dk_nama','dk_noKtp','dk_tempatLahir','dk_tglLahir','dk_alamat','dk_dokumen','dk_status'];

    protected $casts = [
        'dk_anak' => 'array'
    ];
}
