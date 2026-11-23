<?php

declare(strict_types=1);

enum Lang: string
{
    case En = 'en';
    case Zh = 'zh';

    public static function fromQuery(?string $value): self
    {
        return self::tryFrom(strtolower(trim((string) $value))) ?? self::En;
    }

    public function other(): self
    {
        return match ($this) {
            self::En => self::Zh,
            self::Zh => self::En,
        };
    }

    public function htmlLang(): string
    {
        return match ($this) {
            self::En => 'en',
            self::Zh => 'zh-Hant',
        };
    }
}
