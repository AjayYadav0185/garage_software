<?php

namespace App\Enums;

enum BrakeSystem: string
{
    case DISC = 'Disc';
    case DRUM = 'Drum';
    case ANTI_LOCK = 'Anti-Lock';
}
