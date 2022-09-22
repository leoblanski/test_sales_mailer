<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends BaseModel
{
    use HasFactory;
    protected $guarded = [];

    public function scopeFilters($query, array $filters): void
    {
        if (isset($filters['employee_id']) && $filters['employee_id']) {
            $query->where("employees.id", $filters['employee_id']);
        }

        if (isset($filters['employee_name']) && $filters['employee_name']) {
            $query->where("employees.name", "like", "%". $filters['employee_name'] ."%");
        }

        if (isset($filters['employee_email']) && $filters['employee_email']) {
            $query->where("employees.email", $filters['employee_email']);
        }

        if (isset($filters['date_begin']) && $filters['date_begin']) {
            $query->whereRaw("orders.created_at >= '{$filters['date_begin']} 00:00:00'");
        }

        if (isset($filters['date_until']) && $filters['date_until']) {
            $query->whereRaw("orders.created_at <= '{$filters['date_until']} 23:59:59'");
        }
    }

    public static function employeeHasOrder(Int $employee_id)
    {
        return self::query()->where('employee_id', $employee_id)->first();
    }
    
}
