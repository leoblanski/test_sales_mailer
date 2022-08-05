<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'comission_percentage',
    ];

    //Valor default para cálculo da comissão
    const defaultComissionPercentage = 8.5;

    public function scopeFilters($query, array $filters): void
    {
        if (isset($filters['id']) && $filters['id']) {
            $query->where("employees.id", $filters['id']);
        }

        if (isset($filters['name']) && $filters['name']) {
            $query->where("employees.name", $filters['name']);
        }

        if (isset($filters['email']) && $filters['email']) {
            $query->where("employees.email", $filters['email']);
        }
    }
}
