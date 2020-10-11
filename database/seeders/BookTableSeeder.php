<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private function random_float($start_number = 0, $end_number = 1, $mul = 1000000)
    {

        // If start number is greater than end number then return false
        if ($start_number > $end_number) {
            return false;
        }

        // Return random float number
        return mt_rand($start_number * $mul, $end_number * $mul) / $mul;
    }

    public function run()
    {
        $title = [
            'Algebra', 'Science', 'English', 'Differential Calculus', 'Integral Calculus', 'Differential Equation',
            'Electrical Circuits', 'C# Programming', 'C Programming', 'JavaScript', 'PHP', 'Philippine History',
            'Geometry', 'Biology', 'Discrete Mathematics', 'Physics', 'Basic Math', 'Statistics & Probability',
            'English Grammar', 'Psychology',
        ];
        $author = [
            'A. Abraham', 'B. Bob', 'C. Cathyrine', 'D. Dudz', 'E. Efraim', 'F. Frone', 'G. Guisha', 'H. Heinrich',
            'Z. Zebara', 'Q. Quiapo', 'R. Rockstar', 'T. Tyron', 'Y. Yolo', 'U. Undertaker', 'I. Iloiu', 'O. Oyster',
            'P. Prince', 'S. Skies', 'J. Jay-Z', 'K. Kyle',
        ];
        for ($i = 0; $i < count($title); $i++) {
            $id = 100100 + $i;
            DB::table('books')->insert([
                'id' => $id,
                'title' => $title[$i],
                'author' => $author[$i],
                'price' => $this->random_float(100, 1000),
                'stacks' => mt_rand(10, 100),
            ]);
        }

    }
}
