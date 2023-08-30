<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'parola_cruciverba',
        'selfie_festeggiato',
        'selfie_angolo',
        'brindisi',
        'video_brindisi',
        'dedica',
        'indovinello',
        'indovinello_due',
        'punteggio',
        'date'
    ];
}
