<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OwnersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('owners')->insert([
            [
                'id' => '1',
                'name' => 'オーナー１',
                'email' => 'owner1@gmail.com',
                'password' => bcrypt('owner1234'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '2',
                'name' => 'オーナー２',
                'email' => 'owner2@gmail.com',
                'password' => bcrypt('owner1234'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '3',
                'name' => 'オーナー３',
                'email' => 'owner3@gmail.com',
                'password' => bcrypt('owner1234'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '4',
                'name' => 'オーナー４',
                'email' =>  'owner4@gmail.com',
                'password' =>  bcrypt('owner1234'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '5',
                'name' => 'オーナー５',
                'email' => 'owner5@gmail.com',
                'password' => bcrypt('owner1234'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '6',
                'name' => 'オーナー6',
                'email' => 'owner6@gmail.com',
                'password' => bcrypt('owner1234'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '7',
                'name' => 'オーナー7',
                'email' => 'owner5@gmail.com',
                'password' => bcrypt('owner1234'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '8',
                'name' => 'オーナー8',
                'email' => 'owner5@gmail.com',
                'password' => bcrypt('owner1234'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '9',
                'name' => 'オーナー9',
                'email' => 'owner5@gmail.com',
                'password' => bcrypt('owner1234'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '10',
                'name' => 'オーナー10',
                'email' => 'owner5@gmail.com',
                'password' => bcrypt('owner1234'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '11',
                'name' => 'オーナー11',
                'email' => 'owner5@gmail.com',
                'password' => bcrypt('owner1234'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '12',
                'name' => 'オーナー12',
                'email' => 'owner5@gmail.com',
                'password' => bcrypt('owner1234'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '13',
                'name' => 'オーナー13',
                'email' => 'owner5@gmail.com',
                'password' => bcrypt('owner1234'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '14',
                'name' => 'オーナー14',
                'email' => 'owner5@gmail.com',
                'password' => bcrypt('owner1234'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '15',
                'name' => 'オーナー1５',
                'email' => 'owner5@gmail.com',
                'password' => bcrypt('owner1234'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '16',
                'name' => 'オーナー16',
                'email' => 'owner5@gmail.com',
                'password' => bcrypt('owner1234'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '17',
                'name' => 'オーナー17',
                'email' => 'owner5@gmail.com',
                'password' => bcrypt('owner1234'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '18',
                'name' => 'オーナー18',
                'email' => 'owner5@gmail.com',
                'password' => bcrypt('owner1234'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '19',
                'name' => 'オーナー19',
                'email' => 'owner5@gmail.com',
                'password' => bcrypt('owner1234'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'id' => '20',
                'name' => 'オーナー20',
                'email' => 'owner5@gmail.com',
                'password' => bcrypt('owner1234'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
