<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Maker;
use Faker\Factory as Faker;
// use Faker\Provider\PhoneNumber as Faker;

class MakerSeed  extends Seeder {

//  $faker = new Faker\Generator();
  

  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $faker = Faker::create();


    for($i=0; $i <20; $i++)
    {


    Maker::create
      ([

      'name'=> $faker->name($gender = null|'male'|'female'),
      'phone'=>$faker->phoneNumber()

      ]);
    }

  }

}
