<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MutationsModel extends Model
{
    use SoftDeletes;

    protected $table = 'tb_mutations';

    protected $primaryKey = 'id_mutations';

    protected $fillable = ['resident_id',	'mutation_type',	'mutation_date',	'old_address',	'new_address'];

    public function residentMutations()
    {
        return $this->BelongsTo(ResidentModel::class, 'resident_id', 'id_residents');
    }
}
