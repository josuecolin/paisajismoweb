<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Categoria;
 
class CategoriasSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            [
                'nombre'      => 'Jardines Tropicales',
                'descripcion' => 'Diseños exuberantes con plantas tropicales, helechos y palmeras.',
                'icono'       => '🌴',
                'color'       => '#2D7D46',
            ],
            [
                'nombre'      => 'Jardines Zen',
                'descripcion' => 'Espacios de meditación con piedras, grava y bambú.',
                'icono'       => '🪨',
                'color'       => '#6B7A8D',
            ],
            [
                'nombre'      => 'Jardines de Suculentas',
                'descripcion' => 'Composiciones con cactus, agaves y suculentas de bajo mantenimiento.',
                'icono'       => '🌵',
                'color'       => '#8FAF52',
            ],
            [
                'nombre'      => 'Huertos y Jardines Comestibles',
                'descripcion' => 'Diseños funcionales con hierbas, verduras y frutales.',
                'icono'       => '🥬',
                'color'       => '#3D8B37',
            ],
            [
                'nombre'      => 'Terrazas y Balcones',
                'descripcion' => 'Transformación de espacios urbanos reducidos.',
                'icono'       => '🏙️',
                'color'       => '#7A6B52',
            ],
            [
                'nombre'      => 'Jardines Acuáticos',
                'descripcion' => 'Estanques, fuentes, cascadas y plantas acuáticas.',
                'icono'       => '💧',
                'color'       => '#3A7BD5',
            ],
            [
                'nombre'      => 'Jardines Nativos',
                'descripcion' => 'Uso de flora local y plantas endémicas de la región.',
                'icono'       => '🌿',
                'color'       => '#4A7C2F',
            ],
            [
                'nombre'      => 'Jardines Modernos',
                'descripcion' => 'Líneas limpias, geometría y materiales contemporáneos.',
                'icono'       => '◼️',
                'color'       => '#2C2C2C',
            ],
            [
                'nombre'      => 'Jardines de Roca',
                'descripcion' => 'Rocallas, alpinas y composiciones con piedra natural.',
                'icono'       => '⛰️',
                'color'       => '#8B6914',
            ],
            [
                'nombre'      => 'Jardines Verticales',
                'descripcion' => 'Muros verdes, enredaderas y vegetación en altura.',
                'icono'       => '🧱',
                'color'       => '#5E8B3F',
            ],
            [
                'nombre'      => 'Jardines de Flores',
                'descripcion' => 'Diseños centrados en color y floración estacional.',
                'icono'       => '🌸',
                'color'       => '#D05A8A',
            ],
            [
                'nombre'      => 'Espacios de Exterior',
                'descripcion' => 'Pérgolas, quinchos, fogones y áreas de entretenimiento.',
                'icono'       => '🪵',
                'color'       => '#9B6B3A',
            ],
        ];
 
        foreach ($categorias as $cat) {
            Categoria::firstOrCreate(
                ['slug' => Str::slug($cat['nombre'])],
                array_merge($cat, ['slug' => Str::slug($cat['nombre'])])
            );
        }
    }
}
