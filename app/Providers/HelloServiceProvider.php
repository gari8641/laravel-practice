<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

//use Illuminate\Validation\Validator;
use App\Http\Validators\HelloValidator;
use Illuminate\Support\Facades\Validator;

class HelloServiceProvider extends ServiceProvider
{
    public function boot()
    {
        //
      Validator::extend('hello', function($attribute, $value, $parameters, $validator){
        return $value % 2 == 0;
      });
    }
}
