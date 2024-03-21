<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rol')->insert([
            [
                'rol_alias'=> 'admin',
                'nivel_autorizacion'=> 1
            ],
            [
                'rol_alias'=> 'comprador',
                'nivel_autorizacion'=> 2
            ]
        ]);
    }
}
