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
    }
}
