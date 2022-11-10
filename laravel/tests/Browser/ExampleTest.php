<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Laravel');
        });
    }

    public function testClickExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/books')
                ->click('#add')
                ->value('#name', 'Buch')
                ->value('#price', 333)
                ->press('создать')
                ->assertSee('books');
        });
    }

}
