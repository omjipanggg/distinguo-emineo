<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TokeniserFactory extends Factory
{
    public function definition(): array
    {
        $token = Str::upper(substr(fake()->uuid(), -12));
        $is_used = [0, 1];
        $used_at = ['2023-11-05 12:52:42', null, '2023-11-14 10:07:01', '2023-11-10 18:02:15', null];
        $columns = [
            [
                'is_used' => 0,
                'used_at' => null
            ],
            [
                'is_used' => 1,
                'used_at' => fake()->date()
            ]
        ];
        $regions = ['Jabodetabek', 'Jawa Barat', 'Sumatera Selatan', 'Bali dan Nusa Tenggara', 'Kalimantan'];
        $zones = ['East', 'Central', 'Cimahi', 'Bandung Barat', 'Kalimantan'];
        return [
            'token' => $token,
            'region' => fake()->randomElement($regions),
            'zone' => fake()->randomElement($zones),
            'is_used' => fake()->randomElement($is_used),
            'used_at' => fake()->randomElement($used_at)
        ];
    }
}
