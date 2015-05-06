<?php namespace App\Http\Controllers;
    
// use Illuminate\Http\Request;


class MyController extends Controller
{
  public function index($name = '"My Default User Name"')
  {
    // return view('hi', ['name' => $name]);

    return view('hi');

  }
}

