<?php

namespace App\Enums;

enum Transmission: string
{
    case MANUAL = 'Manual';
    case AUTOMATIC = 'Automatic';
    case SEMI_AUTOMATIC = 'Semi-Automatic';
}
