<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        //前の流れで /hello/にアクセスするとログインしてないためリダイレクトされ、200でOKとしているとエラーになるので変更 p330
        //https://qiita.com/t_n/items/e2ab27684c6c323e0148
        //$response->assertStatus(200);
        $response->assertStatus(302);
    }
}
