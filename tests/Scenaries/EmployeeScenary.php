<?php
declare(strict_types=1);

namespace Tests\Scenaries;

use App\Models\Employee;
use App\Models\Order;

trait EmployeeScenary
{
    protected $employee;

    public function setupScenary(): void
    {
      $this->employee = Employee::factory()->create();

      $this->employeeWithOrders = Employee::factory()->create();
      
      Order::factory()->create([
        'employee_id' => $this->employeeWithOrders->id,
      ]);
    }
}
