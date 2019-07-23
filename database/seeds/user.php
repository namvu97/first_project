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
        	['id'=>1, 'username'=>'namvu97','password'=>'nam123','email'=>'namvpn23121997@gmail.com','full_name'=>'Vũ Phương Nam','is_admin'=>1,'photo'=>'','division_id'=>4],
            ['id'=>2, 'username'=>'user01','password'=>'nam123','email'=>'namvu9701@gmail.com','full_name'=>'Nguyễn Văn A','is_admin'=>0,'photo'=>'','division_id'=>3],
            ['id'=>3, 'username'=>'user02','password'=>'nam123','email'=>'namvu9702@gmail.com','full_name'=>'Trần Văn B','is_admin'=>0,'photo'=>'','division_id'=>1],
            ['id'=>4, 'username'=>'user03','password'=>'nam123','email'=>'namvu9704@gmail.com','full_name'=>'Phạm Thị C','is_admin'=>0,'photo'=>'','division_id'=>2],
        ]);
    }
}
