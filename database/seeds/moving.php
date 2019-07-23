<?php

use Illuminate\Database\Seeder;

class moving extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('moving')->insert([
        // DB::table('moving')->insert([
        //  ['id'=>1,'status'=>'Đã chuyển','old_division'=>'D3','user_id'=>4],
        //  ['id'=>2,'status'=>'Đang xử lý','old_division'=>'D2','user_id'=>2],
        //  ['id'=>3,'status'=>'Đang xử lý','old_division'=>'D3','user_id'=>1],
        //  ['id'=>4,'status'=>'Đã chuyển','old_division'=>'D1','user_id'=>3],
        // ]);
        ]);
    }
}
