<?php

namespace App\Enums;

enum PreviewPrivacyTypeEnum: string
{

    case PUBLIC = 'public';
    case PRIVATE = 'private';
    case FOLLOWERS = 'followers';


    public static function toArray(): array
    {
        return [
            self::PUBLIC->value,
            self::PRIVATE->value,
            self::FOLLOWERS->value
        ];
    }

}
