<?php

namespace App\Http\Controllers;

use App\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
  // hasとdoesntHaveで従テーブルにレコードがあるのと無いのに分ける
  public function index(Request $request)
  {
    $hasItems = Person::has('boards')->get();
    $noItems = Person::doesntHave('boards')->get();
    $param = ['hasItems' => $hasItems, 'noItems' => $noItems];
    return view('person.index', $param);
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



  // Eloquent モデルの更新 p252
  public function edit(Request $request)
  {
    $person = Person::find($request->id);
    return view('person.edit', ['form' => $person]);
  }

  public function update(Request $request)
  {
    $this->validate($request, Person::$rules);
    $person = Person::find($request->id);
    $form = $request->all();
    unset($form['_token']);
    $person->fill($form)->save();
    return redirect('/person');
  }


  // Eloquent モデルの削除 p255
  public function delete(Request $request)
  {
    $person = Person::find($request->id);
    return view('person.del', ['form' => $person]);
  }

  public function remove(Request $request)
  {
    Person::find($request->id)->delete();
    return redirect('/person');
  }
}
