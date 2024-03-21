<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuario')->insert([
            [
                'nombre_completo' => 'Administrador-01',
                'contrasenia' => 'd5967f43e5c9cc57cab6d59f83e8ae166b444e3022079f8b6273150639763a5f',
                'nombre_usuario' => 'Admin-01',
                'url_foto' => '',
                'info_contacto' => 1,
                'rol' => 1
            ]
        ]);
    }
}
