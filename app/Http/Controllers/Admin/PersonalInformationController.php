<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersonalInformationController extends Controller
{
    public function index($something){
        dd($something);
        $request->file('photo')->store('photo');

        PersonalInformationController::index($request);


    }
}
