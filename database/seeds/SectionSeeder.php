<?php

use App\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectionRecords = [
            ['id'=>1,'section_name'=>'Desktop PC', 'status'=>1, 'slug' => 'desktop-pc'],
            ['id'=>2,'section_name'=>'Networking', 'status'=>1, 'slug' => 'networking'],
            ['id'=>3,'section_name'=>'Printer', 'status'=>1, 'slug' => 'printer'],
            ['id'=>4,'section_name'=>'Accessories', 'status'=>1, 'slug' => 'accessories'],
            ['id'=>5,'section_name'=>'Computer', 'status'=>1, 'slug' => 'computer'],
            ['id'=>6,'section_name'=>'Laptop & Ntebook', 'status'=>1, 'slug' => 'laptop-and-netbook'],
            ['id'=>7,'section_name'=>'Office Equipment', 'status'=>1, 'slug' => 'office-equipment'],
            ['id'=>8,'section_name'=>'Photocopier', 'status'=>1, 'slug' => 'photocopier'],
            ['id'=>9,'section_name'=>'Monitor', 'status'=>1, 'slug' => 'monitor'],
            ['id'=>10,'section_name'=>'Projector', 'status'=>1, 'slug' => 'projector'],
            ['id'=>11,'section_name'=>'UPS', 'status'=>1, 'slug' => 'ups'],
            ['id'=>12,'section_name'=>'Security System', 'status'=>1, 'slug' => 'security'],
            ['id'=>13,'section_name'=>'Camera', 'status'=>1, 'slug' => 'camera'],
            ['id'=>14,'section_name'=>'Gaming', 'status'=>1, 'slug' => 'gaming'],
            ['id'=>15,'section_name'=>'Software', 'status'=>1, 'slug' => 'software'],
            ['id'=>16,'section_name'=>'Server', 'status'=>1, 'slug' => 'server'],
            ['id'=>17,'section_name'=>'Television', 'status'=>1, 'slug' => 'television'],
        ];
        Section::insert($sectionRecords);

    }
}
