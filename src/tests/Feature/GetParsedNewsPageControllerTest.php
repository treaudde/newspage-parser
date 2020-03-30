<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetParsedNewsPageControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * @return void
     */
    public function tesGetParsedPage()
    {
        //will use the url to figure out which parser to use
        $newPageUrl = urlencode('http://lemonde.fr/news_story.html');

        $this->get("/api/get-parsed-page?url={$newPageUrl}", ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson(['parsedText' => 'This text was parsed out of the document.']);
    }
}
