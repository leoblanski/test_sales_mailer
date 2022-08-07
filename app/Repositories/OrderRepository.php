<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    public function getAllWithFilters(array $filters)
    {
        $query = Order::query()
            ->selectRaw("orders.id")
            ->selectRaw("employees.name AS employee_name")
            ->selectRaw("employees.email AS employee_email")
            ->selectRaw("orders.amount")
            ->selectRaw("orders.commission_amount")
            ->selectRaw("DATE_FORMAT(orders.created_at, '%d/%m/%Y') as order_date")
            ->leftJoin("employees", function ($join) {
                $join->on("employees.id", "=", "orders.id");
            })
            ->filters($filters);

        // dd($query->toSql());
        return $query;
    }
}