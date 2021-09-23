<?php

namespace Database\Factories;

use App\Models\Url;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UrlFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Url::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      return [
          'link' => $this->faker->url(),
          'description' => $this->faker->text(),
          'status_code' => '404',
          'response_http' =>  [
		          'key_1' => $this->faker->randomNumber(),
		          'key_2' => $this->faker->sentence,
	        ],
          'user_id' => function() {
            return factory(User::class)->create()->id;
          },
      ];
    }
}
