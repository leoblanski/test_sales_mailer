<?php
declare(strict_types=1);

namespace Tests\Scenaries;

use App\Models\Employee;
use App\Models\Order;

trait OrderScenary
{
    /* Neste cenário serão criadas 1 venda para 2 vendedores, onde posteriormente será testado os filtros e somatórias de valores */
    protected $employeeA;
    protected $employeeB;

    protected $orderEmployeeA;
    protected $orderEmployeeB;

    public function setupScenary(): void
    {
      $this->employeeA = Employee::factory()->create([]);
      $this->employeeB = Employee::factory()->create([]);

      $this->orderEmployeeA = Order::factory()->create([
        'employee_id' => $this->employeeA->id,
        'amount' => 10.00
      ]);

      $this->orderEmployeeA = Order::factory()->create([
        'employee_id' => $this->employeeB->id,
        'amount' => 10.00
      ]);
    }
}
