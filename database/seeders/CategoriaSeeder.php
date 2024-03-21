<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categoria')->insert([
            [
                'alias'=> 'Todos',
                'descripcion'=> 'Todos los productos existentes'
            ],
            [
                'alias'=> 'Electrodomesticos',
                'descripcion'=> 'Electrodomésticos: Encuentra una amplia selección de productos para equipar tu hogar con electrodomésticos de calidad, desde lavadoras y refrigeradores hasta microondas y aspiradoras. Descubre las últimas tecnologías y marcas líderes para hacer tu vida más cómoda y eficiente'
            ],
            [
                'alias'=> 'Electrónica',
                'descripcion'=> 'Electrónica de Consumo: Descubre la última tecnología en electrónica de consumo, desde teléfonos inteligentes y computadoras hasta televisores y dispositivos inteligentes para el hogar. Encuentra productos de las marcas más reconocidas y disfruta de la innovación a tu alcance.'
            ],
            [
                'alias'=> 'Ropa',
                'descripcion'=> 'Ropa y Accesorios: Renueva tu guardarropa con las últimas tendencias en moda y accesorios. Encuentra ropa para todas las ocasiones, desde ropa casual hasta trajes elegantes, así como una amplia gama de accesorios para complementar tu estilo.'
            ],
            [
                'alias'=> 'Hogar',
                'descripcion'=> 'Hogar y Jardín: Transforma tu hogar en un oasis de comodidad y estilo con nuestra selección de productos para el hogar y el jardín. Encuentra muebles, decoración, herramientas de jardinería y mucho más para crear el espacio perfecto.'
            ],
            [
                'alias'=> 'Belleza',
                'descripcion'=> 'Salud y Belleza: Cuida de ti mismo con nuestra gama de productos de salud y belleza. Encuentra cosméticos, productos para el cuidado de la piel, suplementos alimenticios y mucho más para lucir y sentirte mejor.'
            ],
            [
                'alias'=> 'Deportes',
                'descripcion'=> 'Deportes y Aire Libre: Prepárate para la acción con nuestra selección de productos deportivos y de aire libre. Desde equipos de fitness hasta equipos de campamento, tenemos todo lo que necesitas para mantenerte activo y disfrutar del aire libre.'
            ],
            [
                'alias'=> 'Juguetes',
                'descripcion'=> 'Juguetes y Juegos: Diviértete con nuestra amplia variedad de juguetes y juegos para todas las edades. Desde juguetes educativos para niños hasta juegos de mesa para toda la familia, tenemos algo para todos los gustos.'
            ],
            [
                'alias'=> 'Herramientas',
                'descripcion'=> 'Herramientas y Mejoras para el Hogar: Hazlo tú mismo con nuestra selección de herramientas y mejoras para el hogar. Encuentra herramientas manuales, eléctricas y de jardinería, así como materiales de construcción y equipos de seguridad.'
            ],
            [
                'alias'=> 'Alimentos',
                'descripcion'=> 'Alimentación y Bebidas: Deléitate con nuestra variedad de alimentos y bebidas de alta calidad. Desde productos gourmet hasta alimentos básicos, tenemos todo lo que necesitas para satisfacer tus antojos y alimentar a tu familia.'
            ],
            [
                'alias'=> 'Automoviles',
                'descripcion'=> 'Automóviles y Motocicletas: Mantén tu vehículo en óptimas condiciones con nuestra selección de productos para automóviles y motocicletas. Encuentra repuestos, accesorios, herramientas de mantenimiento y mucho más para mantener tu vehículo en la carretera.'
            ]
        ]);
    }
}
