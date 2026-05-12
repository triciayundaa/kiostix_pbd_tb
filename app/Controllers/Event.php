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
            ],
            [
                'title' => 'ArtScience Museum™',
                'slug' => 'artscience-museum',
                'location' => 'Singapura',
                'date_str' => 'Setiap Hari',
                'date_val' => '2026-12-31',
                'price_str' => 'Rp. 236.061',
                'price_val' => 236061,
                'image' => 'https://images.unsplash.com/photo-1548013146-72479768bada?q=80&w=600&auto=format&fit=crop',
                'status' => 'Tiket Tersedia'
            ],
            [
                'title' => 'National Orchid Garden',
                'slug' => 'national-orchid-garden',
                'location' => 'Singapura',
                'date_str' => 'Setiap Hari',
                'date_val' => '2026-12-31',
                'price_str' => 'Rp. 100.109',
                'price_val' => 100109,
                'image' => 'https://images.unsplash.com/photo-1505159940484-eb2b9f2588e2?q=80&w=600&auto=format&fit=crop',
                'status' => 'Tiket Tersedia'
            ],
            [
                'title' => 'COMBO: Gardens by the Bay',
                'slug' => 'combo-gardens-by-the-bay',
                'location' => 'Singapura',
                'date_str' => 'Setiap Hari',
                'date_val' => '2026-12-31',
                'price_str' => 'Rp. 714.560',
                'price_val' => 714560,
                'image' => 'https://images.unsplash.com/photo-1525625293386-3f8f99389edd?q=80&w=600&auto=format&fit=crop',
                'status' => 'Tiket Tersedia'
            ],
            [
                'title' => 'Gardens by the Bay',
                'slug' => 'gardens-by-the-bay',
                'location' => 'Singapura',
                'date_str' => 'Setiap Hari',
                'date_val' => '2026-12-31',
                'price_str' => 'Rp. 111.360',
                'price_val' => 111360,
                'image' => 'https://images.unsplash.com/photo-1583417319070-4a69db38a482?q=80&w=600&auto=format&fit=crop',
                'status' => 'Tiket Tersedia'
            ]
        ];

        // Filter by search
        if (!empty($search)) {
            $allEvents = array_filter($allEvents, function($event) use ($search) {
                return stripos($event['title'], $search) !== false || stripos($event['location'], $search) !== false;
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

    public function checkout()
    {
        $guestName = $this->request->getPost('guest_name');
        $guestEmail = $this->request->getPost('guest_email');
        $guestPhone = $this->request->getPost('guest_phone');
        
        // Let user checkout without logging in, we use guest data


        $slug = $this->request->getPost('event_slug');
        $ticketsInput = $this->request->getPost('tickets');
        
        if (empty($ticketsInput) || empty($slug)) {
            return redirect()->back()->with('error', 'Silakan pilih minimal 1 tiket.');
        }

        $model = new EventModel();
        $event = $model->getEventWithDetails($slug);

        if (!$event) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        // Filter tickets that have quantity > 0
        $selectedTickets = [];
        $subTotal = 0;
        
        $db = \Config\Database::connect();
        
        foreach ($ticketsInput as $ticketId => $qty) {
            if ($qty > 0) {
                $ticket = $db->table('ticket')->where('id', $ticketId)->where('event_id', $event['id'])->get()->getRowArray();
                if ($ticket) {
                    $ticket['selected_qty'] = $qty;
                    $selectedTickets[] = $ticket;
                    $subTotal += ($ticket['price'] * $qty);
                }
            }
        }
        
        if (empty($selectedTickets)) {
            return redirect()->back()->with('error', 'Silakan pilih minimal 1 tiket.');
        }

        $userModel = new \App\Models\UserModel();
        $user = [];
        if (session()->get('isLoggedIn')) {
            $user = $userModel->find(session()->get('userId'));
        }
        
        if ($guestName) $user['full_name'] = $guestName;
        if ($guestEmail) $user['email'] = $guestEmail;
        if ($guestPhone) $user['no_handphone'] = $guestPhone;

        return view('pages/event_checkout', [
            'event' => $event,
            'user' => $user,
            'selectedTickets' => $selectedTickets,
            'subTotal' => $subTotal
        ]);
    }

    public function processPayment()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('userId');
        $slug = $this->request->getPost('slug');
        $paymentMethod = $this->request->getPost('payment_method');
        $ticketsInput = $this->request->getPost('tickets'); // encoded json or array

        $model = new EventModel();
        $event = $model->getEventWithDetails($slug);

        if (!$event || empty($ticketsInput)) {
            return redirect()->back()->with('error', 'Pesanan tidak valid');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        $orderId = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
        $orderNo = 'ORD-' . strtoupper(substr(md5(uniqid()), 0, 8));
        
        $subTotal = 0;
        $orderItems = [];
        
        foreach ($ticketsInput as $ticketId => $qty) {
            $ticket = $db->table('ticket')->where('id', $ticketId)->where('event_id', $event['id'])->get()->getRowArray();
            if ($ticket) {
                $subTotal += ($ticket['price'] * $qty);
                $orderItems[] = [
                    'id' => sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)),
                    'quantity' => $qty,
                    'price' => $ticket['price'],
                    'visit_date' => date('Y-m-d'), // event date is usually fixed, just mock it
                    'visit_time' => null,
                    'order_id' => $orderId,
                    'ticket_id' => $ticketId, 
                    'schedule_id' => null
                ];
                
                // Reduce stock
                $db->table('ticket')->where('id', $ticketId)->update(['quantity' => $ticket['quantity'] - $qty]);
            }
        }
        
        $platformFee = 3000;
        $grandTotal = $subTotal + $platformFee;

        // Insert Order
        $db->table('order')->insert([
            'id' => $orderId,
            'order_no' => $orderNo,
            'pay_status' => 'Paid',
            'payment_method' => $paymentMethod,
            'sub_total' => $subTotal,
            'platform_fee' => $platformFee,
            'grand_total' => $grandTotal,
            'created_at' => date('Y-m-d H:i:s'),
            'user_id' => $userId,
            'voucher_id' => null
        ]);

        // Insert Order Items
        foreach ($orderItems as $item) {
            $db->table('order_item')->insert($item);
        }

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Gagal memproses pembayaran');
        }

        return redirect()->to('/atraksi/waiting-payment/' . $orderId); // Reuse the waiting payment page
    }
}
