<?php

namespace App\Controllers;

use App\Models\EventModel;

class Event extends BaseController
{
    public function index()
    {
        $search = $this->request->getGet('search');
        $date = $this->request->getGet('date');
        $sort = $this->request->getGet('sort') ?? 'terbaru';

        // Mock data to match homepage and screenshots exactly
        $allEvents = [
            [
                'title' => 'TERAS 2026',
                'slug' => 'teras-2026',
                'location' => 'Jakarta Pusat',
                'date_str' => '29 Agt 26',
                'date_val' => '2026-08-29',
                'price_str' => 'Rp. 95.000',
                'price_val' => 95000,
                'image' => 'https://images.unsplash.com/photo-1459749411175-04bf5292ceea?q=80&w=600&auto=format&fit=crop',
                'status' => 'Tiket Tersedia'
            ],
            [
                'title' => 'REGENT CUP',
                'slug' => 'regent-cup',
                'location' => 'Jakarta Timur',
                'date_str' => '08 - 17 Mei 26',
                'date_val' => '2026-05-08',
                'price_str' => 'Rp. 15.000',
                'price_val' => 15000,
                'image' => 'https://images.unsplash.com/photo-1514525253161-7a46d19cd819?q=80&w=600&auto=format&fit=crop',
                'status' => 'Tiket Tersedia'
            ],
            [
                'title' => 'REGENT OF SKY 2',
                'slug' => 'regent-of-sky-2',
                'location' => 'Jakarta Timur',
                'date_str' => '20 Jun 26',
                'date_val' => '2026-06-20',
                'price_str' => 'Rp. 100.000',
                'price_val' => 100000,
                'image' => 'https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?q=80&w=600&auto=format&fit=crop',
                'status' => 'Tiket Tersedia'
            ],
            [
                'title' => 'Kompilasik',
                'slug' => 'kompilasik',
                'location' => 'NTB',
                'date_str' => '21 Jun 26',
                'date_val' => '2026-06-21',
                'price_str' => 'Rp. 64.000',
                'price_val' => 64000,
                'image' => 'https://images.unsplash.com/photo-1501281668745-f7f57925c3b4?q=80&w=600&auto=format&fit=crop',
                'status' => 'Tiket Tersedia'
            ],
            [
                'title' => 'QNF CHAPTER 5.0',
                'slug' => 'qnf-chapter-5',
                'location' => 'Karawang',
                'date_str' => '11 Okt 26',
                'date_val' => '2026-10-11',
                'price_str' => 'Rp. 150.000',
                'price_val' => 150000,
                'image' => 'https://images.unsplash.com/photo-1551698618-1dfe5d97d256?q=80&w=600&auto=format&fit=crop',
                'status' => 'Tiket Tersedia'
            ],
            [
                'title' => 'Dalawampu',
                'slug' => 'dalawampu',
                'location' => 'Jawa Barat',
                'date_str' => '11 Jul 26',
                'date_val' => '2026-07-11',
                'price_str' => 'Rp. 150.000',
                'price_val' => 150000,
                'image' => 'https://images.unsplash.com/photo-1492684223066-81342ee5ff30?q=80&w=600&auto=format&fit=crop',
                'status' => 'Tiket Tersedia'
            ],
            [
                'title' => 'FREEDOM EXODUS',
                'slug' => 'freedom-exodus',
                'location' => 'Jakarta Timur',
                'date_str' => '15 Mei 26',
                'date_val' => '2026-05-15',
                'price_str' => 'Rp. 0',
                'price_val' => 0,
                'image' => 'https://images.unsplash.com/photo-1540039155732-d68a278ec63d?q=80&w=600&auto=format&fit=crop',
                'status' => 'Tiket Tidak Tersedia'
            ]
        ];

        // Filter by search
        if (!empty($search)) {
            $allEvents = array_filter($allEvents, function($event) use ($search) {
                return stripos($event['title'], $search) !== false;
            });
        }

        // Filter by date
        if (!empty($date)) {
            $allEvents = array_filter($allEvents, function($event) use ($date) {
                return $event['date_val'] === $date;
            });
        }

        // Sort
        if ($sort === 'terlama') {
            usort($allEvents, function($a, $b) {
                return strtotime($a['date_val']) - strtotime($b['date_val']);
            });
        } else {
            // default terbaru
            usort($allEvents, function($a, $b) {
                return strtotime($b['date_val']) - strtotime($a['date_val']);
            });
        }

        $data = [
            'events' => $allEvents,
            'search' => $search,
            'date'   => $date,
            'sort'   => $sort
        ];

        return view('pages/event', $data);
    }

    public function detail($slug)
    {
        $model = new EventModel();
        $event = $model->getEventWithDetails($slug);

        if (!$event) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $tickets = $model->getEventTickets($event['id']);
        $schedules = $model->getEventSchedules($event['id']);
        $relatedEvents = $model->getRelatedEvents($event['id']);

        $data = [
            'event' => $event,
            'tickets' => $tickets,
            'schedules' => $schedules,
            'relatedEvents' => $relatedEvents
        ];

        return view('pages/event_detail', $data);
    }
}
