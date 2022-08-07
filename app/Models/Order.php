<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeFilters($query, array $filters): void
    {
        if (isset($filters['employee_id']) && $filters['employee_id']) {
            $query->where("orders.employee_id", $filters['employee_id']);
        }
        if (isset($filters['employee_name']) && $filters['employee_name']) {
            $query->where("employees.name", "like", "%". $filters['employee_name'] ."%");
        }
        if (isset($filters['employee_email']) && $filters['employee_email']) {
            $query->where("employees.email", $filters['employee_email']);
        }
    }
}
