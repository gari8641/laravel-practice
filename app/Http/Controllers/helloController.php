<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class helloController extends Controller
{
  public function index(Request $request) {
    $data = [
      'msg' => 'これはコントローラから渡されたMSG。変数渡すときは連想配列でやる必要があるっぽい',
      'id' => $request->id
    ];
    return view('hello.index', $data);
  }
}
