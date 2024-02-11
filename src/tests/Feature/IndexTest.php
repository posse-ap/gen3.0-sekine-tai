<?php

namespace Tests\Feature;

use App\BigQuestion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        // $response = $this->get('/');

        // $response->assertStatus(200)->assertSee('東京の難読地名クイズ');

        factory(BigQuestion::class)->create(['name'=>'TestName']);

        $response = $this->get('/');

        $response->assertStatus(200)->assertSee('TestName');
    }
}
