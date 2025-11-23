<?php

namespace App\Enums;

enum StatusEnum: string
{
    case NEW = 'new';
    case IN_PROGRESS = 'in_progress';
    case PROCESSED = 'processed';
}
