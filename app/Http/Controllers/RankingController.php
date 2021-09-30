<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalRecord;
use App\Models\Movement;

class RankingController extends Controller
{
    public function listRanking(Request $request, PersonalRecord $personalRecord, Movement $movements) {
        $dados = ['error' => false];
        $movement_id = $request->input('movement_id');

        $movement = $movements->where('id', $movement_id)->select('name')->first();
        // Verifica se é um movimento existente
        if(!$movement) {
            $dados = [
                'error' => true,
                'msg' => 'Movimento inexistente'
            ];
            return $dados;
        }

        $records = $personalRecord->getRanking($movement_id);
        // Verifica se houve retorno de dados do personal_record
        if(!$records->count()) {
            $dados = [
                'error' => true,
                'msg' => 'Não há dados sobre esse movimento',
                'movement' => $movement
            ];
            return $dados;
        }

        // Pega o nome do movimento
        $ranking = ['movement' => $movement->name];

        // Organiza o ranking de acordo com os valores
        $posicao = 0;
        $classificacao = 1;
        $thisValue = 0;

        foreach($records as $item) {
            unset($item->movement);

            if($thisValue != $item->value){
                $posicao++;
                $item->posicao = $classificacao;
            } else {
                $item->posicao = $posicao;
                $posicao = $classificacao;
            }

            $thisValue = $item->value;

            $ranking['ranking'][] = $item;
            $classificacao++;
        }
        $dados['list'] = $ranking;

        return $dados;
    }
}
