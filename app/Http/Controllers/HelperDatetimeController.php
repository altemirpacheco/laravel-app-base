<?php

namespace App\Http\Controllers;

class HelperDatetimeController extends Controller {
    private function generateResultados(): array {
        $resultados                       = [];
        $descricao                        = [];
        $resultados['AGORA']['resultado'] = now();
        $descricao['AGORA']               = 'Data e hora desse exato momento.';

        $resultados['HOJE']['resultado'] = today()->toDateString();
        $descricao['HOJE']               = 'Apenas a data de hoje.';

        $resultados['AGORA_MAIS_1_DIA']['resultado'] = now()->addDays(1)->toDateString();
        $descricao['AGORA_MAIS_1_DIA']               = 'Data de hoje mais um dia.';

        $resultados['FORMATO_BR']['resultado'] = now()->format('d/m/Y');
        $descricao['FORMATO_BR']               = 'Formato Brasileiro.';

        $resultados['FORMATO_BR_COM_HORA']['resultado'] = now()->format('d/m/Y H:i:s');
        $descricao['FORMATO_BR_COM_HORA']               = 'Formato Brasileiro com Horas.';

        $resultados['FORMATO_BR_COM_HORA_BUGADA']['resultado'] = now()->format('d/m/Y h:i:s');
        $descricao['FORMATO_BR_COM_HORA_BUGADA']               = "Formato Brasileiro com bug, pois o 'H' está minusculo.";

        $resultados['COMECO_MES_QUE_VEM_ANO_Q_VEM']['resultado'] = today()->addMonths(13)->startOfMonth()->format('d/m/Y H:i:s');
        $descricao['COMECO_MES_QUE_VEM_ANO_Q_VEM']               = 'Data de início do mês que vem no ano que vem.';

        $resultados['50_MESES_ATRAS']['resultado'] = now()->subMonths(50)->endOfDay()->format('d/m/Y H:i:s');
        $descricao['50_MESES_ATRAS']               = 'Que dia era a 50 meses atrás';

        $resultados['SO_O_DIA']['resultado'] = now()->day.' ## '.now()->month.' ## '.now()->year;
        $descricao['SO_O_DIA']               = 'Apenas o dia';

        $resultados['OUTROS']['resultado'] = now()->millennium;
        $descricao['OUTROS']               = 'Campo para teste de datas';

        $resultados['NOVA_DATA']['resultado'] = now()->create(2000, 02, 22)->format('d/m/Y H:i:s');
        $resultados['NOVA_DATA']['resultado'] = now()->create('2022-01-23')->format('d/m/Y H:i:s');
        $descricao['NOVA_DATA']               = 'Campo para teste de datas';

        return [$resultados, $descricao];
    }

    public function index() {
        [$resultados, $descricao] = $this->generateResultados();

        return view('pages.helpers.datetime', compact('resultados', 'descricao'));
    }

    public function indexDD() {
        [$resultados, $descricao] = $this->generateResultados();
        dd($resultados, $descricao);
    }
}
