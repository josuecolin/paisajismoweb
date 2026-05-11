<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\TiendaRecomendada;
use App\Models\TiendaTag;
use Illuminate\Database\Seeder;

class TiendasRecomendadasSeeder extends Seeder
{
    /**
     * Datos: cada entrada puede tener múltiples 'categorias' (slugs).
     * Así una tienda como "Semillero Orgánico" puede aparecer en huertos Y jardines de flores.
     */
    private array $tiendas = [
        // ── Jardines Tropicales ──────────────────────────────────────────────
        [
            'nombre'      => 'Viveros El Trópico',
            'tipo'        => 'Vivero especializado',
            'descripcion' => 'Amplia selección de plantas tropicales, heliconias, plátanos ornamentales y palmeras exóticas.',
            'icono'       => '🌺',
            'color'       => '#3D8B37',
            'sitio_web'   => 'https://www.google.com/search?q=viveros+plantas+tropicales',
            'tags'        => ['Palmeras', 'Heliconias', 'Bromelias'],
            'categorias'  => ['jardines-tropicales'],
        ],
        [
            'nombre'      => 'Jardinería Trópico Verde',
            'tipo'        => 'Tienda de jardinería',
            'descripcion' => 'Sustratos, macetas decorativas y fertilizantes especiales para plantas de climas cálidos.',
            'icono'       => '🪴',
            'color'       => '#2D7D46',
            'sitio_web'   => 'https://www.google.com/search?q=tienda+jardineria+tropical',
            'tags'        => ['Sustratos', 'Macetas', 'Fertilizantes'],
            'categorias'  => ['jardines-tropicales'],
        ],

        // ── Jardines Zen ─────────────────────────────────────────────────────
        [
            'nombre'      => 'Piedras & Armonía',
            'tipo'        => 'Materiales decorativos',
            'descripcion' => 'Grava decorativa, piedras de río, bambú y elementos para jardines de meditación y diseño zen.',
            'icono'       => '🪨',
            'color'       => '#6B7A8D',
            'sitio_web'   => 'https://www.google.com/search?q=materiales+jardin+zen+piedras+grava',
            'tags'        => ['Grava', 'Bambú', 'Rocas decorativas'],
            'categorias'  => ['jardines-zen', 'jardines-de-roca'],
        ],
        [
            'nombre'      => 'Bambú & Feng Shui',
            'tipo'        => 'Tienda especializada',
            'descripcion' => 'Plantas de bambú, faroles de jardín, fuentes de agua y accesorios para espacios zen.',
            'icono'       => '🎋',
            'color'       => '#4A7C59',
            'sitio_web'   => 'https://www.google.com/search?q=tienda+bambu+jardin+zen',
            'tags'        => ['Bambú', 'Fuentes', 'Faroles'],
            'categorias'  => ['jardines-zen'],
        ],

        // ── Jardines de Suculentas ────────────────────────────────────────────
        [
            'nombre'      => 'Cactus & Suculentas MX',
            'tipo'        => 'Vivero especializado',
            'descripcion' => 'La mayor variedad de cactus, agaves, echeverias y suculentas raras de importación.',
            'icono'       => '🌵',
            'color'       => '#8FAF52',
            'sitio_web'   => 'https://www.google.com/search?q=tienda+cactus+suculentas',
            'tags'        => ['Cactus', 'Echeverias', 'Agaves'],
            'categorias'  => ['jardines-de-suculentas', 'jardines-nativos'],
        ],
        [
            'nombre'      => 'Terrario Store',
            'tipo'        => 'Tienda online y física',
            'descripcion' => 'Macetas de terracota, sustratos cactáceos, arena volcánica y kits de cultivo para suculentas.',
            'icono'       => '🏺',
            'color'       => '#C4813A',
            'sitio_web'   => 'https://www.google.com/search?q=macetas+sustratos+suculentas',
            'tags'        => ['Macetas', 'Sustrato', 'Arena volcánica'],
            'categorias'  => ['jardines-de-suculentas'],
        ],

        // ── Huertos y Jardines Comestibles ───────────────────────────────────
        [
            'nombre'      => 'Semillero Orgánico',
            'tipo'        => 'Semillas y plántulas',
            'descripcion' => 'Semillas certificadas orgánicas de hortalizas, hierbas aromáticas, frutales y flores comestibles.',
            'icono'       => '🌱',
            'color'       => '#3D8B37',
            'sitio_web'   => 'https://www.google.com/search?q=semillas+organicas+hortaliza+mexico',
            'tags'        => ['Semillas', 'Orgánico', 'Hortalizas'],
            'categorias'  => ['huertos-y-jardines-comestibles', 'jardines-de-flores'],
        ],
        [
            'nombre'      => 'Huerto Urbano',
            'tipo'        => 'Tienda de agricultura urbana',
            'descripcion' => 'Composta, lombricomposta, camas de cultivo elevadas, riego por goteo y herramientas de huerto.',
            'icono'       => '🥬',
            'color'       => '#3B6D11',
            'sitio_web'   => 'https://www.google.com/search?q=tienda+huerto+urbano+composta',
            'tags'        => ['Composta', 'Riego', 'Camas de cultivo'],
            'categorias'  => ['huertos-y-jardines-comestibles'],
        ],

        // ── Terrazas y Balcones ───────────────────────────────────────────────
        [
            'nombre'      => 'Balcón Verde',
            'tipo'        => 'Diseño exterior compacto',
            'descripcion' => 'Maceteros verticales, muebles de exterior plegables, plantas de bajo mantenimiento para espacios pequeños.',
            'icono'       => '🏙️',
            'color'       => '#7A6B52',
            'sitio_web'   => 'https://www.google.com/search?q=maceteros+verticales+terraza+balcon',
            'tags'        => ['Maceteros verticales', 'Muebles exterior', 'Plantas compactas'],
            'categorias'  => ['terrazas-y-balcones', 'jardines-verticales'],
        ],
        [
            'nombre'      => 'TerrazaShop',
            'tipo'        => 'Tienda de exteriores',
            'descripcion' => 'Pérgolas tensadas, toldos, iluminación LED solar y decoración para terrazas urbanas.',
            'icono'       => '☀️',
            'color'       => '#A67C52',
            'sitio_web'   => 'https://www.google.com/search?q=pergola+toldo+terraza+urbana',
            'tags'        => ['Pérgolas', 'Toldos', 'LED solar'],
            'categorias'  => ['terrazas-y-balcones', 'espacios-de-exterior'],
        ],

        // ── Jardines Acuáticos ────────────────────────────────────────────────
        [
            'nombre'      => 'Aqua Jardín',
            'tipo'        => 'Especialista en agua',
            'descripcion' => 'Estanques prefabricados, bombas de agua, plantas acuáticas, peces de ornato y fuentes de jardín.',
            'icono'       => '💧',
            'color'       => '#3A7BD5',
            'sitio_web'   => 'https://www.google.com/search?q=estanque+fuente+jardin+plantas+acuaticas',
            'tags'        => ['Estanques', 'Plantas acuáticas', 'Fuentes'],
            'categorias'  => ['jardines-acuaticos'],
        ],
        [
            'nombre'      => 'Koi & Water Gardens',
            'tipo'        => 'Tienda de acuicultura ornamental',
            'descripcion' => 'Filtros para estanques, cascadas artificiales, lirios acuáticos, lotos y peces koi.',
            'icono'       => '🐟',
            'color'       => '#185FA5',
            'sitio_web'   => 'https://www.google.com/search?q=koi+acuacultura+ornamental+jardin',
            'tags'        => ['Koi', 'Filtros', 'Lotos y lirios'],
            'categorias'  => ['jardines-acuaticos'],
        ],

        // ── Jardines Nativos ──────────────────────────────────────────────────
        [
            'nombre'      => 'Flora Nativa México',
            'tipo'        => 'Vivero de flora endémica',
            'descripcion' => 'Plantas endémicas mexicanas: tepozanes, copal, nopales, magueyes y flores silvestres regionales.',
            'icono'       => '🌿',
            'color'       => '#4A7C2F',
            'sitio_web'   => 'https://www.google.com/search?q=vivero+plantas+nativas+endemicas+mexico',
            'tags'        => ['Plantas endémicas', 'Nopales', 'Magueyes'],
            'categorias'  => ['jardines-nativos'],
        ],
        [
            'nombre'      => 'Biodiversidad Verde',
            'tipo'        => 'Consultoría y vivero',
            'descripcion' => 'Proyectos de restauración ecológica, guías de identificación y talleres de jardinería nativa.',
            'icono'       => '🦋',
            'color'       => '#3B6D11',
            'sitio_web'   => 'https://www.google.com/search?q=jardineria+nativa+restauracion+ecologica',
            'tags'        => ['Restauración', 'Biodiversidad', 'Talleres'],
            'categorias'  => ['jardines-nativos'],
        ],

        // ── Jardines Modernos ─────────────────────────────────────────────────
        [
            'nombre'      => 'Geometría Verde',
            'tipo'        => 'Diseño minimalista',
            'descripcion' => 'Macetas geométricas de concreto, grava negra volcánica, plantas de líneas limpias y pasto sintético premium.',
            'icono'       => '⬛',
            'color'       => '#2C2C2C',
            'sitio_web'   => 'https://www.google.com/search?q=macetas+concreto+jardin+moderno+minimalista',
            'tags'        => ['Concreto', 'Grava volcánica', 'Pasto sintético'],
            'categorias'  => ['jardines-modernos'],
        ],
        [
            'nombre'      => 'MaterialShop Exterior',
            'tipo'        => 'Materiales de construcción',
            'descripcion' => 'Adoquín, duela de madera tratada, acero corten, iluminación empotrada y acabados arquitectónicos.',
            'icono'       => '🏗️',
            'color'       => '#444441',
            'sitio_web'   => 'https://www.google.com/search?q=acero+corten+materiales+jardin+moderno',
            'tags'        => ['Acero corten', 'Adoquín', 'Duelas'],
            'categorias'  => ['jardines-modernos', 'espacios-de-exterior'],
        ],

        // ── Jardines de Roca ──────────────────────────────────────────────────
        [
            'nombre'      => 'Piedra & Paisaje',
            'tipo'        => 'Proveedor de piedra natural',
            'descripcion' => 'Rocas para jardín, piedra cantera, tepetate, mármol, cuarzo y piedras de río en distintos tamaños.',
            'icono'       => '⛰️',
            'color'       => '#8B6914',
            'sitio_web'   => 'https://www.google.com/search?q=rocas+piedra+natural+jardin+paisajismo',
            'tags'        => ['Cantera', 'Tepetate', 'Piedra de río'],
            'categorias'  => ['jardines-de-roca'],
        ],
        [
            'nombre'      => 'Alpine Plants',
            'tipo'        => 'Vivero de plantas alpinas',
            'descripcion' => 'Plantas para rocallas: sedum, sempervivum, arabis, aubrieta y hebes para composiciones de roca.',
            'icono'       => '🌾',
            'color'       => '#5F5E5A',
            'sitio_web'   => 'https://www.google.com/search?q=plantas+rocalla+sedum+sempervivum',
            'tags'        => ['Sedum', 'Sempervivum', 'Rocallas'],
            'categorias'  => ['jardines-de-roca'],
        ],

        // ── Jardines Verticales ───────────────────────────────────────────────
        [
            'nombre'      => 'Muros Vivos MX',
            'tipo'        => 'Sistemas de jardín vertical',
            'descripcion' => 'Paneles modulares, sistemas de riego automatizado, sustratos especiales y plantas trepadoras.',
            'icono'       => '🧱',
            'color'       => '#5E8B3F',
            'sitio_web'   => 'https://www.google.com/search?q=jardin+vertical+muro+verde+sistema+modular',
            'tags'        => ['Paneles modulares', 'Riego auto', 'Trepadoras'],
            'categorias'  => ['jardines-verticales'],
        ],
        [
            'nombre'      => 'Green Wall Solutions',
            'tipo'        => 'Instalación profesional',
            'descripcion' => 'Estructuras metálicas para muros verdes, mallas, geotextiles, helechos y pothos en volumen.',
            'icono'       => '🌿',
            'color'       => '#3B6D11',
            'sitio_web'   => 'https://www.google.com/search?q=muro+verde+estructura+instalacion+profesional',
            'tags'        => ['Geotextil', 'Estructura metálica', 'Pothos'],
            'categorias'  => ['jardines-verticales'],
        ],

        // ── Jardines de Flores ────────────────────────────────────────────────
        [
            'nombre'      => 'Florería El Color',
            'tipo'        => 'Vivero floral',
            'descripcion' => 'Anuales, perennes, bulbos importados, rosas, peonías y plantas de floración estacional por temporada.',
            'icono'       => '🌸',
            'color'       => '#D05A8A',
            'sitio_web'   => 'https://www.google.com/search?q=vivero+flores+anuales+perennes+bulbos',
            'tags'        => ['Anuales', 'Bulbos', 'Rosas y peonías'],
            'categorias'  => ['jardines-de-flores'],
        ],
        [
            'nombre'      => 'Semillas de Color',
            'tipo'        => 'Semillas y herramientas',
            'descripcion' => 'Semillas de flores silvestres, mezclas de pradera, abonos florales y herramientas de jardinería fina.',
            'icono'       => '🌼',
            'color'       => '#E09000',
            'sitio_web'   => 'https://www.google.com/search?q=semillas+flores+silvestres+pradera+jardin',
            'tags'        => ['Semillas', 'Pradera', 'Herramientas'],
            'categorias'  => ['jardines-de-flores'],
        ],

        // ── Espacios de Exterior ──────────────────────────────────────────────
        [
            'nombre'      => 'Pérgolas & Madera',
            'tipo'        => 'Carpintería exterior',
            'descripcion' => 'Pérgolas de madera tratada, quinchones, fogones de leña, mesas de exterior y tarimas de madera.',
            'icono'       => '🪵',
            'color'       => '#9B6B3A',
            'sitio_web'   => 'https://www.google.com/search?q=pergola+madera+quincho+fogon+exterior',
            'tags'        => ['Pérgolas', 'Quinchones', 'Fogones'],
            'categorias'  => ['espacios-de-exterior'],
        ],
        [
            'nombre'      => 'OutdoorLife MX',
            'tipo'        => 'Muebles y equipamiento outdoor',
            'descripcion' => 'Muebles de exterior en aluminio y teca, parrillas de alta gama, cocinas al aire libre y calefactores.',
            'icono'       => '🍖',
            'color'       => '#7B4A2C',
            'sitio_web'   => 'https://www.google.com/search?q=muebles+exterior+parrilla+cocina+outdoor',
            'tags'        => ['Muebles outdoor', 'Parrillas', 'Calefactores'],
            'categorias'  => ['espacios-de-exterior'],
        ],
    ];

    public function run(): void
    {
        foreach ($this->tiendas as $data) {
            // Crear la tienda
            $tienda = TiendaRecomendada::create([
                'nombre'      => $data['nombre'],
                'tipo'        => $data['tipo'],
                'descripcion' => $data['descripcion'],
                'icono'       => $data['icono'],
                'color'       => $data['color'],
                'sitio_web'   => $data['sitio_web'],
                'activo'      => true,
            ]);

            // Asociar categorías por slug
            $categoriasIds = Categoria::whereIn('slug', $data['categorias'])->pluck('id');
            $tienda->categorias()->sync($categoriasIds);

            // Crear tags
            foreach ($data['tags'] as $tag) {
                TiendaTag::create(['tienda_id' => $tienda->id, 'tag' => $tag]);
            }
        }

        $this->command->info('✅ Tiendas recomendadas sembradas correctamente.');
    }
}
