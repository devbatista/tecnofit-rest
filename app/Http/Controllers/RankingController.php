<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PersonalRecord;

class RankingController extends Controller
{
    public function listRanking(Request $request, PersonalRecord $personalRecord) {
        $dados = ['error' => false];
        $movement_id = $request->input('movement_id');

        $records = $personalRecord->getRanking($movement_id);

        // Verifica se houve retorno de dados
        if(!$records->count()) {
            $dados = [
                'error' => true,
                'msg' => 'Movimento inexistente'
            ];
            return $dados;
        }

        // Pega o nome do movimento
        $ranking = ['movement' => $records[0]->movement];

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
