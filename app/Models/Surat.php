<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'surats';

    protected $guarded = ['id'];

    public function kategoriSurat()
    {
        return $this->belongsTo(Surat::class);
    }
}
