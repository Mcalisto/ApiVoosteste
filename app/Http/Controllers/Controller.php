<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
  /*foreach ($voos as $data) {
    if(!isset($chaves_tarifas[$data->fare])) {
        $chaves_tarifas[$data->fare] = [];
        if (!isset($chaves_tarifas[$data->fare][$data->outbound])) {
          $chaves_tarifas[$data->fare][$data->outbound] = [];
        }
        if (!isset($chaves_tarifas[$data->fare][$data->inbound])) {
          $chaves_tarifas[$data->fare][$data->inbound] = [];
        }
    }
    if ($data->outbound == 1) {
      $chaves_tarifas[$data->fare][$data->outbound][] = $data;
    }else {
      $chaves_tarifas[$data->fare][$data->inbound][] = $data;
    }

    if ($data->outbound == 0) {
      $chaves_tarifas[$data->fare][$data->outbound][] = $data;
    }else {
      $chaves_tarifas[$data->fare][$data->inbound][] = $data;
    }
}*/
}
