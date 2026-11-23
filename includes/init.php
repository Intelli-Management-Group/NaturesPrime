<?php

declare(strict_types=1);

require_once __DIR__ . '/Lang.php';

if (!function_exists('e')) {
    /**
     * Escape a string for safe HTML output.
     */
    function e(?string $value): string
    {
        return htmlspecialchars($value ?? '', ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
}

if (!function_exists('asset')) {
    /**
     * Build a web path to a file under the assets directory.
     */
    function asset(string $path): string
    {
        return 'assets/' . ltrim($path, '/');
    }
}

if (!function_exists('lines')) {
    /**
     * Render an array of text lines as escaped HTML separated by <br>.
     *
     * @param array<int, string> $items
     */
    function lines(array $items): string
    {
        return implode('<br>', array_map(static fn (string $line): string => e($line), $items));
    }
}

if (!function_exists('tel_href')) {
    /**
     * Convert a phone number into a tel: href value.
     */
    function tel_href(string $phone): string
    {
        $normalized = preg_replace('/[^\d+]/', '', $phone) ?? '';

        return 'tel:' . $normalized;
    }
}

if (!function_exists('translations')) {
    /**
     * Load translations for the given language.
     *
     * @return array<string, mixed>
     */
    function translations(Lang $lang): array
    {
        $file = __DIR__ . '/lang/' . $lang->value . '.php';
        if (!is_file($file)) {
            $file = __DIR__ . '/lang/en.php';
        }

        /** @var array<string, mixed> $data */
        $data = require $file;

        return $data;
    }
}

return require __DIR__ . '/config.php';
