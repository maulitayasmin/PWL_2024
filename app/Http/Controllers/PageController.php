<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index() {
        return 'Selamat Datang';
    }          

    public function about() {
        return 'NIM : 2241720010 <br>
        Nama : Maulita Yasmin Nadila';
    } 

    public function articles($id) {
        return 'Halaman Artikel Dengan ID ' . $id;
    } 
}
    