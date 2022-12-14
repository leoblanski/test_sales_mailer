<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model {
  public function scopeDebugSql($model)
  {
      $query = str_replace(['%', '?'], ['%%', '\'%s\''], $model->toSql());
      $query = vsprintf($query, $model->getBindings());

      return $query;
  }
}