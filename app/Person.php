<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    // モデルクラスにプロパティを追加し独自に拡張する
  public function getData()
  {
    return $this->id . ': ' . $this->name . ' (' . $this->age . ')';
  }

  // ローカルスコープ P239
  public function scopeNameEqual($query, $str)
  {
    return $query->where('name', $str);
  }
}
