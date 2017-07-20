<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Mailchimp;

class MailchimpTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testGetLists()
    {
        $mailchimp = new Mailchimp();
        $lists = $mailchimp->getLists();
        $this->assertTrue(true);
    }
}
