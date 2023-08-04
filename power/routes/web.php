<?php

use Illuminate\Support\Facades\Route;

Route::get('/test',function (){
    $a = \App\Models\User::find(1)->permissions;
    dd($a);
});
