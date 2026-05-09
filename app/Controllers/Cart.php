<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Cart extends BaseController
{
    public function index()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu untuk melihat keranjang.');
        }

        $userId = session()->get('userId');
        $db = \Config\Database::connect();
        
        $cartItems = $db->table('cart')
            ->select('cart.id as cart_id, cart.quantity, atraksi.title, atraksi.price, atraksi.banner_image, atraksi.slug')
            ->join('atraksi', 'atraksi.id = cart.ticket_id')
            ->where('cart.user_id', $userId)
            ->get()->getResultArray();

        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        return view('pages/cart_index', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice
        ]);
    }

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

    public function updateQty()
    {
        if (!session()->get('isLoggedIn')) {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Silakan login terlebih dahulu']);
        }

        $userId = session()->get('userId');
        $cartId = $this->request->getPost('cart_id');
        $action = $this->request->getPost('action'); // 'increase' or 'decrease'

        $db = \Config\Database::connect();
        $cartItem = $db->table('cart')->where('id', $cartId)->where('user_id', $userId)->get()->getRowArray();

        if ($cartItem) {
            $newQty = $action === 'increase' ? $cartItem['quantity'] + 1 : $cartItem['quantity'] - 1;
            
            if ($newQty > 0) {
                $db->table('cart')->where('id', $cartId)->update(['quantity' => $newQty]);
            } else {
                $db->table('cart')->where('id', $cartId)->delete();
            }
            return $this->response->setJSON(['status' => 'success']);
        }

        return $this->response->setJSON(['status' => 'error', 'message' => 'Item tidak ditemukan']);
    }

    public function remove()
    {
        if (!session()->get('isLoggedIn')) {
            return $this->response->setJSON(['status' => 'error']);
        }

        $userId = session()->get('userId');
        $cartId = $this->request->getPost('cart_id');

        $db = \Config\Database::connect();
        $db->table('cart')->where('id', $cartId)->where('user_id', $userId)->delete();

        return $this->response->setJSON(['status' => 'success']);
    }

    public function checkout()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('userId');
        $db = \Config\Database::connect();
        
        $cartItems = $db->table('cart')
            ->select('cart.id as cart_id, cart.quantity, atraksi.id as atraksi_id, atraksi.title, atraksi.price')
            ->join('atraksi', 'atraksi.id = cart.ticket_id')
            ->where('cart.user_id', $userId)
            ->get()->getResultArray();

        if (empty($cartItems)) {
            return redirect()->to('/cart')->with('error', 'Keranjang Anda kosong');
        }

        $userModel = new \App\Models\UserModel();
        $user = $userModel->find($userId);

        $subTotal = 0;
        foreach ($cartItems as $item) {
            $subTotal += $item['price'] * $item['quantity'];
        }

        return view('pages/cart_checkout', [
            'cartItems' => $cartItems,
            'user' => $user,
            'subTotal' => $subTotal
        ]);
    }

    public function processPayment()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('userId');
        $paymentMethod = $this->request->getPost('payment_method');
        
        $db = \Config\Database::connect();
        $cartItems = $db->table('cart')
            ->select('cart.id as cart_id, cart.quantity, atraksi.id as atraksi_id, atraksi.price')
            ->join('atraksi', 'atraksi.id = cart.ticket_id')
            ->where('cart.user_id', $userId)
            ->get()->getResultArray();

        if (empty($cartItems)) {
            return redirect()->to('/cart');
        }

        $db->transStart();

        $orderId = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
        $orderNo = 'ORD-' . strtoupper(substr(md5(uniqid()), 0, 8));
        
        $subTotal = 0;
        foreach ($cartItems as $item) {
            $subTotal += $item['price'] * $item['quantity'];
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
        foreach ($cartItems as $item) {
            $orderItemId = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
            
            $db->table('order_item')->insert([
                'id' => $orderItemId,
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'visit_date' => date('Y-m-d'), // Use today's date since cart doesn't have date
                'visit_time' => null,
                'order_id' => $orderId,
                'ticket_id' => $item['atraksi_id'], 
                'schedule_id' => null
            ]);
        }

        // Empty Cart
        $db->table('cart')->where('user_id', $userId)->delete();

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Gagal memproses pembayaran');
        }

        return redirect()->to('/atraksi/waiting-payment/' . $orderId);
    }
}
