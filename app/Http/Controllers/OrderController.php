<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Order;
use App\Repositories\OrderRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Create a new order
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $this->validateRequest($request);
            $params = $request->all();

            $employee = Employee::find($params['employee_id']);

            if (!$employee) {
                throw new \Exception("Vendedor não localizado.");
            }

            $order = new Order();
            $order->amount = $params['amount'];
            $order->employee_id = $params['employee_id'];
            $order->commission_amount = $this->calcComission((float)$params['amount']);

            if (!$order->save()) {
                throw new \Exception("Houve uma falha ao salvar a venda.");
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Venda registrada com sucesso.',
                'order' => [
                    'id' => $order->id,
                    'name' => $employee->name,
                    'commission_amount' => $order->commission_amount,
                    'amount' => $order->amount,
                    'order_date' => Carbon::parse($order->created_at)->format("d/m/Y"),
                ],
            ]);
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            return response()->json($response)->setStatusCode(400);
        }
        
    }

    /**
     * Get orders
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll(Request $request)
    {
        try {
            $filters = $request->all();

            $orders = (new OrderRepository)->getAllWithFilters($filters)->get()->toArray();
            
            return response()->json([
                'count' => count($orders),
                'data' => $orders,
            ]);
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            return response()->json($response)->setStatusCode(400);
        }
    }

    /**
     * Get sum by employee
     *
     * @return \Illuminate\Http\Response
     */
    public function getSumByEmployee(Request $request)
    {
        try {
            $filters = $request->all();

            $orders = (new OrderRepository)->getOrdersByEmployee($filters)->get()->toArray();
            
            return response()->json([
                'count' => count($orders),
                'data' => $orders,
            ]);
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            return response()->json($response)->setStatusCode(400);
        }
    }

    /**
     * Validate request
     * @param Request $request
    */
    private function validateRequest(Request $request) {
        $request->validate([
            'employee_id' => 'required|integer',
            'amount' => 'required',
        ]);
    }

    /**
     * Calculate amount comission
     * @param Request $request
     * return Float amount
    */
    private function calcComission(float $amount) {
        return str_replace(",", "", number_format($amount * (Employee::defaultComissionPercentage / 100), 2));
    }
}
