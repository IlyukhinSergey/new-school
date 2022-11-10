<?php

namespace App\Service;


class Book
{

    public static function getRandomBook()
    {
        $randId = mt_rand(1, 3);
        $book = \App\Models\Book::query()->where('id', $randId)->first();
        return $book;
    }

}
