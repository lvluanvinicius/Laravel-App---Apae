<?php

namespace Database\Seeders;

use App\Models\Settings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                "setting_name"      => "application_partners_extensions",
                "setting_value"     => serialize(["webp"]),
                "setting_type"      => "extensions",
            ],
            [
                "setting_name"      => "application_partners_path",
                "setting_value"     => "/home/luan/Laravel-App-Apae/resources/images/partners",
                "setting_type"      => "path",
            ],
            [
                "setting_name"      => "application_gallery_extensions",
                "setting_value"     => serialize(["webp", "jpg", "jpeg", "png"]),
                "setting_type"      => "extensions",
            ],
            [
                "setting_name"      => "application_gallery_path",
                "setting_value"     => "/home/luan/Laravel-App-Apae/resources/images/photo-galery",
                "setting_type"      => "path",
            ],
            [
                "setting_name"      => "application_transparency_extensions",
                "setting_value"     => serialize(["pdf"]),
                "setting_type"      => "extensions",
            ],
            [
                "setting_name"      => "application_sliders_extensions",
                "setting_value"     => serialize(["webp"]),
                "setting_type"      => "extensions",
            ],
            [
                "setting_name"      => "application_sliders_path",
                "setting_value"     => "/home/luan/Laravel-App-Apae/resources/images/sliders",
                "setting_type"      => "path",
            ],
        ];

        array_filter($settings, function ($stg) {
            Settings::create($stg);
        });
    }
}