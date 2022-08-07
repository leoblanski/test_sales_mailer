<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailOrders;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderMailer;
use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendMail(Request $request) {
        try {
            $email = $request->email;

            SendMailOrders::dispatch($email);

            $response['status'] = "success";
            $response['message'] = "Agendamento de e-mail realizado com sucesso.";

            return response()->json($response);
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['status'] = 'error';
            return response()->json($response)->setStatusCode(400);
        } 
    }
}
