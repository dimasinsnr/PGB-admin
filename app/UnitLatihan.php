<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitLatihan extends Model
{
    // use Notifiable;
    use HasFactory;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'unit_latihan_id', 
        'unit_latihan_kode', 
        'unit_latihan_nama', 
        'unit_latihan_created_at', 
        'unit_latihan_updated_at', 
        'unit_latihan_deleted_at',
    ];

}
