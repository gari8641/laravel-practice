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

  // 指定した年齢以上
  public function scopeAgeGreaterThan($query, $n)
  {
    return $query->where('age','>=', $n);
  }

  // 指定した年齢以下
  public function scopeAgeLessThan($query, $n)
  {
    return $query->where('age','<=', $n);
  }

}
