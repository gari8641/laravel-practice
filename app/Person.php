<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


// グローバルスコープのために追加
use Illuminate\Database\Eloquent\Builder;

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

  // グローバルスコープ p243
  // boot()は、モデルの初期化専用のメソッド。静的メソッド
  protected static function boot()
  {
    parent::boot();

    // 第一引数はスコープの名前、
    // 第二引数にクロージャ（Builderインスタンスが引数で渡される。これを使って絞り込み処理する）
    // 年齢が20より大きいものだけに絞る
    static::addGlobalScope('age', function (Builder $builder) {
      $builder->where('age', '>', 20);
    });
  }

}
