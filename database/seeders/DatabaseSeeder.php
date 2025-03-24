<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Department;
use App\Models\Plan;
use App\Models\Teacher;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   /**
    * Undocumented function
    *
    * @return void
    */ 
    public function run(): void
    {
        // Department::factory(10)->create();
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // $teacher = Teacher::create([
        //     'name' => 'Nader',
        //     'email' => 'Nader@example.com',
        //     'phone' => '123-456-7890',
        //     'academic_degree'=> 'PhD',
        //     'price_hourly'=>5000,
        //     'num_job'=>45478787,
        //     'address'=>'123 Main St, Anytown, USA',
        // ]);
        // $department = Department::find(1);
        // $course = Course::find(8);
        // $teacher->departments()->attach($department);
        // $teacher->courses()->attach($course);


    }
}
