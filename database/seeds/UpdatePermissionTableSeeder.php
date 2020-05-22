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

            [   "slug" => "classwork_attempt.index",
                "name" => "Classwork Attempt View",
                "group" => "Academic"
            ],
            [   "slug" => "classwork_attempt.show",
                "name" => "Classwork Attempt View",
                "group" => "Academic"
            ],
            [   "slug" => "classwork_attempt.create",
                "name" => "Classwork Attempt Create",
                "group" => "Academic"
            ],
            [   "slug" => "classwork_attempt.store",
                "name" => "Classwork Attempt Create",
                "group" => "Academic"
            ],
            [   "slug" => "classwork_attempt.edit",
                "name" => "Classwork Attempt Edit",
                "group" => "Academic"
            ],
            [   "slug" => "classwork_attempt.update",
                "name" => "Classwork Attempt Edit",
                "group" => "Academic"
            ],
            [   "slug" => "classwork_attempt.destroy",
                "name" => "Classwork Attempt Delete",
                "group" => "Academic"
            ],

            [   "slug" => "classwork_grade.index",
                "name" => "Classwork Grade View",
                "group" => "Academic"
            ],
            [   "slug" => "classwork_grade.show",
                "name" => "Classwork Grade View",
                "group" => "Academic"
            ],
            [   "slug" => "classwork_grade.create",
                "name" => "Classwork Grade Create",
                "group" => "Academic"
            ],
            [   "slug" => "classwork_grade.store",
                "name" => "Classwork Grade Create",
                "group" => "Academic"
            ],
            [   "slug" => "classwork_grade.edit",
                "name" => "Classwork Grade Edit",
                "group" => "Academic"
            ],
            [   "slug" => "classwork_grade.update",
                "name" => "Classwork Grade Edit",
                "group" => "Academic"
            ],
            [   "slug" => "classwork_grade.destroy",
                "name" => "Classwork Grade Delete",
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
