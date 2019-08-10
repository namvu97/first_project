<?php
use Illuminate\Database\Seeder;

class division extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('division')->insert([
            ['id' => 1, 'division_name' => 'D1', 'division_phone' => '0987654321', 'manager_name' => 'Trần Văn B'],
            ['id' => 2, 'division_name' => 'D2', 'division_phone' => '0987654321', 'manager_name' => 'Phạm Thị C'],
            ['id' => 3, 'division_name' => 'D3', 'division_phone' => '0987654321', 'manager_name' => 'Nguyễn Văn A'],
            ['id' => 4, 'division_name' => 'D4', 'division_phone' => '0987654321', 'manager_name' => 'Vũ Phương Nam'],
        ]);
    }
}
