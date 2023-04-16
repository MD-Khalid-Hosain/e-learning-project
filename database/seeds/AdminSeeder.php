<?php

use Illuminate\Database\Seeder;
// use DB;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('admins')->delete();
        $adminRecords = [
            [
                'id'=>1, 'name'=>'Supper Admin', 'mobile'=>'01912467444', 'email'=>'khalidkayes9@gmail.com','type'=>'Supper Admin', 'password'=> '$2y$10$6ZDBGJTbkcz11BiDdZ2q7eT.9zGnQXC6Io.sA7fK7UPR3LkhBHHl2', 'image'=>'', 'status'=>1
            ],
        ];

        foreach ($adminRecords as $key => $record){
            \App\Admin::create($record);
        }
    }
}
