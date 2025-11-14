<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get existing program IDs
        $programIds = DB::table('programs')->pluck('program_id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            DB::table('students')->insert([
                'student_Fname' => $faker->firstName,
                'student_Mname' => $faker->optional()->firstName,
                'student_Lname' => $faker->lastName,
                'student_Email' => $faker->unique()->safeEmail,
                'student_Birthdate' => $faker->date('Y-m-d', '2005-01-01'),
                'student_Gender' => $faker->randomElement(['1', '2']),

                // Foreign key to programs table
                'program_id' => $faker->randomElement($programIds),

                // Format: ####-######
                'student_Number' => sprintf('%04d-%06d',
                    $faker->numberBetween(2018, 2025),
                    $faker->numberBetween(1, 999999)
                ),

                'student_YearLevel' => $faker->numberBetween(1, 6),
                'student_Status' => $faker->numberBetween(1, 3),
                'student_Notes' => $faker->optional()->sentence(),

                // Default student image
                'student_Image' => 'students/default-student.jpg',

                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
