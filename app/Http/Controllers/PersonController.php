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
    // where (フィールド, 値)
    $item = Person::where('name', $request->input)->first();
    // 全レコードを得たい場合は、where (フィールド, 値)->get
    //
    $param = ['input' => $request->input, 'item' => $item];
    return view('person.find', $param);
  }
    //
}
