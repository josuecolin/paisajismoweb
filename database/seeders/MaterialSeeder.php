<?php

namespace Database\Seeders;

use App\Models\Material;
use Illuminate\Database\Seeder;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        // Precios de ejemplo en MXN: ajústalos a tus proveedores reales.
        $materials = [
            ['Pasto en rollo San Agustín', 'pasto',        'm2',  85],
            ['Tierra negra preparada',      'sustrato',    'm3',  650],
            ['Grava decorativa blanca',     'piedra',      'm3',  1200],
            ['Piedra de río',               'piedra',      'm3',  1500],
            ['Lavanda (planta)',            'plantas',     'pza', 75],
            ['Agave azul (planta)',         'plantas',     'pza', 180],
            ['Árbol de jacaranda 2m',       'plantas',     'pza', 950],
            ['Manguera de riego 1/2"',      'riego',       'ml',  18],
            ['Aspersor emergente',          'riego',       'pza', 140],
            ['Luminaria solar de piso',     'iluminacion', 'pza', 220],
            ['Adoquín de concreto',         'piedra',      'm2',  320],
            ['Pérgola de madera tratada',   'estructuras', 'pza', 12500],
            ['Banca de jardín',             'mobiliario',  'pza', 2800],
        ];

        foreach ($materials as [$name, $category, $unit, $price]) {
            Material::firstOrCreate(
                ['name' => $name],
                ['category' => $category, 'unit' => $unit, 'unit_price' => $price]
            );
        }
    }
}
