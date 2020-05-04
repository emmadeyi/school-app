<?php

use App\Permission;
use Illuminate\Database\Seeder;

class UpdatePermissionTableSeeder extends Seeder
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
            // [   "slug" => "answer.index",
            //     "name" => "Answer View",
            //     "group" => "Academic"
            // ],
            // [   "slug" => "answer.show",
            //     "name" => "Answer View",
            //     "group" => "Academic"
            // ],
            // [   "slug" => "answer.create",
            //     "name" => "Answer Create",
            //     "group" => "Academic"
            // ],
            // [   "slug" => "answer.store",
            //     "name" => "Answer Create",
            //     "group" => "Academic"
            // ],
            // [   "slug" => "answer.edit",
            //     "name" => "Answer Edit",
            //     "group" => "Academic"
            // ],
            // [   "slug" => "answer.update",
            //     "name" => "Answer Edit",
            //     "group" => "Academic"
            // ],
            // [   "slug" => "answer.destroy",
            //     "name" => "Answer Delete",
            //     "group" => "Academic"
            // ],

            [   "slug" => "classwrok_attempt.index",
                "name" => "Classwort Attempt View",
                "group" => "Academic"
            ],
            [   "slug" => "classwrok_attempt.show",
                "name" => "Classwort Attempt View",
                "group" => "Academic"
            ],
            [   "slug" => "classwrok_attempt.create",
                "name" => "Classwort Attempt Create",
                "group" => "Academic"
            ],
            [   "slug" => "classwrok_attempt.store",
                "name" => "Classwort Attempt Create",
                "group" => "Academic"
            ],
            [   "slug" => "classwrok_attempt.edit",
                "name" => "Classwort Attempt Edit",
                "group" => "Academic"
            ],
            [   "slug" => "classwrok_attempt.update",
                "name" => "Classwort Attempt Edit",
                "group" => "Academic"
            ],
            [   "slug" => "classwrok_attempt.destroy",
                "name" => "Classwort Attempt Delete",
                "group" => "Academic"
            ],

            [   "slug" => "classwrok_grade.index",
                "name" => "Classwort Grade View",
                "group" => "Academic"
            ],
            [   "slug" => "classwrok_grade.show",
                "name" => "Classwort Grade View",
                "group" => "Academic"
            ],
            [   "slug" => "classwrok_grade.create",
                "name" => "Classwort Grade Create",
                "group" => "Academic"
            ],
            [   "slug" => "classwrok_grade.store",
                "name" => "Classwort Grade Create",
                "group" => "Academic"
            ],
            [   "slug" => "classwrok_grade.edit",
                "name" => "Classwort Grade Edit",
                "group" => "Academic"
            ],
            [   "slug" => "classwrok_grade.update",
                "name" => "Classwort Grade Edit",
                "group" => "Academic"
            ],
            [   "slug" => "classwrok_grade.destroy",
                "name" => "Classwort Grade Delete",
                "group" => "Academic"
            ],

            [   "slug" => "live_class.index",
                "name" => "Live Class View",
                "group" => "Academic"
            ],
            [   "slug" => "live_class.show",
                "name" => "Live Class View",
                "group" => "Academic"
            ],
            [   "slug" => "live_class.create",
                "name" => "Live Class Create",
                "group" => "Academic"
            ],
            [   "slug" => "live_class.store",
                "name" => "Live Class Create",
                "group" => "Academic"
            ],
            [   "slug" => "live_class.edit",
                "name" => "Live Class Edit",
                "group" => "Academic"
            ],
            [   "slug" => "live_class.update",
                "name" => "Live Class Edit",
                "group" => "Academic"
            ],
            [   "slug" => "live_class.destroy",
                "name" => "Live Class Delete",
                "group" => "Academic"
            ],

            [   "slug" => "forum.index",
                "name" => "Forum View",
                "group" => "Academic"
            ],
            [   "slug" => "forum.show",
                "name" => "Forum View",
                "group" => "Academic"
            ],
            [   "slug" => "forum.create",
                "name" => "Forum Create",
                "group" => "Academic"
            ],
            [   "slug" => "forum.store",
                "name" => "Forum Create",
                "group" => "Academic"
            ],
            [   "slug" => "forum.edit",
                "name" => "Forum Edit",
                "group" => "Academic"
            ],
            [   "slug" => "forum.update",
                "name" => "Forum Edit",
                "group" => "Academic"
            ],
            [   "slug" => "forum.destroy",
                "name" => "Forum Delete",
                "group" => "Academic"
            ],

            [   "slug" => "forum_comment.index",
                "name" => "Forum Comment View",
                "group" => "Academic"
            ],
            [   "slug" => "forum_comment.show",
                "name" => "Forum Comment View",
                "group" => "Academic"
            ],
            [   "slug" => "forum_comment.create",
                "name" => "Forum Comment Create",
                "group" => "Academic"
            ],
            [   "slug" => "forum_comment.store",
                "name" => "Forum Comment Create",
                "group" => "Academic"
            ],
            [   "slug" => "forum_comment.edit",
                "name" => "Forum Comment Edit",
                "group" => "Academic"
            ],
            [   "slug" => "forum_comment.update",
                "name" => "Forum Comment Edit",
                "group" => "Academic"
            ],
            [   "slug" => "forum_comment.destroy",
                "name" => "Forum Comment Delete",
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
