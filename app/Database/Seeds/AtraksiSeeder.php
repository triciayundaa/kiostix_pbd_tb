<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AtraksiSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        
        // 1. Countries
        $countries = [
            ['id' => 'c1', 'name' => 'USA'],
            ['id' => 'c2', 'name' => 'Indonesia'],
            ['id' => 'c3', 'name' => 'Singapore'],
            ['id' => 'c4', 'name' => 'Malaysia']
        ];
        foreach ($countries as $c) {
            $db->table('country')->ignore(true)->insert($c);
        }

        // 2. Cities
        $cities = [
            ['id' => 'ct1', 'name' => 'Los Angeles', 'country_id' => 'c1'],
            ['id' => 'ct2', 'name' => 'Orlando', 'country_id' => 'c1'],
            ['id' => 'ct3', 'name' => 'Bali', 'country_id' => 'c2'],
            ['id' => 'ct4', 'name' => 'Singapore', 'country_id' => 'c3'],
            ['id' => 'ct5', 'name' => 'Kuala Lumpur', 'country_id' => 'c4'],
        ];
        foreach ($cities as $ct) {
            $db->table('city')->ignore(true)->insert($ct);
        }

        // 3. Categories
        $categories = [
            ['id' => 'cat1', 'title' => 'Attraction'],
            ['id' => 'cat2', 'title' => 'Adventure'],
            ['id' => 'cat3', 'title' => 'Transport'],
            ['id' => 'cat4', 'title' => 'Eat & Drink'],
            ['id' => 'cat5', 'title' => 'Shopping'],
        ];
        foreach ($categories as $cat) {
            $db->table('category')->ignore(true)->insert($cat);
        }

        // 4. Atraksi
        $atraksi = [
            [
                'id' => 'a1',
                'title' => 'The Queen Mary Ticket',
                'slug' => 'the-queen-mary-ticket',
                'banner_image' => 'https://images.unsplash.com/photo-1542359649-31e03cd4d909?q=80&w=600&auto=format&fit=crop',
                'price' => 621064.00,
                'status' => 'Available',
                'category_id' => 'cat1',
                'city_id' => 'ct1',
                'country_id' => 'c1'
            ],
            [
                'id' => 'a2',
                'title' => 'Universal Orlando Resort Ticket',
                'slug' => 'universal-orlando-resort',
                'banner_image' => 'https://images.unsplash.com/photo-1505159940484-eb2b9f2588e2?q=80&w=600&auto=format&fit=crop',
                'price' => 5276376.00,
                'status' => 'Available',
                'category_id' => 'cat2',
                'city_id' => 'ct2',
                'country_id' => 'c1'
            ],
            [
                'id' => 'a3',
                'title' => 'Gardens by the Bay',
                'slug' => 'gardens-by-the-bay',
                'banner_image' => 'https://images.unsplash.com/photo-1583417319070-4a69db38a482?q=80&w=600&auto=format&fit=crop',
                'price' => 111360.00,
                'status' => 'Available',
                'category_id' => 'cat1',
                'city_id' => 'ct4',
                'country_id' => 'c3'
            ],
            [
                'id' => 'a4',
                'title' => 'Bali Safari and Marine Park Ticket',
                'slug' => 'bali-safari-marine-park',
                'banner_image' => 'https://images.unsplash.com/photo-1537996194471-e657df975ab4?q=80&w=600&auto=format&fit=crop',
                'price' => 450000.00,
                'status' => 'Available',
                'category_id' => 'cat2',
                'city_id' => 'ct3',
                'country_id' => 'c2'
            ]
        ];

        foreach ($atraksi as $a) {
            $db->table('atraksi')->ignore(true)->insert($a);
        }
    }
}
