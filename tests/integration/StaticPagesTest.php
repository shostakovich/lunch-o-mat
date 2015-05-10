<?php
class StaticPagesTest extends TestCase
{
    public function testWelcomePage()
    {
        $this->visit('/');
    }

    public function testHomePage()
    {
        $this->login();
        $this->visit('/home');
    }
}
