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
// データベースをテストする p334
use App\Person;

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
      // ダミーで利用するデータ
      factory(User::class)->create([
        'name' => 'AAA',
        'email' => 'BBB@CCC.COM',
        'password' => 'ABCABC',
      ]);
      factory(User::class, 10)->create();

      $this->assertDatabaseHas('users', [
        'name' => 'AAA',
        'email' => 'BBB@CCC.COM',
        'password' => 'ABCABC',
      ]);

      // ダミーで利用するデータ
      factory(Person::class)->create([
        'name' => 'XXX',
        'mail' => 'YYY@ZZZ.com',
        'age' => 123,
      ]);
      factory(Person::class, 10)->create();

      $this->assertDatabaseHas('people', [
        'name' => 'XXX',
        'mail' => 'YYY@ZZZ.COM',
        'age' => 123,
      ]);
    }
}
