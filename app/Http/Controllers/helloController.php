<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\HelloRequest;
use Validator;

use Illuminate\Support\Facades\DB;

// ペジネーション p304
use App\Person;


class HelloController extends Controller
{
  public function index(Request $request)
  {
    $sort = $request->sort;

    if (!$sort){
      $sort = 'id';
    }
    // 並び替えはorderByをメソッドチェーンの途中に記述する
    // simplePaginateは必ず最後に呼び出すようにする。じゃないとエラーになる
    // DBクラスでやる場合
    //$items = DB::table('people')->orderBy($sort, 'asc')->simplePaginate(5);
    $items = Person::orderBy($sort, 'asc')->simplePaginate(5);

    $param = ['items' => $items, 'sort' => $sort];
    return view('hello.index', $param);
  }


  public function post(Request $request)
  {
    $items = DB::select('select * from people');
    return view('hello.index', ['items' => $items]);
  }

  public function add(Request $request)
  {
    return view('hello.add');
  }

  public function create(Request $request)
  {
    $param =[
      'name' => $request->name,
      'mail' => $request->mail,
      'age' => $request->age,
    ];

    // 
    DB::table('people')->insert($param);

    // 最後に、/helloにリダイレクトする
    return redirect('/hello');
  }

  public function edit(Request $request) {
    // http://localhost:8080/hello/edit?id=3 みたいに、レコード指定してアクセスする
    // フォームにselectされたデータが読み込まれる
    $item = DB::table('people')
      ->where('id', $request->id)->first();
    return view('hello.edit', ['form' => $item]);
  }

  public function update(Request $request)
  {
    $param = [
      'name' => $request->name,
      'mail' => $request->mail,
      'age' => $request->age,
    ];

    // フォームで指定された値に更新される
    DB::table('people')
      ->where('id', $request->id)
      ->update($param);
    return redirect('/hello');
  }

  public function del(Request $request)
  {
    $item = DB::table('people')
      ->where('id', $request->id)->first();
    return view('hello.del', ['form' => $item]);
  }

  public function remove(Request $request)
  {
    // /hello/del?id=5 のようにアクセスする
    // delete() 引数はいらない。
    DB::table('people')
      ->where('id', $request->id)->delete();
    return redirect('/hello');
  }

  public function show(Request $request)
  {
    // http://localhost:8080/hello/show?page=0 とかでアクセスする
    // 0ってのはページ数。
    // offsetで10指定すると11からレコード取得する
    // offsetで指定された数値の次の数値からlimitで指定した数だけ取得する
    // 以下は、3つずつレコード表示する。
    // page=1とすると4〜6番目のレコードが表示される
    $page = $request->page;
    $items = DB::table('people')
      ->offset($page * 3)
      ->limit(3)
      ->get();
    return view('hello.show', ['items' => $items]);
  }

  // Rest. helloのページからRestにアクセスする p293
  public function rest(Request $request)
  {
    return view('hello.rest');
  }

  // Session. p298
  public function ses_get(Request $request)
  {
    $sesdata = $request->session()->get('msg');
    return view('hello.session', ['session_data' => $sesdata]);
  }

  public function ses_put(Request $request)
  {
    $msg = $request->input;
    $request->session()->put('msg', $msg);
    return redirect('hello/session');
  }
}
