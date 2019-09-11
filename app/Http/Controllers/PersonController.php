<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
  public function index(Request $request)
  {
    $items = Person::all();
    return view('person.index', ['items' => $items]);
  }

  public function find(Request $request)
  {
    return view('person.find', ['input' => '']);
  }

  public function search(Request $request)
  {
    // テキストボックスに指定した数字〜数字+10の範囲でwhereする
    $min = $request->input * 1;
    $max = $min + 10;
    $item = Person::ageGreaterThan($min)->
      ageLessThan($max)->first();
    $param = ['input' => $request->input, 'item' => $item];
    return view('person.find', $param);
  }

  // Eloquent モデルの作成p248
  public function add(Request $request)
  {
    return view('person.add');
  }

  // Eloquent モデルの作成 p249
  public function create(Request $request)
  {
    $this->validate($request, Person::$rules);
    $person = new Person;
    $form = $request->all();

    // _token は、CSRF用非表示フィールドとして用意される項目。テーブルにない項目なので予め削除しておく。 p250
    unset($form['_token']);

    // save()の、'()'をつけ忘れてた…
    // fillメソッドは、引数に用意されている配列の値をモデルのプロパティに代入するもの。個々のプロパティをまとめて設定できる。
    // 1つ1つの値をインスタンスに設定する場合は、以下。fillでやってることと同じ。
    // $person = new Person;
    // $person->name = $request->name;
    // $person->mail = $request->mail;
    // $person->age = $request->age;
    // $person->save();
    //
    $person->fill($form)->save();
    return redirect('/person');
  }
}
