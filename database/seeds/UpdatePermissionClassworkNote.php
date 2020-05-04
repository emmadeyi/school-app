<?php

use App\Permission;
use Illuminate\Database\Seeder;

class UpdatePermissionClassworkNote extends Seeder
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
            [   "slug" => "classwork_note.index",
                "name" => "Classwork Note View",
                "group" => "Academic"
            ],
            [   "slug" => "classwork_note.show",
                "name" => "Classwork Note View",
                "group" => "Academic"
            ],
            [   "slug" => "classwork_note.create",
                "name" => "Classwork Note Create",
                "group" => "Academic"
            ],
            [   "slug" => "classwork_note.store",
                "name" => "Classwork Note Create",
                "group" => "Academic"
            ],
            [   "slug" => "classwork_note.edit",
                "name" => "Classwork Note Edit",
                "group" => "Academic"
            ],
            [   "slug" => "classwork_note.update",
                "name" => "Classwork Note Edit",
                "group" => "Academic"
            ],
            [   "slug" => "classwork_note.destroy",
                "name" => "Classwork Note Delete",
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
