<?php

namespace Database\Seeders;

use App\Models\UsuarioModels\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsuarioInfoContacto extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuario_info_contacto')->insert([
            [
                'url_facebook' => '',
                'url_instagram' => '',
                'url_linkedin' => '',
                'url_telegram' => '',
                'number_whatsapp' => 0,
                'correo' => ''
            ]
        ]);
    }




}
