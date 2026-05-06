<?php

/*
 * Indonesian validation messages for the rules this app actually uses.
 * Keys not listed here fall back to the framework's English text, so this file
 * only needs the rules the controllers trigger.
 */
return [
    'required' => 'Kolom :attribute wajib diisi.',
    'string' => 'Kolom :attribute harus berupa teks.',
    'email' => 'Kolom :attribute harus berupa alamat email yang valid.',
    'unique' => ':attribute sudah terdaftar.',
    'confirmed' => 'Konfirmasi :attribute tidak cocok.',
    'integer' => 'Kolom :attribute harus berupa bilangan bulat.',
    'numeric' => 'Kolom :attribute harus berupa angka.',
    'min' => [
        'numeric' => 'Kolom :attribute minimal :min.',
        'string' => 'Kolom :attribute minimal :min karakter.',
        'integer' => 'Kolom :attribute minimal :min.',
        'array' => 'Kolom :attribute minimal berisi :min item.',
    ],
    'max' => [
        'numeric' => 'Kolom :attribute maksimal :max.',
        'string' => 'Kolom :attribute maksimal :max karakter.',
        'integer' => 'Kolom :attribute maksimal :max.',
        'array' => 'Kolom :attribute maksimal berisi :max item.',
        'file' => 'Kolom :attribute maksimal :max kilobyte.',
    ],
    'in' => 'Nilai :attribute yang dipilih tidak valid.',
    'image' => 'Kolom :attribute harus berupa gambar.',
    'mimes' => 'Kolom :attribute harus berupa file bertipe: :values.',

    'attributes' => [
        'name' => 'nama',
        'email' => 'email',
        'password' => 'password',
        'customer_name' => 'nama penerima',
        'customer_phone' => 'no. HP',
        'shipping_address' => 'alamat pengiriman',
        'quantity' => 'jumlah',
        'price' => 'harga',
        'stock' => 'stok',
        'status' => 'status',
        'image' => 'gambar',
        'description' => 'deskripsi',
    ],
];
