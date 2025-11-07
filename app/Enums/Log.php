<?php

namespace App\Enums;

enum Log: string
{
    case CREATE = 'creating';
    case UPDATE = 'updating';
    case DELETE = 'deleting';
}
