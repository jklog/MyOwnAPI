<?php namespace App\Http\Controllers;


class MyController extends Controller
{
  public function index($name = '"My Default User Name"')
  {
    return view('hi', ['name' => $name]);
  }
}


