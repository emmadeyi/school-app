<?php

use App\Permission;
use Illuminate\Database\Seeder;

class UpdatePermission extends Seeder
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
            [   "slug" => "answer.index",
                "name" => "Answer View",
                "group" => "Academic"
            ],
            [   "slug" => "answer.show",
                "name" => "Answer View",
                "group" => "Academic"
            ],
            [   "slug" => "answer.create",
                "name" => "Answer Create",
                "group" => "Academic"
            ],
            [   "slug" => "answer.store",
                "name" => "Answer Create",
                "group" => "Academic"
            ],
            [   "slug" => "answer.edit",
                "name" => "Answer Edit",
                "group" => "Academic"
            ],
            [   "slug" => "answer.update",
                "name" => "Answer Edit",
                "group" => "Academic"
            ],
            [   "slug" => "answer.destroy",
                "name" => "Answer Delete",
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
