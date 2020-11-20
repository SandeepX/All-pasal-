<?php
namespace Database\Factories;


use App\Models\CEO;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class CeoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\CEO::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        
		return [
		    'name' => $this->faker->company(10),
		    'Activities' =>$this->faker->sentence(10),
		    'year' =>$this->faker->date($format = 'Y-m-d', $max = 'now'),
		    'headquarter' =>$this->faker->city()

		];
        
    }
}
