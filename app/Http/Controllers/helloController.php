<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\HelloRequest;
use Validator;


class helloController extends Controller
{
  public function index(Request $request)
  {
    $validator = Validator::make($request->query(), [
      'id' => 'required',
      'pass' => 'required',
    ]);

    if ($validator->fails()){
      $msg = 'クエリーに問題があります。';
    } else {
      $msg = 'ID/PASSを受付ました。フォームを入力してください。';
    }
    return view('hello.index', ['msg'=>$msg, ]);
  }


  public function post(Request $request)
  {

    $rules = [
      'name' => 'required',
      'mail' => 'email',
      'age' => 'numeric'
    ];

    $messages = [
      'name.required' => '名前は必ず入力してください',
      'mail.email' => 'メールアドレスは必須です',
      'age.numeric' => '年齢を整数で記入ください',
      'age.min' => '年齢はゼロ歳以上で記入ください',
      'age.max' => '年齢は200歳以下で記入ください',
    ];

    $validator = Validator::make($request->all(), $rules, $messages);

    $validator->sometimes('age', 'min:0', function ($input) {
      return !is_int($input->age);
    });

    $validator->sometimes('age', 'max:200', function($input){
      return !is_int($input->age);
    });

    if ($validator->fails()){
      return redirect('/hello')
        ->withErrors($validator)
        ->withInput();
    }

    return view('hello.index', ['msg'=>'正しく入力されました！']);

  }
}
