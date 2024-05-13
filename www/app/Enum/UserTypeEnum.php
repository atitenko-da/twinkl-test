<?php

namespace App\Enum;

enum UserTypeEnum:string
{
    case STUDENT = 'student';
    case TEACHER = 'teacher';
    case PARENT = 'parent';
    case TUTOR = 'tutor';
}
