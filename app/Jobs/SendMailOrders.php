<?php

namespace App\Jobs;

use App\Mail\OrderMailer;
use App\Models\Order;
use App\Repositories\OrderRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SendMailOrders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(String $email)
    {
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $orders = (new OrderRepository)->getOrdersByEmployee([
            'date_begin' => Carbon::now()->format("Y-m-d"),
            'date_until' => Carbon::now()->format("Y-m-d"),
        ])
        ->get()
        ->toArray();

        $data = [
            'orders' => $orders,
            'email' => $this->email,
            'subject' => 'Vendas do dia ' . Carbon::now()->format("d/m/Y"),
            'date' => Carbon::now()->format("d/m/Y"),
        ];

        print_r("\n ====> Enviando e-mail para ". $data['email']);

        Mail::to($data['email'])->send(new OrderMailer($data));
    }
}