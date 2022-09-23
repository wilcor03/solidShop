<?php

namespace Database\Factories;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {      
        return [
          'customer_email'  => $this->faker->unique()->safeEmail(), 
          'customer_name'   => $this->faker->name(),
          'customer_mobile' => $this->faker->phoneNumber,
          'status'          => $this->faker->randomElement(['CREATED', 'PAYED', 'REJECTED']),
          'payment_response' => [
            'placetopay' => [
              'requestId'   => "62350",
              'respondeUrl' => "https://checkout-co.placetopay.dev/session/62350/b22f009287108085d5fd3142f24b8792"
            ]
          ],
          'order_details' => [
            'id'    => 2,
            'price' => 23,
            'title' => $this->faker->words(rand(1, 3), true),
            'quantity' => 2,
            'description' => $this->faker->text()
          ],
          'reference' => Str::random(10)
        ];
    }
}
  