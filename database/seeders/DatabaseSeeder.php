<?php
// database/seeders/DatabaseSeeder.php
namespace Database\Seeders;

use App\Models\Property;
use App\Models\PropertyFeature;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Équipements ─────────────────────────────────────────────────
        $features = collect(['WiFi', 'Parking', 'Meublé', 'Climatisation',
            'Chauffage', 'Balcon', 'Piscine', 'Jardin', 'Ascenseur', 'Interphone'])
            ->map(fn($name) => PropertyFeature::firstOrCreate(['name' => $name]));

        // ── Utilisateurs de démo ────────────────────────────────────────
        $admin = User::firstOrCreate(['email' => 'admin@maskantech.ma'], [
            'name'     => 'Admin',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        $agent1 = User::firstOrCreate(['email' => 'karim@maskantech.ma'], [
            'name'     => 'Karim Benjelloun',
            'password' => Hash::make('password'),
            'role'     => 'agent',
            'phone'    => '0661234567',
        ]);

        $agent2 = User::firstOrCreate(['email' => 'leila@maskantech.ma'], [
            'name'     => 'Leila Mansouri',
            'password' => Hash::make('password'),
            'role'     => 'agent',
            'phone'    => '0669876543',
        ]);

        User::firstOrCreate(['email' => 'client@maskantech.ma'], [
            'name'     => 'Mohamed Alami',
            'password' => Hash::make('password'),
            'role'     => 'client',
        ]);

        User::firstOrCreate(['email' => 'etudiant@maskantech.ma'], [
            'name'     => 'Sara Idrissi',
            'password' => Hash::make('password'),
            'role'     => 'student',
        ]);

        User::firstOrCreate(['email' => 'proprio@maskantech.ma'], [
            'name'     => 'Hassan Berrada',
            'password' => Hash::make('password'),
            'role'     => 'owner',
        ]);

        // ── Propriétés de démo ─────────────────────────────────────────
        $properties = [
            [
                'user_id'         => $agent1->id,
                'title'           => 'Studio meublé proche université',
                'description'     => 'Studio entièrement meublé, idéal pour étudiant. Proche de l\'université et des commerces. Wifi inclus.',
                'price'           => 1800,
                'area'            => 28,
                'type'            => 'apartment',
                'rooms'           => 1,
                'bedrooms'        => 1,
                'bathrooms'       => 1,
                'address'         => '12 Rue Ibn Sina',
                'city'            => 'Marrakech',
                'postal_code'     => '40000',
                'status'          => 'available',
                'target_audience' => 'student',
                'is_featured'     => true,
                'features'        => ['WiFi', 'Meublé'],
            ],
            [
                'user_id'         => $agent1->id,
                'title'           => 'Appartement 2 chambres Guéliz',
                'description'     => 'Bel appartement lumineux en plein cœur de Guéliz, avec parking et sécurité 24h/24.',
                'price'           => 4500,
                'area'            => 75,
                'type'            => 'apartment',
                'rooms'           => 3,
                'bedrooms'        => 2,
                'bathrooms'       => 1,
                'address'         => '45 Avenue Mohammed V',
                'city'            => 'Marrakech',
                'postal_code'     => '40000',
                'status'          => 'available',
                'target_audience' => 'all',
                'is_featured'     => true,
                'features'        => ['Parking', 'Climatisation', 'Interphone'],
            ],
            [
                'user_id'         => $agent2->id,
                'title'           => 'Villa avec piscine — Palmeraie',
                'description'     => 'Magnifique villa 5 chambres avec piscine privée et jardin paysager dans la Palmeraie.',
                'price'           => 18000,
                'area'            => 320,
                'type'            => 'house',
                'rooms'           => 8,
                'bedrooms'        => 5,
                'bathrooms'       => 3,
                'address'         => 'Circuit de la Palmeraie',
                'city'            => 'Marrakech',
                'postal_code'     => '40000',
                'status'          => 'available',
                'target_audience' => 'professional',
                'is_featured'     => true,
                'features'        => ['Piscine', 'Jardin', 'Parking', 'Climatisation'],
            ],
            [
                'user_id'         => $agent2->id,
                'title'           => 'Chambre en colocation étudiante',
                'description'     => 'Chambre dans appartement partagé, 3 autres colocataires étudiants. Cuisine et salon communs.',
                'price'           => 1200,
                'area'            => 15,
                'type'            => 'apartment',
                'rooms'           => 1,
                'bedrooms'        => 1,
                'bathrooms'       => 1,
                'address'         => '8 Rue Yougoslavie',
                'city'            => 'Casablanca',
                'postal_code'     => '20000',
                'status'          => 'available',
                'target_audience' => 'student',
                'is_featured'     => false,
                'features'        => ['WiFi', 'Meublé'],
            ],
            [
                'user_id'         => $agent1->id,
                'title'           => 'Appartement F3 Hay Riad',
                'description'     => 'Appartement spacieux dans une résidence sécurisée. Idéal pour famille ou professionnel.',
                'price'           => 5500,
                'area'            => 90,
                'type'            => 'apartment',
                'rooms'           => 4,
                'bedrooms'        => 3,
                'bathrooms'       => 2,
                'address'         => 'Résidence Al Fath, Hay Riad',
                'city'            => 'Rabat',
                'postal_code'     => '10000',
                'status'          => 'rented',
                'target_audience' => 'all',
                'is_featured'     => false,
                'features'        => ['Ascenseur', 'Interphone', 'Parking'],
            ],
        ];

        foreach ($properties as $data) {
            $featureNames = $data['features'] ?? [];
            unset($data['features']);

            $slug = \Illuminate\Support\Str::slug($data['title']);
            $count = Property::where('slug', 'like', "$slug%")->count();
            $data['slug'] = $count ? "$slug-$count" : $slug;
            $data['views_count'] = rand(5, 120);

            $property = Property::firstOrCreate(['slug' => $data['slug']], $data);

            $featureIds = PropertyFeature::whereIn('name', $featureNames)->pluck('id');
            $property->features()->sync($featureIds);
        }

        $this->command->info('✅ Données de démo créées !');
        $this->command->info('   admin@maskantech.ma / password');
        $this->command->info('   karim@maskantech.ma / password  (agent)');
        $this->command->info('   client@maskantech.ma / password');
        $this->command->info('   etudiant@maskantech.ma / password');
        $this->command->info('   proprio@maskantech.ma / password');
    }
}
