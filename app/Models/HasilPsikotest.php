<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPsikotest extends Model
{
    use HasFactory;
    
    protected $fillable = ['pelamar_id', 'skor', 'hasil', 'file_path', 'keterangan'];
    
    public function pelamar()
    {
        return $this->belongsTo(Pelamar::class);
    }
}