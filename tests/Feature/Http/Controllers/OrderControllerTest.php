<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Order;
use Tests\TestCase;
use Tests\Scenaries\OrderScenary;

class OrderControllerTest extends TestCase
{
    use OrderScenary;

    protected $orderGetAllStructure = [
        'count',
        'data' => [
            '*' => [
                'id',
                'employee_name',
                'employee_email',
                'amount',
                'commission_amount',
                'order_date'
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
            '/api/order/get-all',
            [],
            []
        );

        $response->assertStatus(200);
        $response->assertJsonStructure($this->orderGetAllStructure);
        $this->assertEquals(2, $response['count']);
        $this->assertEquals(20, array_sum(array_column($response['data'], 'amount')));
    }

    public function test_get_filtered_employee_id()
    {
        $response = $this->json(
            'GET',
            '/api/order/get-all',
            [
                'filters' => [
                    'employee_id' => $this->employeeA->id,
                ]
            ],
            []
        );

        $response->assertStatus(200);
        $response->assertJsonStructure($this->orderGetAllStructure);
        $this->assertEquals(1, $response['count']);
        $this->assertEquals($this->employeeA->name, $response['data'][0]['employee_name']);
    }

    public function test_not_create_without_amount_param()
    {
        $response = $this->json(
            'post',
            '/api/order/create',
            [
                'employee_id' => $this->employeeA->id,
            ],
            []
        );

        $response->assertStatus(400);

        $response->assertExactJson([
            'message' => 'The amount field is required.',
            'status' => 'error'
        ]);
    }

    public function test_not_create_without_employee_id_param()
    {
        $response = $this->json(
            'post',
            '/api/order/create',
            [
                'amount' => 10,
            ],
            []
        );

        $response->assertStatus(400);

        $response->assertExactJson([
            'message' => 'The employee id field is required.',
            'status' => 'error'
        ]);
    }

    public function test_not_create_with_string_employee_id_param()
    {
        $response = $this->json(
            'post',
            '/api/order/create',
            [
                'employee_id' => "a",
                'amount' => 10,
            ],
            []
        );

        $response->assertStatus(400);

        $response->assertExactJson([
            'message' => 'The employee id must be an integer.',
            'status' => 'error'
        ]);
    }

    public function test_not_create_with_not_found_employee_id_param()
    {
        $response = $this->json(
            'post',
            '/api/order/create',
            [
                'employee_id' => 9999999,
                'amount' => 10,
            ],
            []
        );

        $response->assertStatus(400);

        $response->assertExactJson([
            'message' => 'Vendedor não localizado.',
            'status' => 'error'
        ]);
    }

    public function test_create_with_correct_param()
    {
        $response = $this->json(
            'post',
            '/api/order/create',
            [
                'employee_id' => $this->employeeA->id,
                'amount' => 10,
            ],
            []
        );

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'status',
            'message',
            'order' => [
                'id',
                'name',
                'commission_amount',
                'amount',
                'order_date',
            ]
        ]);
    }
}
