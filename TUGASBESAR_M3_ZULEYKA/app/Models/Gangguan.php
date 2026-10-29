<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gangguan extends Model
{
    protected $table = 'tabel_gangguan';

    public $timestamps = false;

    protected $fillable = [
        'jenis_gangguan',
        'kategori',
        'tingkat_prioritas',
    ];
}
