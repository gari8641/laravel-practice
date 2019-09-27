<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
//use Illuminate\Foundation\Testing\WithFaker;
//use Illuminate\Foundation\Testing\RefreshDatabase;
//
// 指定アドレスにアクセスする p331
use App\User;

class HelloTest extends TestCase
{
  use DatabaseMigrations;
    /**
     * A basic test example.
     *
     * @return void
     */
  // testに続く関数名はなんでもよい。testで始まってさえいれば。
    public function testHello()
    {
      $this->assertTrue(true);

      // ↓get以外にもpost,put,patch,deleteといったメソッドも用意されている。
      // 使い方はいずれも同じ。
      $response = $this->get('/');
      //$response->assertStatus(200);
      // tasks/のやつを同梱してたせいでリダイレクトが走るから入門書と違うけど302に変更
      $response->assertStatus(302);

      $response = $this->get('/hello');
      $response->assertStatus(302);

      // ユーザー認証用。p333
      // モデルの作成は、factoryを使う。
      //  引数にモデルのクラスを指定して実行し、createメソッドを呼び出す。
      //   これで指定のモデルが作成される。
      //   * モデル...tableの内容を定義したクラスのこと
      //   このモデルの作成は、先にModelFactory.phpで用意しておいた$factory->defineのクロージャによって
      //   得られた値をもとにインスタンス生成が行われている。p333* モデル...tableの内容を定義したクラスのこと
      $user = factory(User::class)->create();
      // $this->actingAs->get と呼び出すことで指定のユーザでログインできる
      // ユーザはDBに登録されていてもいなくてもログインできる
      $response = $this->actingAs($user)->get('/hello');
      $response->assertStatus(200);

      $response = $this->get('/no_route');
      $response->assertStatus(404);
    }
}
