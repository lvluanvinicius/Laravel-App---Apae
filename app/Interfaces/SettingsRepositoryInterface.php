<?php


namespace App\Interfaces;


interface SettingsRepositoryInterface
{
    public static function getSetting(string $setting): string|null;
    public static function updateMailServer(string $key, string $value): \App\Models\Settings;
}