<?php

namespace App\Service;

use App\Models\Book as BookModel;

class Book
{

    public static function getRandomBook()
    {
        $randId = mt_rand(1,3);
        $book = BookModel::query()->where('id', ' = ', $randId)->first();
        return $book;
    }

}
