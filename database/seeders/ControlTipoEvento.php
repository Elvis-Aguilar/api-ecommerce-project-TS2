<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ControlTipoEvento extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tipo_evento')->insert([
                [
                    'alias'=> 'Todos',
                    'descripcion'=> 'Todos los Eventos existentes'
                ],
                [
                    'alias'=> 'Forestales',
                    'descripcion'=> 'Eventos forestales: Ayuda a preservar el medio ambiente participando en actividades de reforestación, limpieza de parques y senderos, y conservación de áreas naturales.'
                ],
                [
                    'alias'=> 'Sociales',
                    'descripcion'=> 'Eventos sociales: Contribuye al bienestar de tu comunidad participando en actividades de ayuda social, como la distribución de alimentos, la construcción de viviendas y la atención a personas necesitadas.'
                ],
                [
                    'alias'=> 'Educativos',
                    'descripcion'=> 'Eventos educativos: Promueve la educación y el aprendizaje participando en eventos educativos, como clases de apoyo escolar, talleres de formación y charlas sobre temas relevantes para la comunidad.'
                ],
                [
                    'alias'=> 'Salud',
                    'descripcion'=> 'Eventos de salud: Apoya la salud y el bienestar de tu comunidad participando en campañas de vacunación, jornadas médicas, donación de sangre y actividades de concientización sobre enfermedades.'
                ],
                [
                    'alias'=> 'Culturales',
                    'descripcion'=> 'Eventos culturales: Celebra la diversidad cultural y promueve el arte y la creatividad participando en eventos culturales, como festivales de música, exposiciones de arte y actividades de intercambio cultural.'
                ],
                [
                    'alias'=> 'Animales',
                    'descripcion'=> 'Eventos en pro de los animales: Contribuye a la protección y el cuidado de los animales participando en actividades de rescate, adopción, esterilización y concientización sobre el bienestar animal.'
                ],
                [
                    'alias'=> 'Deportivos',
                    'descripcion'=> 'Eventos deportivos: Fomenta el deporte y el estilo de vida activo participando en eventos deportivos, como carreras benéficas, torneos deportivos y actividades recreativas al aire libre.'
                ],
                [
                    'alias'=> 'Arte',
                    'descripcion'=> 'Eventos de arte y creatividad: Inspira y promueve la expresión artística participando en eventos de arte urbano, murales comunitarios, talleres de manualidades y actividades de reciclaje creativo.'
                ],
                [
                    'alias'=> 'Tecnología',
                    'descripcion'=> 'Eventos de tecnología y desarrollo: Impulsa la innovación y el desarrollo tecnológico participando en hackathones, workshops de programación, y proyectos de desarrollo de software para el bien común.'
                ]
            ]);
    }
}
