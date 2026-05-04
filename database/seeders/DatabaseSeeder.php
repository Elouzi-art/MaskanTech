<?php
// ════════════════════════════════════════════════════════════════════════════
//  database/seeders/DatabaseSeeder.php
// ════════════════════════════════════════════════════════════════════════════
namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Message;
use App\Models\Property;
use App\Models\PropertyFeature;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ── Features ────────────────────────────────────────────────────
        $featureNames = ['Piscine', 'Garage', 'Jardin', 'Climatisation', 'Chauffage central', 'Meublé', 'Ascenseur', 'Interphone', 'Terrasse', 'Cave'];
        $features = collect($featureNames)->map(fn($name) => PropertyFeature::create(['name' => $name]));

        // ── Admin ────────────────────────────────────────────────────────
        $admin = User::create([
            'name'              => 'Admin MaskanTech',
            'email'             => 'admin@maskantech.ma',
            'password'          => Hash::make('password'),
            'role'              => 'admin',
            'email_verified_at' => now(),
        ]);

        // ── Agents ───────────────────────────────────────────────────────
        $agents = User::factory(3)->create([
            'role'              => 'agent',
            'email_verified_at' => now(),
        ]);

        // ── Clients ──────────────────────────────────────────────────────
        $clients = User::factory(10)->create([
            'role'              => 'client',
            'email_verified_at' => now(),
        ]);

        // ── Properties ───────────────────────────────────────────────────
        $agents->each(function (User $agent) use ($features) {
            Property::factory(5)->create(['user_id' => $agent->id])
                ->each(function (Property $property) use ($features) {
                    // Attribuer 2-4 features aléatoires
                    $property->features()->attach($features->random(rand(2, 4))->pluck('id'));
                });
        });

        // ── Favoris ───────────────────────────────────────────────────────
        $properties = Property::all();
        $clients->each(function (User $client) use ($properties) {
            $client->favorites()->attach($properties->random(rand(1, 4))->pluck('id'));
        });

        // ── Rendez-vous ───────────────────────────────────────────────────
        $properties->random(8)->each(function (Property $property) use ($clients) {
            Appointment::create([
                'property_id' => $property->id,
                'client_id'   => $clients->random()->id,
                'agent_id'    => $property->user_id,
                'date'        => now()->addDays(rand(1, 30)),
                'time'        => '10:00',
                'status'      => collect(['pending', 'confirmed', 'refused'])->random(),
            ]);
        });

        // ── Messages ──────────────────────────────────────────────────────
        $clients->each(function (User $client) use ($agents) {
            $agent = $agents->random();
            Message::create([
                'sender_id'   => $client->id,
                'receiver_id' => $agent->id,
                'message'     => 'Bonjour, je souhaite avoir plus d\'informations sur ce bien.',
            ]);
        });
    }
}
