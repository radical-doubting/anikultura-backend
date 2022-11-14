<?php

namespace App\Enums;

enum InsightsMode: string
{
    case MODEL_CREATE = 'create';
    case MODEL_SAVE = 'save';
    case NONE = 'none';
}
