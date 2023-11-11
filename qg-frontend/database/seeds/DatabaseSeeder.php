<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        {
            DB::table('user')->insert([
                'name' => 'Iago',
                'email' => 'iagoagualuza@id.uff.br',
                'password' => Hash::make('123456'),
            ]);
        }
    }
}
