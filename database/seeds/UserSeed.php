<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use App\Maker;
use App\User;

class UserSeed extends Seeder {

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    User::create
    (
      [
      'email' => 'jklog@att.net',
      'password' => Hash::make('moovix2145')
      ]

      );
  }

}
