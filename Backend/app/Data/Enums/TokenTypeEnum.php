<?php

namespace app\Data\Enums;

enum TokenTypeEnum: string
{
    case API_TOKEN = 'api-token';
    case REFRESH_TOKEN = 'refresh-token';
}
