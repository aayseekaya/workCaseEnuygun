<?php

namespace App\Providers;

use Illuminate\Support\facades\http;

class ProviderTwo
{
    public function getAll()
    {
        try {
            $response2=http::get('http://www.mocky.io/v2/5d47f235330000623fa3ebf7');
            return $response2->json();
           // return $client->request('GET', 'http://www.mocky.io/v2/5d47f235330000623fa3ebf7')->toArray();
        } catch (\Exception $exception) {
            return null;
        }
    }
}