<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class CategorySeeder extends Seeder
{
    /**
     * array of category names
     *
     * @var array
     */
    private $categories = [
        'books',
        'cars',
        'tea',
        'sneakers',
        'kittens',
        'puppies',
        'memes',
        'vodka'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->categories as $category) {
            DB::table(Category::TABLE_NAME)->insert([
                Category::TITLE => $category,
                Model::CREATED_AT => now(),
                Model::UPDATED_AT => now()
            ]);
        }
    }
}
