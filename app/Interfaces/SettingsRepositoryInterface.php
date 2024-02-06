<?php


namespace App\Interfaces;


interface SettingsRepositoryInterface
{
    public static function getSetting(string $setting): string|null;
}