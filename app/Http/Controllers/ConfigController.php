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
    public function update()
    {
        //
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
