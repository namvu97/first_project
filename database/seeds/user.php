<?php
use Illuminate\Database\Seeder;

class user extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            ['id' => 1, 'username' => 'namvu97', 'password' => 'nam123', 'email' => 'namvpn23121997@gmail.com', 'full_name' => 'Vũ Phương Nam', 'is_admin' => 1, 'photo' => '', 'division_id' => 4],
        ]);
        factory(App\User::class, 3)->create();
    }
}
