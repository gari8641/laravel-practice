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
    // 自分でapp/Person.php に定義したモデルクラスのローカルスコープを利用する。
    // メソッド名は'scopeNameEqual'と定義しているが、最初の'scope'は不要で、
    // 'nameEaual'と指定する
    $item = Person::nameEqual($request->input)->first();
    $param = ['input' => $request->input, 'item' => $item];
    return view('person.find', $param);
  }
    //
}
