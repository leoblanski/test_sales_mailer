<?php

namespace App\Http\Controllers;

use App\Jobs\SendMailOrders;
use App\Mail\MailTemplate;
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

            if (!SendMailOrders::dispatch($email)) {
                throw new \Exception("Não foi possível agendar o envio");
            };

            $response['status'] = "success";
            $response['message'] = "Agendamento de envio realizado com sucesso.";

            return response()->json($response);
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['status'] = 'error';
            return response()->json($response)->setStatusCode(400);
        } 
    }
}
