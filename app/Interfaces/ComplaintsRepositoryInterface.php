<?php


namespace App\Interfaces;


interface ComplaintsRepositoryInterface
{
    public static function register(array $attr): \App\Models\Complaints;
    public static function sendMail(array $data): bool;
}