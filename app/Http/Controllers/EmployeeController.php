<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Order;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a specific employee
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request, Employee $employee)
    {
        try {
            return response()->json([
                'employee' => $employee
            ]);
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['status'] = 'error';
            return response()->json($response)->setStatusCode(400);
        } 
    }

    /**
     * Display a listing of employess
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function getAll(Request $request)
    {
        try {
            $filters = $request->get('filters', []);

            $employees = Employee::query()
                ->filters($filters)
                ->get()
                ->toArray();

            return response()->json([
                'count' => count($employees),
                'data' => $employees
            ]);
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['status'] = 'error';
            return response()->json($response)->setStatusCode(400);
        } 
    }

    /**
     * Create a new employee
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $this->validateRequest($request);

            $employee = Employee::create([
                'name' => $request->name,
                'email' => $request->email,
                'comission_percentage' => Employee::defaultComissionPercentage,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Vendedor criado com sucesso.',
                'employee' => [
                    'id' => $employee->id,
                    'name' => $employee->name,
                    'email' => $employee->email,
                ]
            ]);
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['status'] = 'error';
            return response()->json($response)->setStatusCode(400);
        } 
    }

    /**
     * Update the specified employee
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        try {
            $this->validateRequest($request);

            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->save();

            return response()->json([
                'status' => 'success',
                'message' => "Vendedor editado com sucesso.",
                'employee' => $employee
            ]);
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['status'] = 'error';
            return response()->json($response)->setStatusCode(400);
        }
    }

    /**
     * Remove the specified employee
     *
     * @param  \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function delete(Employee $employee)
    {
        try {
            //Valida se o vendedor possui vendas atribuídas a ele, caso positivo não efetua a exclusão.
            if (Order::employeeHasOrder($employee->id)) {
                throw new \Exception("Não é possível excluir o vendedor pois o mesmo possui vendas atribuídas.");
            }

            $employee->delete();

            return response()->json([
                'status' => 'success',
                'message' => "Vendedor removido com sucesso.",
            ]);
        } catch (\Exception $e) {
            $response['message'] = $e->getMessage();
            $response['status'] = 'error';
            return response()->json($response)->setStatusCode(400);
        }
    }

    /**
     * Validate request
     * @param Request $request
    */
    private function validateRequest(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email:rfc',
        ]);
    }
}
