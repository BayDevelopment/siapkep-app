<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeninggalModel extends Model
{
    use SoftDeletes;

    protected $table = 'tb_meninggal';

    protected $primaryKey = 'id_meninggal';

    protected $fillable = ['resident_id', 'death_date', 'death_place', 'cause_of_death', 'notes', 'death_certificate_path'];

    protected $casts = [
        'death_date' => 'date',
    ];

    public function residentMeninggal()
    {
        return $this->BelongsTo(ResidentModel::class, 'resident_id', 'id_residents');
    }

    /**
     * Judul record untuk UI Filament (opsional, tapi enak).
     */
    public function getFilamentTitle(): string
    {
        return $this->residentMeninggal?->full_name ?? ('Meninggal #'.$this->id_meninggal);
    }
}
