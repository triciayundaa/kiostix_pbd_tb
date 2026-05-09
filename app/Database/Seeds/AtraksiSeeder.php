<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AtraksiSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();
        
        // Define some categories
        $categoriesData = ['Attraction', 'Adventure', 'Culture', 'Nature', 'Entertainment'];
        $categories = [];
        foreach ($categoriesData as $cat) {
            $existing = $db->table('category')->where('title', $cat)->get()->getRow();
            if ($existing) {
                $categories[$cat] = $existing->id;
            } else {
                $id = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
                $db->table('category')->insert([
                    'id' => $id,
                    'title' => $cat
                ]);
                $categories[$cat] = $id;
            }
        }

        // Define countries and cities
        $locations = [
            'Indonesia' => ['Bali', 'Lombok', 'Jakarta', 'Yogyakarta', 'Bandung'],
            'Singapura' => ['Sentosa', 'Marina Bay'],
            'Jepang' => ['Tokyo', 'Osaka', 'Kyoto'],
            'Mancanegara' => ['Los Angeles', 'Orlando', 'San Diego'] // Added Mancanegara locations
        ];
        
        $cities = []; // City name => ID
        $countries = []; // Country name => ID
        
        foreach ($locations as $countryName => $cityNames) {
            $existingCountry = $db->table('country')->where('name', $countryName)->get()->getRow();
            if ($existingCountry) {
                $countryId = $existingCountry->id;
            } else {
                $countryId = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
                $db->table('country')->insert([
                    'id' => $countryId,
                    'name' => $countryName
                ]);
            }
            $countries[$countryName] = $countryId;
            
            foreach ($cityNames as $cityName) {
                $existingCity = $db->table('city')->where('name', $cityName)->get()->getRow();
                if ($existingCity) {
                    $cities[$cityName] = ['id' => $existingCity->id, 'country_id' => $countryId];
                } else {
                    $cityId = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
                    $db->table('city')->insert([
                        'id' => $cityId,
                        'name' => $cityName,
                        'country_id' => $countryId
                    ]);
                    $cities[$cityName] = ['id' => $cityId, 'country_id' => $countryId];
                }
            }
        }
        
        // Let's truncate atraksi table to start fresh
        // Since sqlite/mysql might have foreign key constraints, we will just delete all instead of truncate.
        // Wait, order_item references atraksi.id but since it's dev, it's probably okay to delete.
        // $db->table('atraksi')->emptyTable();
        // Just delete atraksi items that have dummy slugs to prevent duplicates
        // We will just clear atraksi to be safe and put 20 new ones.
        $db->table('atraksi')->emptyTable();

        $images = [
            'https://picsum.photos/id/10/600/400',
            'https://picsum.photos/id/11/600/400',
            'https://picsum.photos/id/12/600/400',
            'https://picsum.photos/id/13/600/400',
            'https://picsum.photos/id/14/600/400',
            'https://picsum.photos/id/15/600/400',
            'https://picsum.photos/id/16/600/400',
            'https://picsum.photos/id/17/600/400',
            'https://picsum.photos/id/18/600/400',
            'https://picsum.photos/id/28/600/400',
            'https://picsum.photos/id/29/600/400',
            'https://picsum.photos/id/49/600/400',
            'https://picsum.photos/id/54/600/400',
            'https://picsum.photos/id/57/600/400',
            'https://picsum.photos/id/58/600/400',
            'https://picsum.photos/id/59/600/400',
            'https://picsum.photos/id/65/600/400',
            'https://picsum.photos/id/74/600/400',
            'https://picsum.photos/id/88/600/400',
            'https://picsum.photos/id/104/600/400',
            'https://picsum.photos/id/119/600/400'
        ];

        $atraksiList = [
            ['title' => 'Bali Safari & Marine Park', 'city' => 'Bali', 'cat' => 'Adventure', 'price' => 250000],
            ['title' => 'Garuda Wisnu Kencana (GWK)', 'city' => 'Bali', 'cat' => 'Culture', 'price' => 125000],
            ['title' => 'Waterbom Bali', 'city' => 'Bali', 'cat' => 'Entertainment', 'price' => 300000],
            ['title' => 'Candi Borobudur Tour', 'city' => 'Yogyakarta', 'cat' => 'Culture', 'price' => 150000],
            ['title' => 'Taman Pintar Yogyakarta', 'city' => 'Yogyakarta', 'cat' => 'Entertainment', 'price' => 75000],
            ['title' => 'Trans Studio Bandung', 'city' => 'Bandung', 'cat' => 'Adventure', 'price' => 200000],
            ['title' => 'Kawah Putih Ciwidey', 'city' => 'Bandung', 'cat' => 'Nature', 'price' => 50000],
            ['title' => 'Dunia Fantasi (Dufan)', 'city' => 'Jakarta', 'cat' => 'Adventure', 'price' => 225000],
            ['title' => 'Seaworld Ancol', 'city' => 'Jakarta', 'cat' => 'Attraction', 'price' => 110000],
            ['title' => 'Universal Studios Singapore', 'city' => 'Sentosa', 'cat' => 'Adventure', 'price' => 950000],
            ['title' => 'Gardens by the Bay', 'city' => 'Marina Bay', 'cat' => 'Nature', 'price' => 350000],
            ['title' => 'S.E.A. Aquarium', 'city' => 'Sentosa', 'cat' => 'Attraction', 'price' => 450000],
            ['title' => 'Tokyo Disneyland', 'city' => 'Tokyo', 'cat' => 'Entertainment', 'price' => 1200000],
            ['title' => 'Universal Studios Japan', 'city' => 'Osaka', 'cat' => 'Adventure', 'price' => 1150000],
            ['title' => 'Fushimi Inari Shrine Tour', 'city' => 'Kyoto', 'cat' => 'Culture', 'price' => 350000],
            ['title' => 'Mount Fuji Day Trip', 'city' => 'Tokyo', 'cat' => 'Nature', 'price' => 850000],
            ['title' => 'Gili Trawangan Snorkeling', 'city' => 'Lombok', 'cat' => 'Adventure', 'price' => 150000],
            ['title' => 'Rinjani Trekking 2 Days', 'city' => 'Lombok', 'cat' => 'Nature', 'price' => 750000],
            ['title' => 'The Queen Mary Ticket', 'city' => 'Los Angeles', 'cat' => 'Attraction', 'price' => 621064],
            ['title' => 'Universal Orlando Resort Ticket', 'city' => 'Orlando', 'cat' => 'Adventure', 'price' => 5276376],
            ['title' => 'San Diego Zoo Safari Park', 'city' => 'San Diego', 'cat' => 'Nature', 'price' => 1965040]
        ];

        foreach ($atraksiList as $idx => $item) {
            $id = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $item['title'])));
            $imageUrl = $images[$idx % count($images)];
            
            $cityData = $cities[$item['city']];
            
            $db->table('atraksi')->insert([
                'id' => $id,
                'title' => $item['title'],
                'slug' => $slug,
                'banner_image' => $imageUrl,
                'price' => $item['price'],
                'status' => 'Active',
                'category_id' => $categories[$item['cat']],
                'city_id' => $cityData['id'],
                'country_id' => $cityData['country_id']
            ]);
        }
    }
}
