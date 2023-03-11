<?php
use App\Models\{Notification, User,notifications_setting,transaksi};
use PhpParser\Node\Stmt\Return_;

class Rupiah {
    public static function getRupiah($value) {
        $format = "Rp " . number_format($value,0,',','.');
        return $format;
    }
}

// Get Nama Customer by id
if (!function_exists('namaCustomer')) {
    function namaCustomer($id = 0)
    {
        $model = new User;
        $data  = $model::where('id', $id)->first();
        $name = !empty($data) ? $data->name : 'Not Found';
        return $name;
    }
}

