<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormulirJawaban extends Model
{
    use HasFactory;

    protected $fillable = ['pelamar_id', 'field_name', 'jawaban'];

    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class);
    }
}   