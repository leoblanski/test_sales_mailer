<?php

namespace App\Repositories;

interface RepositoryInterface {
  public function getAllWithFilters(array $filters);
}
