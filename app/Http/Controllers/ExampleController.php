<?php

namespace App\Http\Controllers;

class ExampleController extends Controller
{
  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    //
  }
  public function index(){

    $ch = curl_init(); //Inicializa
    curl_setopt($ch, CURLOPT_URL, "http://prova.123milhas.net/api/flights"); //Acessa a URL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //Permite a captura do Retorno
    $retorno = curl_exec($ch); //Executa o cURL e guarda o Retorno em uma variável
    curl_close($ch); //Encerra a conexão

    $retorno = json_decode($retorno); //Ajuda a ser lido mais rapidamente
    $this->chaves($retorno);
    //return $retorno;
  }

  public function chaves($array){//função para gerar indices baseados nos tipos de tarifas

    $voos = $array; //transfere o array recebido para uma variavel mais facil de enxergar
    $chaves_tarifas = []; // cria um array para fazer as chaves

    foreach ($voos as $tarifa) {
      if (!isset($chaves_tarifas[$tarifa->fare])) {
        $chaves_tarifas[$tarifa->fare] = [];
      }
      $chaves_tarifas[$tarifa->fare][] = $tarifa;
    }
    $this->agrupamentos($chaves_tarifas);
  }

  public function agrupamentos($array){

    $voos = $array;
    $agrupamentos = [];
    $valorTotal = 0;


    foreach ($voos as $tarifa) {// percorrer os voos separados por tarifas
      $voosVolta = [];
      $voosIda = [];
      foreach ($tarifa as $data) {//percorrer os voos
        $tipoTarifa = $data->fare;

        if (!isset($agrupamentos["$data->fare"])) {
          $agrupamentos["$data->fare"] = [];

        }
        if($data->outbound == 1 && $data->fare == "$tipoTarifa") {
          $valorTotal += $data->price;
          $voosIda[] = $data->id;
        }if($data->inbound == 1 && $data->fare == "$tipoTarifa") {
          $valorTotal += $data->price;
          $voosVolta[] = $data->id;
        }
        }
        $grupo = array('valor total' => $valorTotal,
        'ida' => $voosIda,
        'volta' => $voosVolta);
        $agrupamentos["$data->fare"] = $grupo;


      }


    $retorno = array('flights:' => $voos,
    'groups:' => $agrupamentos,
    'totalGroups' => "",
    'totalFlights' => "",
    'cheapestPrice' => "",
    'cheapestGroup' => "");
    header('Content-Type: application/json');
    echo json_encode($retorno);

  }
  //
}
