<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AutaDemoSeeder extends Seeder
{
    public function run()
    {
        // Vložení značek
        $znacky = ['Toyota', 'Škoda', 'Volkswagen', 'Ford', 'BMW', 'Audi', 'Peugeot', 'Renault', 'Kia', 'Hyundai'];
        foreach ($znacky as $znacka) {
            $this->db->table('znacka_auta')->insert(['znacka' => $znacka]);
        }

        // Vložení typů
        $typy = ['Hatchback', 'Sedan', 'Combi', 'SUV', 'MPV', 'Crossover', 'Pick-up', 'Cabrio'];
        foreach ($typy as $typ) {
            $this->db->table('typ_auta')->insert(['typ' => $typ]);
        }

        // Vložení modelů a relací (včetně obrázku, popisu, datumu)
        $paliva = ['benzín', 'nafta', 'elektro'];
        $popis = str_repeat('Toto je dlouhý popis auta. ', 100); // >1000 znaků
        $now = date('Y-m-d H:i:s');
        for ($i = 1; $i <= 1000; $i++) {
            $znackaId = rand(1, count($znacky));
            $model = 'Model_' . $i;
            $palivo = $paliva[array_rand($paliva)];
            $obrazek = null; // nebo např. 'assets/no-car-image.svg'
            $this->db->table('model_auta')->insert([
                'znacka_auta_id' => $znackaId,
                'model' => $model,
                'palivo' => $palivo,
                'obrazek' => $obrazek,
                'popis' => $popis,
                'created_at' => $now,
                'updated_at' => $now,
                'deleted_at' => null
            ]);
            $modelId = $this->db->insertID();
            // Každý model má 1-2 typy
            $typyIds = array_rand($typy, rand(1,2));
            if (!is_array($typyIds)) $typyIds = [$typyIds];
            foreach ($typyIds as $typId) {
                $this->db->table('typ_auta_has_model_auta')->insert([
                    'typ_auta_id' => $typId+1,
                    'model_auta_id' => $modelId
                ]);
            }
        }
    }
}
