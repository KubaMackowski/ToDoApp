<?php

namespace App\Enums;

enum TaskStatus: string
{
    case TODO = 'to-do';
    case IN_PROGRESS = 'in progress';
    case DONE = 'done';
}
