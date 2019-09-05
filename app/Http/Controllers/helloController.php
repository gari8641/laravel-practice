<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\HelloRequest;
use Validator;

use Illuminate\Support\Facades\DB;


class HelloController extends Controller
{
  public function index(Request $request)
  {
    // /hello/ でアクセスする
    // orderBy(フィールド名, 'ascまたはdesc')
    $items = DB::table('people')->orderBy('age', 'asc')->get();
    return view('hello.index', ['items' => $items]);
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


    // :nameとかは、プレースホルダ（SQL文）。$paramの値がつっこまれる
    DB::insert('insert into people (name, mail, age) values (:name, :mail, :age)', $param);

    // 最後に、/helloにリダイレクトする
    return redirect('/hello');
  }

  public function edit(Request $request) {
    $param = ['id' => $request->id];
    $item = DB::select('select * from people where id = :id', $param);
    return view('hello.edit', ['form' => $item[0]]);
  }

  public function update(Request $request)
  {
    $param = [
      'id' => $request->id,
      'name' => $request->name,
      'mail' => $request->mail,
      'age' => $request->age,
    ];
    DB::update('update people set name =:name, mail =:mail, age =:age where id =:id', $param);
    return redirect('/hello');
  }

  public function del(Request $request)
  {
    $param = ['id' => $request->id];
    $item = DB::select('select * from people where id = :id', $param);
    return view('hello.del', ['form' => $item[0]]);
  }

  public function remove(Request $request)
  {
    $param = ['id' => $request->id];
    DB::delete('delete from people where id = :id', $param);
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
}
