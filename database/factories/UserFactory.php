<?php

use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

// $factory->define ... モデルを生成する処理を設定するもの。 p328
// $factory->define(モデルクラス, function(Faker\Generator $faker){
// ....処理を用意する ....
// return [ データ配列 ];
// });
//
// 以下はUserモデルクラスを生成する処理。
// Authによる認証で利用していたモデル。
// Authを利用するテストでは必ずUserモデルが必要となるため、最初から用意されたみたい。
$factory->define(App\User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => Str::random(10),
    ];
});

$factory->define(App\Person::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'mail' => $faker->safeEmail,
        'age' => ramdom_int(1,99),
    ];
});
