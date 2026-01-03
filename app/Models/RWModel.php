<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RWModel extends Model
{
    use SoftDeletes;

    protected $table = 'tb_rws';

    protected $primaryKey = 'id';

    protected $fillable = ['no_rw',	'name'];

    public function rts()
    {
        return $this->hasMany(RTModel::class, 'rw_id');
    }
}
