<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Dish;
use DB;
class DishTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dishes = [
                   ['id' => '1','dish_name'=> 'Veg Biryani','available'=>'5','price'=>'70'],
                   ['id' => '2','dish_name'=>'Chicken Biryani','available'=>'15','price'=>'100'],
                   ['id' => '3','dish_name'=>'Meal','available'=>'5','price'=>'100'],
                   ['id' => '4','dish_name'=>'Special Meal','available'=>'15','price'=>'100'],
                   ['id' => '5','dish_name'=>'Tea','available'=>'100','price'=>'10'],
                ];
            
        foreach ($dishes as $dish) {
            $dish_set = Dish::updateOrCreate(['id' => $dish['id']], $dish);
        }
    }
}
