<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Cart extends BaseController
{
    public function add()
    {
        if (!session()->get('isLoggedIn')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Silakan login terlebih dahulu']);
        }

        $userId = session()->get('userId');
        $ticketId = $this->request->getPost('ticket_id');
        $quantity = (int) $this->request->getPost('quantity') ?? 1;

        $db = \Config\Database::connect();
        
        // Check if item already in cart
        $existing = $db->table('cart')
            ->where('user_id', $userId)
            ->where('ticket_id', $ticketId)
            ->get()->getRowArray();

        if ($existing) {
            $db->table('cart')
                ->where('id', $existing['id'])
                ->update(['quantity' => $existing['quantity'] + $quantity]);
        } else {
            // Generate UUID format
            $cartId = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
            
            $db->table('cart')->insert([
                'id' => $cartId,
                'quantity' => $quantity,
                'user_id' => $userId,
                'ticket_id' => $ticketId, // Using atraksi id
                'schedule_id' => null
            ]);
        }

        return $this->response->setJSON(['status' => 'success', 'message' => 'Berhasil ditambahkan ke keranjang']);
    }

    public function getCart()
    {
        if (!session()->get('isLoggedIn')) {
            return $this->response->setJSON(['status' => 'success', 'items' => []]);
        }

        $userId = session()->get('userId');
        $db = \Config\Database::connect();
        
        // Assuming ticket_id references atraksi.id for Atraksi
        $items = $db->table('cart')
            ->select('cart.id as cart_id, cart.quantity, atraksi.title, atraksi.price, atraksi.banner_image')
            ->join('atraksi', 'atraksi.id = cart.ticket_id')
            ->where('cart.user_id', $userId)
            ->get()->getResultArray();

        return $this->response->setJSON(['status' => 'success', 'items' => $items]);
    }
}
