<?php
// ════════════════════════════════════════════════════════════════════════════
//  database/factories/PropertyFactory.php
// ════════════════════════════════════════════════════════════════════════════
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    public function definition(): array
    {
        $types = ['house', 'apartment', 'land', 'office'];
        $cities = ['Casablanca', 'Marrakech', 'Rabat', 'Tanger', 'Fès', 'Agadir', 'Meknès'];
        $statuses = ['available', 'sold', 'rented', 'under_construction'];

        $type = fake()->randomElement($types);

        return [
            'title'       => fake('fr_FR')->sentence(4, true),
            'slug'        => null, // généré automatiquement par le model
            'description' => fake('fr_FR')->paragraphs(3, true),
            'price'       => fake()->numberBetween(200_000, 5_000_000),
            'area'        => fake()->numberBetween(50, 500),
            'type'        => $type,
            'rooms'       => $type !== 'land' ? fake()->numberBetween(1, 10) : null,
            'bedrooms'    => $type !== 'land' ? fake()->numberBetween(1, 5)  : null,
            'bathrooms'   => $type !== 'land' ? fake()->numberBetween(1, 3)  : null,
            'address'     => fake('fr_FR')->streetAddress(),
            'city'        => fake()->randomElement($cities),
            'postal_code' => fake()->numerify('#####'),
            'year_built'  => fake()->numberBetween(1970, 2023),
            'status'      => fake()->randomElement($statuses),
            'is_featured' => fake()->boolean(20), // 20% de chance d'être en vedette
            'views_count' => fake()->numberBetween(0, 500),
            'video_url'   => null,
        ];
    }
}
