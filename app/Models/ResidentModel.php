<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ResidentModel extends Model
{
    use SoftDeletes;

    protected $table = 'tb_residents'; // <— paksa pakai tabel ini

    protected $primaryKey = 'id_residents';

    protected $fillable = [
        'nik',
        'full_name',
        'birth_place',
        'birth_date',
        'gender',
        'address',
        'rw',
        'rt',
        'status',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];
}
