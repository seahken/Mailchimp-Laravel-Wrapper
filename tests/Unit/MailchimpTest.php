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

    public function testInvalidLogin()
    {
        $this->expectException('\Exception');
        $mailchimp = new Mailchimp('alfmweak');
        $lists = $mailchimp->getLists();
    }

    public function testMailchimpConnection()
    {
        $mailchimp = new Mailchimp();
        $lists = $mailchimp->getLists();
        $this->assertTrue(true);
    }

    public function testInstantiation()
    {
        $mailchimp = new Mailchimp();
        $this->assertInstanceOf('\App\Mailchimp',$mailchimp);
    }

    public function testMemberHash()
    {
        $mailchimp = new Mailchimp();

        $email = 'foo@bar.com';
        $expected = md5(strtolower($email));
        $method = self::getMethod('memberHash');
        $result = $method->invokeArgs($mailchimp, [$email]);
        $this->assertEquals($expected, $result);
    }

    protected static function getMethod($name)
    {
        $class = new \ReflectionClass('\App\Mailchimp');
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method;
    }

}
