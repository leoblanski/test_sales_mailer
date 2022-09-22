<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Employee;
use Tests\TestCase;
use Tests\Scenaries\EmployeeScenary;

class EmployeeControllerTest extends TestCase
{
    use EmployeeScenary;

    protected $employeeGetAllStructure = [
        'count',
        'data' => [
            '*' => [
                'id',
                'name',
                'email',
                'comission_percentage',
                'created_at',
                'updated_at'
            ]
        ]
    ];

    public function setUp(): void
    {
        parent::setUp();
        $this->setupScenary();
    }

    public function tearDown(): void
    {
        parent::tearDown();
    }

    public function test_get_all()
    {
        $response = $this->json(
            'GET',
            '/api/employee/get-all',
            [],
            []
        );

        $response->assertStatus(200);
        $response->assertJsonStructure($this->employeeGetAllStructure);
    }

    public function test_get_filtered_by_name()
    {
        $response = $this->json(
            'GET',
            '/api/employee/get-all',
            [
                'filters' => [
                    'name' => $this->employee->name,
                ]
            ],
            []
        );

        $response->assertStatus(200);
        $response->assertJsonStructure($this->employeeGetAllStructure);
        $this->assertEquals(1, $response['count']);
        $this->assertEquals($this->employee->name, $response['data'][0]['name']);
    }

    public function test_get_filtered_by_email()
    {
        $response = $this->json(
            'GET',
            '/api/employee/get-all',
            [
                'filters' => [
                    'email' => $this->employee->email,
                ]
            ],
            []
        );

        $response->assertStatus(200);
        $response->assertJsonStructure($this->employeeGetAllStructure);
        $this->assertEquals(1, $response['count']);
        $this->assertEquals($this->employee->email, $response['data'][0]['email']);
    }

    public function test_not_get_filtered_by_wrong_email()
    {
        $response = $this->json(
            'GET',
            '/api/employee/get-all',
            [
                'filters' => [
                    'email' => 'invalidmail@invalid.com',
                ]
            ],
            []
        );

        $response->assertStatus(200);
        $response->assertJsonStructure($this->employeeGetAllStructure);
        $this->assertEquals(0, $response['count']);
    }

    public function test_not_delete_with_orders()
    {
        $response = $this->json(
            'DELETE',
            '/api/employee/delete/'.$this->employeeWithOrders->id,
            [],
            []
        );

        $response->assertStatus(400);
        $response->assertExactJson([
            'message' => 'Não é possível excluir o vendedor pois o mesmo possui vendas atribuídas.',
            'status' => 'error'
        ]);
    }

    public function test_delete_employee()
    {
        $response = $this->json(
            'DELETE',
            '/api/employee/delete/'.$this->employee->id,
            [],
            []
        );

        $response->assertStatus(200);
        $response->assertExactJson([
            'message' => 'Vendedor removido com sucesso.',
            'status' => 'success'
        ]);
    }
}
