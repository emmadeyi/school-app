<?php

use Illuminate\Database\Seeder;
use App\Permission;
use App\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $commonPermissionList = [
            [
                "slug" => "change_password",
                "name" => "Change Password",
                "group" => "Common"
            ],
            [
                "slug" => "user.dashboard",
                "name" => "Dashboard",
                "group" => "Common"
            ],
            [
                "slug" => "lockscreen",
                "name" => "Lock Screen",
                "group" => "Common"
            ],
            [
                "slug" => "logout",
                "name" => "Logout",
                "group" => "Common"
            ],
            [
                "slug" => "profile",
                "name" => "Profile",
                "group" => "Common"
            ],
            [
                "slug" => "user.notification_unread",
                "name" => "Notification View",
                "group" => "Common"
            ],
            [
                "slug" => "user.notification_read",
                "name" => "Notification View",
                "group" => "Common"
            ],
            [
                "slug" => "user.notification_all",
                "name" => "Notification View",
                "group" => "Common"
            ]

        ];

        $administratorPermissionList = [

            [   "slug" => "user.store",
                "name" => "User Create",
                "group" => "Administration"
            ],
            [   "slug" => "user.index",
                "name" => "User View",
                "group" => "Administration"
            ],
            [   "slug" => "user.create",
                "name" => "User Create",
                "group" => "Administration"
            ],
            [   "slug" => "user.status",
                "name" => "User Edit",
                "group" => "Administration"
            ],
            [   "slug" => "user.show",
                "name" => "User View",
                "group" => "Administration"
            ],
            [   "slug" => "user.update",
                "name" => "User Edit",
                "group" => "Administration"
            ],
            [   "slug" => "user.destroy",
                "name" => "User Delete",
                "group" => "Administration"
            ],
            [   "slug" => "user.edit",
                "name" => "User Edit",
                "group" => "Administration"
            ],
            [   "slug" => "user.permission",
                "name" => "User Edit",
                "group" => "Administration"
            ]
        ];

        $onlyAdminPermissions = [
            [
                "slug" => "administrator.academic_year_destroy",
                "name" => "Academic Year Delete",
                "group" => "Admin Only"
            ],
            [
                "slug" => "administrator.academic_year",
                "name" => "Academic Year View",
                "group" => "Admin Only"
            ],
            [
                "slug" => "administrator.academic_year_store",
                "name" => "Academic Year Create",
                "group" => "Admin Only"
            ],
            [
                "slug" => "administrator.academic_year_create",
                "name" => "Academic Year Create",
                "group" => "Admin Only"
            ],
            [
                "slug" => "administrator.academic_year_edit",
                "name" => "Academic Year Edit",
                "group" => "Admin Only"
            ],
            [
                "slug" => "administrator.academic_year_status",
                "name" => "Academic Year Edit",
                "group" => "Admin Only"
            ],
            [
                "slug" => "administrator.academic_year_update",
                "name" => "Academic Year Edit",
                "group" => "Admin Only"
            ],
            [ "slug" => "settings.institute",
                "name" => "Institute Edit",
                "group" => "Admin Only"
            ],
            [ "slug" => "settings.report",
                "name" => "Report Edit",
                "group" => "Admin Only"
            ],
            [   "slug" => "user.role_index",
                "name" => "Role View",
                "group" => "Admin Only"
            ],
            [   "slug" => "user.role_destroy",
                "name" => "Role Delete",
                "group" => "Admin Only"
            ],
            [   "slug" => "user.role_create",
                "name" => "Role Create",
                "group" => "Admin Only"
            ],
            [   "slug" => "user.role_store",
                "name" => "Role Create",
                "group" => "Admin Only"
            ],
            [   "slug" => "user.role_update",
                "name" => "Role Edit",
                "group" => "Admin Only"
            ],
            [
                "slug" => "administrator.user_index",
                "name" => "System Admin View",
                "group" => "Admin Only"
            ],
            [
                "slug" => "administrator.user_create",
                "name" => "System Admin Create",
                "group" => "Admin Only"
            ],
            [
                "slug" => "administrator.user_status",
                "name" => "System Admin Edit",
                "group" => "Admin Only"
            ],
            [
                "slug" => "administrator.user_store",
                "name" => "System Admin Create",
                "group" => "Admin Only"
            ],
            [
                "slug" => "administrator.user_update",
                "name" => "System Admin Edit",
                "group" => "Admin Only"
            ],
            [
                "slug" => "administrator.user_destroy",
                "name" => "System Admin Delete",
                "group" => "Admin Only"
            ],
            [
                "slug" => "administrator.user_edit",
                "name" => "System Admin Edit",
                "group" => "Admin Only"
            ],
            [   "slug" => "administrator.user_password_reset",
                "name" => "User Password Reset",
                "group" => "Admin Only"
            ],
            // mail / sms template
            [   "slug" => "administrator.template.mailsms.index",
                "name" => "Mail_and_SMS Template View",
                "group" => "Admin Only"
            ],
            [   "slug" => "administrator.template.mailsms.create",
                "name" => "Mail_and_SMS Template Create",
                "group" => "Admin Only"
            ],
            [   "slug" => "administrator.template.mailsms.store",
                "name" => "Mail_and_SMS Template Create",
                "group" => "Admin Only"
            ],
            [   "slug" => "administrator.template.mailsms.edit",
                "name" => "Mail_and_SMS Template Edit",
                "group" => "Admin Only"
            ],
            [   "slug" => "administrator.template.mailsms.update",
                "name" => "Mail_and_SMS Template Edit",
                "group" => "Admin Only"
            ],
            [   "slug" => "administrator.template.mailsms.destroy",
                "name" => "Mail_and_SMS Template Delete",
                "group" => "Admin Only"
            ],
            //mail / sms end
            // idcard template
            [   "slug" => "administrator.template.idcard.index",
                "name" => "Idcard Template View",
                "group" => "Admin Only"
            ],
            [   "slug" => "administrator.template.idcard.create",
                "name" => "Idcard Template Create",
                "group" => "Admin Only"
            ],
            [   "slug" => "administrator.template.idcard.store",
                "name" => "Idcard Template Create",
                "group" => "Admin Only"
            ],
            [   "slug" => "administrator.template.idcard.edit",
                "name" => "Idcard Template Edit",
                "group" => "Admin Only"
            ],
            [   "slug" => "administrator.template.idcard.update",
                "name" => "Idcard Template Edit",
                "group" => "Admin Only"
            ],
            [   "slug" => "administrator.template.idcard.destroy",
                "name" => "Idcard Template Delete",
                "group" => "Admin Only"
            ],
            //idcard end
            //sms gateway
            [   "slug" => "settings.sms_gateway.index",
                "name" => "SMS Gateway View",
                "group" => "Admin Only"
            ],
            [   "slug" => "settings.sms_gateway.create",
                "name" => "SMS Gateway Create",
                "group" => "Admin Only"
            ],
            [   "slug" => "settings.sms_gateway.store",
                "name" => "SMS Gateway Create",
                "group" => "Admin Only"
            ],
            [   "slug" => "settings.sms_gateway.edit",
                "name" => "SMS Gateway Edit",
                "group" => "Admin Only"
            ],
            [   "slug" => "settings.sms_gateway.update",
                "name" => "SMS Gateway Edit",
                "group" => "Admin Only"
            ],
            [   "slug" => "settings.sms_gateway.destroy",
                "name" => "SMS Gateway Delete",
                "group" => "Admin Only"
            ],
            //academic calendar
            [   "slug" => "settings.academic_calendar.index",
                "name" => "Academic Calendar View",
                "group" => "Admin Only"
            ],
            [   "slug" => "settings.academic_calendar.create",
                "name" => "Academic Calendar Create",
                "group" => "Admin Only"
            ],
            [   "slug" => "settings.academic_calendar.store",
                "name" => "Academic Calendar Create",
                "group" => "Admin Only"
            ],
            [   "slug" => "settings.academic_calendar.edit",
                "name" => "Academic Calendar Edit",
                "group" => "Admin Only"
            ],
            [   "slug" => "settings.academic_calendar.update",
                "name" => "Academic Calendar Edit",
                "group" => "Admin Only"
            ],
            [   "slug" => "settings.academic_calendar.destroy",
                "name" => "Academic Calendar Delete",
                "group" => "Admin Only"
            ]
        ];

        $academicPermissionList = [
            [
                "slug" => "academic.class_destroy",
                "name" => "Class Delete",
                "group" => "Academic"
            ],
            [
                "slug" => "academic.class",
                "name" => "Class View",
                "group" => "Academic"
            ],
            [
                "slug" => "academic.class_store",
                "name" => "Class Create",
                "group" => "Academic"
            ],
            [
                "slug" => "academic.class_create",
                "name" => "Class Create",
                "group" => "Academic"
            ],
            [
                "slug" => "academic.class_edit",
                "name" => "Class Edit",
                "group" => "Academic"
            ],
            [
                "slug" => "academic.class_status",
                "name" => "Class Edit",
                "group" => "Academic"
            ],
            [
                "slug" => "academic.class_update",
                "name" => "Class Edit",
                "group" => "Academic"
            ],
            [
                "slug" => "academic.section_destroy",
                "name" => "Section Delete",
                "group" => "Academic"
            ],
            [
                "slug" => "academic.section",
                "name" => "Section View",
                "group" => "Academic"
            ],
            [
                "slug" => "academic.section_store",
                "name" => "Section Create",
                "group" => "Academic"
            ],
            [
                "slug" => "academic.section_create",
                "name" => "Section Create",
                "group" => "Academic"
            ],
            [
                "slug" => "academic.section_edit",
                "name" => "Section Edit",
                "group" => "Academic"
            ],
            [
                "slug" => "academic.section_status",
                "name" => "Section Edit",
                "group" => "Academic"
            ],
            [
                "slug" => "academic.section_update",
                "name" => "Section Edit",
                "group" => "Academic"
            ],
            //subject
            [
                "slug" => "academic.subject_destroy",
                "name" => "Subject Delete",
                "group" => "Academic"
            ],
            [
                "slug" => "academic.subject",
                "name" => "Subject View",
                "group" => "Academic"
            ],
            [
                "slug" => "academic.subject_store",
                "name" => "Subject Create",
                "group" => "Academic"
            ],
            [
                "slug" => "academic.subject_create",
                "name" => "Subject Create",
                "group" => "Academic"
            ],
            [
                "slug" => "academic.subject_edit",
                "name" => "Subject Edit",
                "group" => "Academic"
            ],
            [
                "slug" => "academic.subject_status",
                "name" => "Subject Edit",
                "group" => "Academic"
            ],
            [
                "slug" => "academic.subject_update",
                "name" => "Subject Edit",
                "group" => "Academic"
            ],
            //subject end
            [   "slug" => "student.store",
                "name" => "Student Create",
                "group" => "Academic"
            ],
            [   "slug" => "student.index",
                "name" => "Student View",
                "group" => "Academic"
            ],
            [   "slug" => "student.list_by_fitler",
                "name" => "Student View",
                "group" => "Academic"
            ],
            [   "slug" => "student.create",
                "name" => "Student Create",
                "group" => "Academic"
            ],
            [   "slug" => "student.status",
                "name" => "Student Edit",
                "group" => "Academic"
            ],
            [   "slug" => "student.destroy",
                "name" => "Student Delete",
                "group" => "Academic"
            ],
            [   "slug" => "student.update",
                "name" => "Student Edit",
                "group" => "Academic"
            ],
            [   "slug" => "student.show",
                "name" => "Student View",
                "group" => "Academic"
            ],
            [   "slug" => "student.edit",
                "name" => "Student Edit",
                "group" => "Academic"
            ],
            [   "slug" => "teacher.index",
                "name" => "Teacher View",
                "group" => "Academic"
            ],
            [   "slug" => "teacher.store",
                "name" => "Teacher Create",
                "group" => "Academic"
            ],
            [   "slug" => "teacher.create",
                "name" => "Teacher Create",
                "group" => "Academic"
            ],
            [   "slug" => "teacher.status",
                "name" => "Teacher Edit",
                "group" => "Academic"
            ],
            [   "slug" => "teacher.destroy",
                "name" => "Teacher Delete",
                "group" => "Academic"
            ],
            [   "slug" => "teacher.update",
                "name" => "Teacher Edit",
                "group" => "Academic"
            ],
            [   "slug" => "teacher.show",
                "name" => "Teacher View",
                "group" => "Academic"
            ],
            [   "slug" => "teacher.edit",
                "name" => "Teacher Edit",
                "group" => "Academic"
            ],
            // student attendance
            [   "slug" => "student_attendance.index",
                "name" => "Student Attendance View",
                "group" => "Academic"
            ],
            [   "slug" => "student_attendance.store",
                "name" => "Student Attendance Create",
                "group" => "Academic"
            ],
            [   "slug" => "student_attendance.create",
                "name" => "Student Attendance Create",
                "group" => "Academic"
            ],
            [   "slug" => "student_attendance.status",
                "name" => "Student Attendance Edit",
                "group" => "Academic"
            ],
            [   "slug" => "student_attendance.create_file",
                "name" => "Student Attendance Create",
                "group" => "Academic"
            ],
            [   "slug" => "student_attendance.file_queue_status",
                "name" => "Student Attendance Create",
                "group" => "Academic"
            ],
            //student attendance end

            // Classwork
            [   "slug" => "classwork.index",
                "name" => "Classwork View",
                "group" => "Academic"
            ],
            [   "slug" => "classwork.show",
                "name" => "Classwork View",
                "group" => "Academic"
            ],
            [   "slug" => "classwork.create",
                "name" => "Classwork Create",
                "group" => "Academic"
            ],
            [   "slug" => "classwork.store",
                "name" => "Classwork Create",
                "group" => "Academic"
            ],
            [   "slug" => "classwork.edit",
                "name" => "Classwork Edit",
                "group" => "Academic"
            ],
            [   "slug" => "classwork.update",
                "name" => "Classwork Edit",
                "group" => "Academic"
            ],
            [   "slug" => "classwork.destroy",
                "name" => "Classwork Delete",
                "group" => "Academic"
            ],
            // classwork End

            // Class Topic
            [   "slug" => "topic.index",
                "name" => "Topic View",
                "group" => "Academic"
            ],
            [   "slug" => "topic.show",
                "name" => "Topic View",
                "group" => "Academic"
            ],
            [   "slug" => "topic.create",
                "name" => "Topic Create",
                "group" => "Academic"
            ],
            [   "slug" => "topic.store",
                "name" => "Topic Create",
                "group" => "Academic"
            ],
            [   "slug" => "topic.edit",
                "name" => "Topic Edit",
                "group" => "Academic"
            ],
            [   "slug" => "topic.update",
                "name" => "Topic Edit",
                "group" => "Academic"
            ],
            [   "slug" => "topic.destroy",
                "name" => "Topic Delete",
                "group" => "Academic"
            ],
            // End of Topic

            // Questions

            [   "slug" => "question.index",
                "name" => "Question View",
                "group" => "Academic"
            ],
            [   "slug" => "question.show",
                "name" => "Question View",
                "group" => "Academic"
            ],
            [   "slug" => "question.edit",
                "name" => "Question Edit",
                "group" => "Academic"
            ],
            [   "slug" => "question.update",
                "name" => "Question Edit",
                "group" => "Academic"
            ],
            [   "slug" => "question.create",
                "name" => "Question Create",
                "group" => "Academic"
            ],
            [   "slug" => "question.store",
                "name" => "Question Create",
                "group" => "Academic"
            ],
            [   "slug" => "question.destroy",
                "name" => "Question Delete",
                "group" => "Academic"
            ],

            // Question End

            // Assignment 

            [   "slug" => "assignment.index",
                "name" => "Assignment View",
                "group" => "Academic"
            ],
            [   "slug" => "assignment.show",
                "name" => "Assignment View",
                "group" => "Academic"
            ],
            [   "slug" => "assignment.edit",
                "name" => "Assignment Edit",
                "group" => "Academic"
            ],
            [   "slug" => "assignment.update",
                "name" => "Assignment Edit",
                "group" => "Academic"
            ],
            [   "slug" => "assignment.create",
                "name" => "Assignment Create",
                "group" => "Academic"
            ],
            [   "slug" => "assignment.store",
                "name" => "Assignment Create",
                "group" => "Academic"
            ],
            [   "slug" => "assignment.destroy",
                "name" => "Assignment Delete",
                "group" => "Academic"
            ],

            // collaboration

            [   "slug" => "collaboration.index",
                "name" => "Collaboration View",
                "group" => "Academic"
            ],
            [   "slug" => "collaboration.show",
                "name" => "Collaboration View",
                "group" => "Academic"
            ],
            [   "slug" => "collaboration.create",
                "name" => "Collaboration Create",
                "group" => "Academic"
            ],
            [   "slug" => "collaboration.store",
                "name" => "Collaboration Create",
                "group" => "Academic"
            ],
            [   "slug" => "collaboration.edit",
                "name" => "Collaboration Edit",
                "group" => "Academic"
            ],
            [   "slug" => "collaboration.update",
                "name" => "Collaboration Edit",
                "group" => "Academic"
            ],
            [   "slug" => "collaboration.destroy",
                "name" => "Collaboration Delete",
                "group" => "Academic"
            ],
            // collaboration end

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
            [   "slug" => "quiz_constrains.get",
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
            [   "slug" => "quiz_question.index",
                "name" => "Quiz Question View",
                "group" => "Academic"
            ],
            [   "slug" => "quiz_question.show",
                "name" => "Quiz Question View",
                "group" => "Academic"
            ],
            [   "slug" => "quiz_question.count",
                "name" => "Quiz Question View",
                "group" => "Academic"
            ],
            [   "slug" => "quiz_question_answers.get",
                "name" => "Quiz Question View",
                "group" => "Academic"
            ],
            [   "slug" => "quiz_question.create",
                "name" => "Quiz Question Create",
                "group" => "Academic"
            ],
            [   "slug" => "quiz_question.store",
                "name" => "Quiz Question Create",
                "group" => "Academic"
            ],
            [   "slug" => "quiz_question.edit",
                "name" => "Quiz Question Edit",
                "group" => "Academic"
            ],
            [   "slug" => "quiz_question.update",
                "name" => "Quiz Question Edit",
                "group" => "Academic"
            ],
            [   "slug" => "quiz_question.destroy",
                "name" => "Quiz Question Delete",
                "group" => "Academic"
            ],
            [   "slug" => "quiz_attempt.index",
                "name" => "Quiz Attempt View",
                "group" => "Academic"
            ],
            [   "slug" => "quiz_attempt.show",
                "name" => "Quiz Attempt View",
                "group" => "Academic"
            ],
            [   "slug" => "quiz_attempt_questions.get",
                "name" => "Quiz Attempt View",
                "group" => "Academic"
            ],
            [   "slug" => "quiz_attempt.create",
                "name" => "Quiz Attempt Create",
                "group" => "Academic"
            ],
            [   "slug" => "quiz_attempt.store",
                "name" => "Quiz Attempt Create",
                "group" => "Academic"
            ],
            [   "slug" => "quiz_attempt.edit",
                "name" => "Quiz Attempt Edit",
                "group" => "Academic"
            ],
            [   "slug" => "quiz_attempt.update",
                "name" => "Quiz Attempt Edit",
                "group" => "Academic"
            ],
            [   "slug" => "quiz_attempt.destroy",
                "name" => "Quiz Attempt Delete",
                "group" => "Academic"
            ],

            [   "slug" => "quiz_grade.index",
                "name" => "Quiz Grade View",
                "group" => "Academic"
            ],
            [   "slug" => "quiz_grade.show",
                "name" => "Quiz Grade View",
                "group" => "Academic"
            ],
            [   "slug" => "quiz_grade.create",
                "name" => "Quiz Grade Create",
                "group" => "Academic"
            ],
            [   "slug" => "quiz_grade.store",
                "name" => "Quiz Grade Create",
                "group" => "Academic"
            ],
            [   "slug" => "quiz_grade.edit",
                "name" => "Quiz Grade Edit",
                "group" => "Academic"
            ],
            [   "slug" => "quiz_grade.update",
                "name" => "Quiz Grade Edit",
                "group" => "Academic"
            ],
            [   "slug" => "quiz_grade.destroy",
                "name" => "Quiz Grade Delete",
                "group" => "Academic"
            ],
        ];

        $websitePermissionList = [
            [
                "slug" => "class_profile.index",
                "name" => "Class Profile View",
                "group" => "Website"
            ],
            [
                "slug" => "class_profile.store",
                "name" => "Class Profile Create",
                "group" => "Website"
            ],
            [
                "slug" => "class_profile.create",
                "name" => "Class Profile Create",
                "group" => "Website"
            ],
            [
                "slug" => "class_profile.show",
                "name" => "Class Profile View",
                "group" => "Website"
            ],
            [
                "slug" => "class_profile.update",
                "name" => "Class Profile Edit",
                "group" => "Website"
            ],
            [
                "slug" => "class_profile.destroy",
                "name" => "Class Profile Delete",
                "group" => "Website"
            ],
            [
                "slug" => "class_profile.edit",
                "name" => "Class Profile Edit",
                "group" => "Website"
            ],
            [   "slug" => "event.index",
                "name" => "Event View",
                "group" => "Website"
            ],
            [   "slug" => "event.store",
                "name" => "Event Create",
                "group" => "Website"
            ],
            [   "slug" => "event.create",
                "name" => "Event Create",
                "group" => "Website"
            ],
            [   "slug" => "event.destroy",
                "name" => "Event Delete",
                "group" => "Website"
            ],
            [   "slug" => "event.show",
                "name" => "Event View",
                "group" => "Website"
            ],
            [   "slug" => "event.update",
                "name" => "Event Edit",
                "group" => "Website"
            ],
            [   "slug" => "event.edit",
                "name" => "Event Edit",
                "group" => "Website"
            ],
            [   "slug" => "teacher_profile.index",
                "name" => "Teacher Profile View",
                "group" => "Website"
            ],
            [   "slug" => "teacher_profile.store",
                "name" => "Teacher Profile Create",
                "group" => "Website"
            ],
            [   "slug" => "teacher_profile.create",
                "name" => "Teacher Profile Create",
                "group" => "Website"
            ],
            [   "slug" => "teacher_profile.update",
                "name" => "Teacher Profile Edit",
                "group" => "Website"
            ],
            [   "slug" => "teacher_profile.show",
                "name" => "Teacher Profile View",
                "group" => "Website"
            ],
            [   "slug" => "teacher_profile.destroy",
                "name" => "Teacher Profile Delete",
                "group" => "Website"
            ],
            [   "slug" => "teacher_profile.edit",
                "name" => "Teacher Profile Edit",
                "group" => "Website"
            ],
            [   "slug" => "site.about_content",
                "name" => "Site About Content Edit",
                "group" => "Website"
            ],
            [   "slug" => "site.about_content",
                "name" => "Site About Content Edit",
                "group" => "Website"
            ],
            [   "slug" => "site.about_content_image",
                "name" => "Site About Content Edit",
                "group" => "Website"
            ],
            [   "slug" => "site.about_content_image",
                "name" => "Site About Content Edit",
                "group" => "Website"
            ],
            [   "slug" => "site.about_content_image_delete",
                "name" => "Site About Content Delete",
                "group" => "Website"
            ],
            [   "slug" => "site.analytics",
                "name" => "Site Analytics Setting Edit",
                "group" => "Website"
            ],
            [   "slug" => "site.analytics",
                "name" => "Site Analytics Setting Edit",
                "group" => "Website"
            ],
            [   "slug" => "site.contact_us",
                "name" => "Site Contact Us Edit",
                "group" => "Website"
            ],
            [   "slug" => "site.contact_us",
                "name" => "Site Contact Us Edit",
                "group" => "Website"
            ],
            [   "slug" => "site.dashboard",
                "name" => "Site Dashboard View",
                "group" => "Website"
            ],
            [   "slug" => "site.faq_delete",
                "name" => "Site FAQ Delete",
                "group" => "Website"
            ],
            [   "slug" => "site.faq",
                "name" => "Site FAQ Create",
                "group" => "Website"
            ],
            [   "slug" => "site.faq",
                "name" => "Site FAQ Create",
                "group" => "Website"
            ],
            [   "slug" => "site.gallery",
                "name" => "Site Gallery View",
                "group" => "Website"
            ],
            [   "slug" => "site.gallery_image",
                "name" => "Site Gallery Create",
                "group" => "Website"
            ],
            [   "slug" => "site.gallery_image",
                "name" => "Site Gallery Create",
                "group" => "Website"
            ],
            [   "slug" => "site.gallery_image_delete",
                "name" => "Site Gallery Delete",
                "group" => "Website"
            ],
            [   "slug" => "site.service",
                "name" => "Site Service Edit",
                "group" => "Website"
            ],
            [   "slug" => "site.service",
                "name" => "Site Service Edit",
                "group" => "Website"
            ],
            [   "slug" => "site.settings",
                "name" => "Site Settings Edit",
                "group" => "Website"
            ],
            [   "slug" => "site.settings",
                "name" => "Site Settings Edit",
                "group" => "Website"
            ],
            [   "slug" => "site.statistic",
                "name" => "Site Statistic Edit",
                "group" => "Website"
            ],
            [   "slug" => "site.statistic",
                "name" => "Site Statistic Edit",
                "group" => "Website"
            ],
            [   "slug" => "site.subscribe",
                "name" => "Site Subscriber View",
                "group" => "Website"
            ],
            [   "slug" => "site.testimonial",
                "name" => "Site Testimonial View",
                "group" => "Website"
            ],
            [   "slug" => "site.testimonial_delete",
                "name" => "Site Testimonial Delete",
                "group" => "Website"
            ],
            [   "slug" => "site.testimonial_create",
                "name" => "Site Testimonial Create",
                "group" => "Website"
            ],
            [   "slug" => "site.testimonial_create",
                "name" => "Site Testimonial Create",
                "group" => "Website"
            ],
            [   "slug" => "site.timeline",
                "name" => "Site Timeline Create",
                "group" => "Website"
            ],
            [   "slug" => "site.timeline",
                "name" => "Site Timeline Create",
                "group" => "Website"
            ],
            [   "slug" => "site.timeline_delete",
                "name" => "Site Timeline Delete",
                "group" => "Website"
            ],
            [   "slug" => "slider.index",
                "name" => "Slider View",
                "group" => "Website"
            ],
            [   "slug" => "slider.store",
                "name" => "Slider Create",
                "group" => "Website"
            ],
            [   "slug" => "slider.create",
                "name" => "Slider Create",
                "group" => "Website"
            ],
            [   "slug" => "slider.destroy",
                "name" => "Slider Delete",
                "group" => "Website"
            ],
            [   "slug" => "slider.update",
                "name" => "Slider Edit",
                "group" => "Website"
            ],
            [   "slug" => "slider.show",
                "name" => "Slider View",
                "group" => "Website"
            ],
            [   "slug" => "slider.edit",
                "name" => "Slider Edit",
                "group" => "Website"
            ]
        ];

        $hrmPermissionList = [
            // Employee
            [   "slug" => "hrm.employee.index",
                "name" => "Employee View",
                "group" => "HRM"
            ],
            [   "slug" => "hrm.employee.store",
                "name" => "Employee Create",
                "group" => "HRM"
            ],
            [   "slug" => "hrm.employee.create",
                "name" => "Employee Create",
                "group" => "HRM"
            ],
            [   "slug" => "hrm.employee.status",
                "name" => "Employee Edit",
                "group" => "HRM"
            ],
            [   "slug" => "hrm.employee.destroy",
                "name" => "Employee Delete",
                "group" => "HRM"
            ],
            [   "slug" => "hrm.employee.update",
                "name" => "Employee Edit",
                "group" => "HRM"
            ],
            [   "slug" => "hrm.employee.show",
                "name" => "Employee View",
                "group" => "HRM"
            ],
            [   "slug" => "hrm.employee.edit",
                "name" => "Employee Edit",
                "group" => "HRM"
            ],
            // Employee
            // Leave
            [   "slug" => "hrm.leave.index",
                "name" => "Leave View",
                "group" => "HRM"
            ],
            [   "slug" => "hrm.leave.store",
                "name" => "Leave Create",
                "group" => "HRM"
            ],
            [   "slug" => "hrm.leave.create",
                "name" => "Leave Create",
                "group" => "HRM"
            ],
            [   "slug" => "hrm.leave.destroy",
                "name" => "Leave Delete",
                "group" => "HRM"
            ],
            [   "slug" => "hrm.leave.update",
                "name" => "Leave Edit",
                "group" => "HRM"
            ],
            [   "slug" => "hrm.leave.show",
                "name" => "Leave View",
                "group" => "HRM"
            ],
            [   "slug" => "hrm.leave.edit",
                "name" => "Leave Edit",
                "group" => "HRM"
            ],
            // Leave
            // Policy
            [   "slug" => "hrm.policy",
                "name" => "Policy View",
                "group" => "HRM"
            ],
            [   "slug" => "hrm.policy",
                "name" => "Policy Create",
                "group" => "HRM"
            ],
            // Policy
            // Work Outside
            [   "slug" => "hrm.work_outside.index",
                "name" => "Work Outside View",
                "group" => "HRM"
            ],
            [   "slug" => "hrm.work_outside.store",
                "name" => "Work Outside Create",
                "group" => "HRM"
            ],
            [   "slug" => "hrm.work_outside.create",
                "name" => "Work Outside Create",
                "group" => "HRM"
            ],
            [   "slug" => "hrm.work_outside.destroy",
                "name" => "Work Outside Delete",
                "group" => "HRM"
            ],
            [   "slug" => "hrm.work_outside.update",
                "name" => "Work Outside Edit",
                "group" => "HRM"
            ],
            [   "slug" => "hrm.work_outside.show",
                "name" => "Work Outside View",
                "group" => "HRM"
            ],
            [   "slug" => "hrm.work_outside.edit",
                "name" => "Work Outside Edit",
                "group" => "HRM"
            ],
            // Work Outside
            // employee attendance
            [   "slug" => "employee_attendance.index",
                "name" => "Employee Attendance View",
                "group" => "HRM"
            ],
            [   "slug" => "employee_attendance.store",
                "name" => "Employee Attendance Create",
                "group" => "HRM"
            ],
            [   "slug" => "employee_attendance.create",
                "name" => "Employee Attendance Create",
                "group" => "HRM"
            ],
            [   "slug" => "employee_attendance.status",
                "name" => "Employee Attendance Edit",
                "group" => "HRM"
            ],
            [   "slug" => "employee_attendance.create_file",
                "name" => "Employee Attendance Create",
                "group" => "HRM"
            ],
            [   "slug" => "employee_attendance.file_queue_status",
                "name" => "Employee Attendance Create",
                "group" => "HRM"
            ],
            //employee attendance end
        ];

        $examPermissionList = [
            // Exam
            [   "slug" => "exam.index",
                "name" => "Exam View",
                "group" => "Exam"
            ],
            [   "slug" => "exam.create",
                "name" => "Exam Create",
                "group" => "Exam"
            ],
            [   "slug" => "exam.store",
                "name" => "Exam Create",
                "group" => "Exam"
            ],
            [   "slug" => "exam.edit",
                "name" => "Exam Edit",
                "group" => "Exam"
            ],
            [   "slug" => "exam.update",
                "name" => "Exam Edit",
                "group" => "Exam"
            ],
            [   "slug" => "exam.status",
                "name" => "Exam Edit",
                "group" => "Exam"
            ],
            [   "slug" => "exam.destroy",
                "name" => "Exam Delete",
                "group" => "Exam"
            ],
            // Exam End
            // Grade
            [   "slug" => "exam.grade.index",
                "name" => "Grade View",
                "group" => "Exam"
            ],
            [   "slug" => "exam.grade.create",
                "name" => "Grade Create",
                "group" => "Exam"
            ],
            [   "slug" => "exam.grade.store",
                "name" => "Grade Create",
                "group" => "Exam"
            ],
            [   "slug" => "exam.grade.edit",
                "name" => "Grade Edit",
                "group" => "Exam"
            ],
            [   "slug" => "exam.grade.update",
                "name" => "Grade Edit",
                "group" => "Exam"
            ],
            [   "slug" => "exam.grade.destroy",
                "name" => "Grade Delete",
                "group" => "Exam"
            ],
            // Grade End
            // Exam rule
            [   "slug" => "exam.rule.index",
                "name" => "Exam Rule View",
                "group" => "Exam"
            ],
            [   "slug" => "exam.rule.create",
                "name" => "Exam Rule Create",
                "group" => "Exam"
            ],
            [   "slug" => "exam.rule.store",
                "name" => "Exam Rule Create",
                "group" => "Exam"
            ],
            [   "slug" => "exam.rule.edit",
                "name" => "Exam Rule Edit",
                "group" => "Exam"
            ],
            [   "slug" => "exam.rule.update",
                "name" => "Exam Rule Edit",
                "group" => "Exam"
            ],
            [   "slug" => "exam.rule.destroy",
                "name" => "Exam Rule Delete",
                "group" => "Exam"
            ],
            // Exam rule End
            // Exam Marks
            [   "slug" => "marks.index",
                "name" => "Marks View",
                "group" => "Exam"
            ],
            [   "slug" => "marks.create",
                "name" => "Marks Create",
                "group" => "Exam"
            ],
            [   "slug" => "marks.store",
                "name" => "Marks Create",
                "group" => "Exam"
            ],
            [   "slug" => "marks.edit",
                "name" => "Marks Edit",
                "group" => "Exam"
            ],
            [   "slug" => "marks.update",
                "name" => "Marks Edit",
                "group" => "Exam"
            ],
            // Exam Marks End
            // Exam Result
            [   "slug" => "result.index",
                "name" => "Result View",
                "group" => "Exam"
            ],
            [   "slug" => "result.create",
                "name" => "Result Create",
                "group" => "Exam"
            ],
            [   "slug" => "result.delete",
                "name" => "Result Delete",
                "group" => "Exam"
            ],
            // Exam Result End
        ];


        $reportsPermissionList = [
            // Report
            [
                "slug" => "report.student_monthly_attendance",
                "name" => "Student Monthly Attendance View",
                "group" => "Report"
            ],
            [
                "slug" => "report.student_list",
                "name" => "Student List View",
                "group" => "Report"
            ],
            [
                "slug" => "report.employee_list",
                "name" => "Employee List View",
                "group" => "Report"
            ],
            [
            "slug" => "report.employee_monthly_attendance",
            "name" => "Employee Monthly Attendance View",
            "group" => "Report"
        ],
            // Report
        ];

        //merge all permissions and insert into db
        $permissions = array_merge($commonPermissionList, $administratorPermissionList, $onlyAdminPermissions,
            $academicPermissionList, $websitePermissionList, $hrmPermissionList, $examPermissionList, $reportsPermissionList);

        echo PHP_EOL , 'seeding permissions...';

        Permission::insert($permissions);


        echo PHP_EOL , 'seeding role permissions...', PHP_EOL;
        //now add admin role permissions
        $admin = Role::where('name', 'admin')->first();
        $permissions = Permission::get();
        $admin->permissions()->saveMany($permissions);

        //now add other roles common permissions
        $slugs = array_map(function ($permission){
            return $permission['slug'];
        }, $commonPermissionList);

        $permissions = Permission::whereIn('slug', $slugs)->get();

        $roles = Role::where('name', '!=', 'admin')->get();
        foreach ($roles as $role){
            echo 'seeding '.$role->name.' permissions...', PHP_EOL;
            $role->permissions()->saveMany($permissions);
        }
    }
}
