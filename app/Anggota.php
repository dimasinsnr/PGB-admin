<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'anggota_id', 
        'anggota_unit_latihan_id', 
        'anggota_nama', 
        'anggota_email', 
        'anggota_tempat_lahir', 
        'anggota_tgl_lahir', 
        'anggota_usia', 
        'anggota_jenis_kelamin', 
        'anggota_alamat', 
        'anggota_jenis_identitas', 
        'anggota_no_identitas', 
        'anggota_jenis_pekerjaan', 
        'anggota_no_hp', 
        'anggota_gol_darah', 
        'anggota_catatan_alergi', 
        'anggota_riwayat_sakit', 
        'anggota_tanggal_mulai', 
        'anggota_foto', 
        'anggota_created_at', 
        'anggota_updated_at', 
        'anggota_deleted_at',
    ];

}
