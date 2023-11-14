<?php

namespace app\Data\Enums;

enum MediaTypeEnum: string
{
    case IMAGE = 'image';
    case AUDIO = 'audio';
    case VIDEO = 'video';
    case DOCUMENT = 'document';

    public static function toArray(): array
    {
        return [
            self::IMAGE->value,
            self::DOCUMENT->value,
            self::AUDIO->value,
            self::VIDEO->value,
        ];
    }
}
