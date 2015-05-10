<?php namespace App\Http\Controllers;
    
// use Illuminate\Http\Request;


class MyController extends Controller{

//  public function __construct() {

//   $this->beforeFilter(function()
// {
//     Event::fire('clockwork.controller.start');
// });

// $this->afterFilter(function()
// {
//     Event::fire('clockwork.controller.end');
// });

//  }



  public function index($name = '"My Default User Name"')
  {
    // return view('hi', ['name' => $name]);

    return view('hi');

  }
}

