<?php

namespace App\Controllers;

class Atraksi extends BaseController
{
    public function index()
    {
        return view('pages/atraksi');
    }

    public function detail($slug)
    {
        $model = new \App\Models\AtraksiModel();
        $atraksi = $model->getAtraksiWithDetails($slug);

        if (!$atraksi) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $user = null;
        if (session()->get('isLoggedIn')) {
            $userModel = new \App\Models\UserModel();
            $user = $userModel->find(session()->get('userId'));
        }

        $db = \Config\Database::connect();
        $relatedAtraksi = $db->table('atraksi')
            ->select('atraksi.*, city.name as city_name')
            ->join('city', 'city.id = atraksi.city_id', 'left')
            ->where('atraksi.id !=', $atraksi['id'])
            ->limit(5)
            ->get()->getResultArray();

        return view('pages/atraksi_detail', [
            'atraksi' => $atraksi, 
            'user' => $user,
            'relatedAtraksi' => $relatedAtraksi
        ]);
    }

    public function checkout($slug)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu untuk melanjutkan pemesanan.');
        }

        $model = new \App\Models\AtraksiModel();
        $atraksi = $model->getAtraksiWithDetails($slug);

        if (!$atraksi) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $userModel = new \App\Models\UserModel();
        $user = $userModel->find(session()->get('userId'));

        // Retrieve selected date from query params or session
        $visitDate = $this->request->getGet('date') ?? date('Y-m-d');

        return view('pages/atraksi_checkout', [
            'atraksi' => $atraksi,
            'user' => $user,
            'visitDate' => $visitDate
        ]);
    }

    public function processPayment()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('userId');
        $slug = $this->request->getPost('slug');
        $visitDate = $this->request->getPost('visit_date');
        $paymentMethod = $this->request->getPost('payment_method');

        $model = new \App\Models\AtraksiModel();
        $atraksi = $model->getAtraksiWithDetails($slug);

        if (!$atraksi) {
            return redirect()->back()->with('error', 'Atraksi tidak ditemukan');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        $orderId = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
        $orderNo = 'ORD-' . strtoupper(substr(md5(uniqid()), 0, 8));
        $subTotal = $atraksi['price'];
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

        // Insert Order Item
        // Note: we don't have ticket_id for atraksi, so we'll use a dummy or just the atraksi id if possible. 
        // In the schema, order_item has ticket_id. I'll just put atraksi_id in ticket_id or create a dummy ticket id since the DB schema is strict.
        $orderItemId = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x', mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000, mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
        $db->table('order_item')->insert([
            'id' => $orderItemId,
            'quantity' => 1,
            'price' => $subTotal,
            'visit_date' => $visitDate,
            'visit_time' => null,
            'order_id' => $orderId,
            'ticket_id' => $atraksi['id'], 
            'schedule_id' => null
        ]);

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Gagal memproses pembayaran');
        }

        return redirect()->to('/atraksi/waiting-payment/' . $orderId);
    }

    public function waitingPayment($orderId)
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login');
        }

        $db = \Config\Database::connect();
        $order = $db->table('order')->where('id', $orderId)->where('user_id', session()->get('userId'))->get()->getRowArray();

        if (!$order) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $orderItem = $db->table('order_item')->where('order_id', $orderId)->get()->getRowArray();
        $atraksi = $db->table('atraksi')->where('id', $orderItem['ticket_id'])->get()->getRowArray();

        return view('pages/atraksi_waiting_payment', [
            'order' => $order,
            'orderItem' => $orderItem,
            'atraksi' => $atraksi
        ]);
    }
}
