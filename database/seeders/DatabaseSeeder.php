<?php

namespace Database\Seeders;

use Database\Seeders\Components\AccountSeeder;
use Database\Seeders\Components\ContentsSeeder;
use Database\Seeders\Components\SitesSeeder;
use Illuminate\Database\Seeder;

final class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(SitesSeeder::class);
        $this->call(AccountSeeder::class);
        $this->call(ContentsSeeder::class);
    }
}
