<?php

namespace App\Enums;

enum FuelType: string
{
    case PETROL = 'Petrol';
    case DIESEL = 'Diesel';
    case ELECTRIC = 'Electric';
    case HYBRID = 'Hybrid';
    case LPG = 'LPG';
    case CNG = 'CNG';
}
