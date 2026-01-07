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
        'address',	'rt_id',	'resident_status',	'status_changed_at',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function rt_rtmodel()
    {
        return $this->belongsTo(RTModel::class, 'rt_id', 'id');
    }

    public function mutationsToMutations()
    {
        return $this->hasMany(MutationsModel::class, 'resident_id', 'id_residents');
    }
}
