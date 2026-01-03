<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class RTModel extends Model
{
    use SoftDeletes;

    protected $table = 'tb_rts';

    protected $fillable = [
        'rw_id',
        'no_rt',
        'name',
    ];

    public function rw(): BelongsTo
    {
        return $this->belongsTo(RWModel::class, 'rw_id');
    }
}
