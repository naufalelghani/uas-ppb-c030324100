<?php
// Naufal Elghani C030324100
// Proyek: UAS-PPB_TI_3C_C030324100
// File: config/cors.php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    /*
     * Menentukan path/rute mana saja yang akan menerapkan aturan CORS.
     * Karena kita menggunakan API, pastikan 'api/*' terdaftar di sini.
     * 'sanctum/csrf-cookie' diperlukan jika Anda menggunakan SPA auth Sanctum.
     */
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    /*
     * Menentukan HTTP method apa saja yang diizinkan (GET, POST, PUT, DELETE, dll).
     * Menggunakan ['*'] berarti mengizinkan semua method.
     */
    'allowed_methods' => ['*'],

    /*
     * Menentukan origin (domain) mana saja yang diizinkan untuk mengakses API.
     * Untuk tahap development, menggunakan ['*'] (izinkan semua) adalah yang paling mudah.
     * Nanti saat production, ganti dengan array URL frontend Anda, misal: ['http://localhost:5500', 'https://domain-anda.com']
     */
    'allowed_origins' => ['*'],

    /*
     * Jika Anda ingin menggunakan pola regex untuk allowed_origins, letakkan di sini.
     * Kosongkan saja jika tidak dipakai.
     */
    'allowed_origins_patterns' => [],

    /*
     * Menentukan header apa saja yang diizinkan dikirim oleh klien (misal: Authorization, Content-Type).
     * Menggunakan ['*'] berarti mengizinkan semua header.
     */
    'allowed_headers' => ['*'],

    /*
     * Menentukan header apa saja yang boleh dibaca (diekspos) oleh klien di response dari server.
     */
    'exposed_headers' => [],

    /*
     * Waktu (dalam detik) di mana hasil dari preflight request (OPTIONS) dapat disimpan di cache browser.
     * 0 berarti tidak di-cache (browser akan selalu melakukan preflight check).
     */
    'max_age' => 0,

    /*
     * Menentukan apakah request dapat menyertakan kredensial (seperti cookies, authorization headers, atau sertifikat TLS).
     * Jika diset true, maka 'allowed_origins' TIDAK BOLEH menggunakan wildcard ['*']. Anda harus menyebutkan origin secara spesifik.
     * Untuk API berbasis token (Bearer Token) tanpa cookie sharing antar domain, biasanya diset false.
     */
    'supports_credentials' => false,

];