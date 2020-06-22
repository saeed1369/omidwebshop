<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/hello');

        $response->assertStatus(200);
		$response->dump();
//	   $this->assertDatabaseHas('users',['email' => 'saeed@gmail.com']);
		//$response->assertSee('world4');
		//$this->assertDatabaseHas('orders',['maghsad' => 'tehran']);
		//$response->dump();
		//$response->assertRedirect('http://www.googgle.com');
    }
	public function testDatabase()
	{
		$this->assertDatabaseHas('users',['email' => 'saeed@gmail.com']);
	}
}
