<?php

namespace Unit;

use App\Service\Book;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_that_true_is_true()
    {
        $this->assertTrue(true);
    }

    public function testRandomBook()
    {
        $book = Book::getRandomBook();
        $this->assertInstanceOf(\App\Models\Book::class, $book, 'нет такого Id');
    }
}
