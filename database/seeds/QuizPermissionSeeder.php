<?php

use App\Permission;
use Illuminate\Database\Seeder;

class QuizPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
                        // Classwork
            [   "slug" => "quiz.index",
                "name" => "Quiz View",
                "group" => "Academic"
            ],
            [   "slug" => "quiz.show",
                "name" => "Quiz View",
                "group" => "Academic"
            ],
            [   "slug" => "quiz.create",
                "name" => "Quiz Create",
                "group" => "Academic"
            ],
            [   "slug" => "quiz.store",
                "name" => "Quiz Create",
                "group" => "Academic"
            ],
            [   "slug" => "quiz.edit",
                "name" => "Quiz Edit",
                "group" => "Academic"
            ],
            [   "slug" => "quiz.update",
                "name" => "Quiz Edit",
                "group" => "Academic"
            ],
            [   "slug" => "quiz.destroy",
                "name" => "Quiz Delete",
                "group" => "Academic"
            ],
            // classwork End

        ];
        echo PHP_EOL , 'seeding permissions updates...';

        Permission::insert($permissions);

        echo PHP_EOL , 'seeding role permissions updates...', PHP_EOL;

        echo 'seeding roles...', PHP_EOL;       
    }
}
