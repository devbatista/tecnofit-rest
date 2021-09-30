<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PersonalRecord extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = 'personal_record';

    public function getRanking($movement_id) {
        $retorno = DB::table('personal_record as p')
            ->select('u.name as name', 'p.value', 'm.name as movement', 'p.date')
            ->join('movement as m', 'p.movement_id', '=', 'm.id')
            ->join('user as u', 'p.user_id', '=', 'u.id')
            ->where('movement_id', $movement_id)
            ->orderByDesc('value')
            ->orderBy('date')
            ->get();

        return $retorno;
    }
}
