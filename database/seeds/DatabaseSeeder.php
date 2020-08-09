<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Product::class, rand(1, 10))->create()->each(function($product){
            $product->variants()->saveMany(factory(App\Variant::class, rand(1, 6))->make());
          });
    }
}
