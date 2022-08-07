<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    /**
     * create a config to email
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $params = $request->all();
            $config = Config::first();

            if (!$config) {
                $config = new Config();
                $config->email = $params['email'];
                $config->time = $params['time'];
            } else {
                $config->email = $params['email'];
                $config->time = $params['time'];
            }

            if (!$config->save()) {
                throw new \Exception("Falha ao salvar configurações.");
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Configuração realizada com sucesso.',
            ]);
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['status'] = 'error';
            return response()->json($response)->setStatusCode(400);
        }
    }

    /**
     * get config email
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request)
    {
        try {
            $config = Config::query()->first();

            return response()->json([
                'config' => $config
            ]);
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['status'] = 'error';
            return response()->json($response)->setStatusCode(400);
        } 
    }
}
