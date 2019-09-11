<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


// グローバルスコープのために追加
use Illuminate\Database\Eloquent\Builder;


// ScopePersonクラスを利用する p245
use App\Scopes\ScopePerson;

class Person extends Model
{
  // has One 主テーブルであるpeapleと従テーブルであるboardsの関連付け p268
  public function board()
  {
    return $this->hasOne('App\Board');
  }


  //モデルの新規作成ここから

  // $guardedは「値を用意しておかない項目」。idみたいに自動で値が割り振られるものに設定する
  protected $guarded = array('id');

  public static $rules = array (
    'name' => 'required',
    'mail' => 'email',
    'age' => 'integer|min:0|max:150'
  );
  //モデルの新規作成ここまで
  //
  //
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

    // ScopePersonクラスを利用する p245
    static::addGlobalScope(new ScopePerson);
  }

}
