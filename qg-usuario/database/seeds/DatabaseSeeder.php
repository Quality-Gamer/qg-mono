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

            DB::table('test')->insert([
                'match_id' => md5('4353454'),
                'title' => 'Python',
                'test_value' => 25.00,
                'badge' => '/python.png'
            ]);

            DB::table('test')->insert([
                'match_id' => md5('s3343'),
                'title' => 'Go',
                'test_value' => 25.00,
                'badge' => '/go.png'
            ]);

            DB::table('question')->insert([
                'test_id' => 1,
                'order' => 0,
                'question' => 'Py???',
                'option_a' => 'resp a',
                'option_b' => 'resp b',
                'option_c' => 'resp c',
                'option_d' => 'resp d',
                'response' => "C",
            ]);

            DB::table('question')->insert([
                'test_id' => 1,
                'order' => 1,
                'question' => 'PPlay???',
                'option_a' => 'resp a',
                'option_b' => 'resp b',
                'option_c' => 'resp c',
                'option_d' => 'resp d',
                'response' => "B",
            ]);

            DB::table('question')->insert([
                'test_id' => 2,
                'order' => 0,
                'question' => 'Gopher???',
                'option_a' => 'resp a',
                'option_b' => 'resp b',
                'option_c' => 'resp c',
                'option_d' => 'resp d',
                'response' => "A",
            ]);

            DB::table('user_test')->insert([
                'user_id' => 1,
                'test_id' => 2,
                'score' => 45.00,
                'win' => 0,
            ]);
           
        }
    }
}
