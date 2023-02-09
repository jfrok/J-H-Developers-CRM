<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class customerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $customers = [];
   $faker = Faker::create();
        foreach (range(1,30) as $index){
            $customer = [
            'fullname' => $faker->name(),
            'email' => $faker->email(),
            'description' => $faker->text(),
            'address' => $faker->address(),
            'address_sec' => $faker->streetAddress(),
            'city' => $faker->city(),
            'zip' => $faker->postcode(),
            'created_at' => now(),
            'updated_at' => now(),

            ];
            $customers[] = $customer;
        }
        DB::table('customers')->delete();
        DB::table('customers')->insert($customers);
    }
}
