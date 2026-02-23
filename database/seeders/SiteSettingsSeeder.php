<?php

namespace Database\Seeders;

use App\Models\ContactPerson;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingsSeeder extends Seeder
{
    public function run(): void
    {
        // Seed site settings (single row)
        SiteSetting::updateOrCreate([], [
            'address'        => 'Arriva building, Bombo Road, Kampala - Uganda',
            'email'          => 'info@joinwomeninfilm.org',
            'business_hours' => 'Monday - Friday, 08am - 05pm',
            'instagram_url'  => 'https://www.instagram.com/womeninfilmug/',
            'twitter_url'    => 'https://x.com/WomenInFilmUg',
            'linkedin_url'   => 'https://www.linkedin.com/showcase/women-in-film-organisation/posts/?feedView=all',
            'tiktok_url'     => '',
            'facebook_url'   => '',
        ]);

        // Seed contact persons
        $contacts = [
            ['name' => 'Rujema Mutesi',      'phone' => '+256 784 084218', 'role' => 'Project Lead',      'order' => 1],
            ['name' => 'Jesca Ahimbisibwe', 'phone' => '+256 705 098317', 'role' => 'Director',           'order' => 2],
            ['name' => 'Theos Barham',       'phone' => '+256 776 761554', 'role' => 'Ass Project Lead',  'order' => 3],
        ];

        foreach ($contacts as $contact) {
            ContactPerson::updateOrCreate(
                ['name' => $contact['name']],
                array_merge($contact, ['is_active' => true])
            );
        }
    }
}
