<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        return "Страница со списком постов";
    }

    public function create()
    {
        return "Страница создания поста";
    }

    public function store()
    {
        return "Запрос на создание поста";
    }

    public function show()
    {
        return "Detail View";
    }

    public function edit()
    {
        return "Страница с изменением поста";
    }

    public function update()
    {
        return "Запрос на изменение поста";
    }

    public function delete()
    {
        return "Запрос на удаление поста";
    }

    public function like()
    {
        return "Лайк++";
    }
}
