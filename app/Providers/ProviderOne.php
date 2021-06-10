<?php

namespace App\Providers;

use Illuminate\Support\facades\http;
class ProviderOne
{
    public function getAll()
    {
        try {
            $response1=http::get('http://www.mocky.io/v2/5d47f24c330000623fa3ebfa');
          //  dd(json_decode($response1->json()));
            return $response1->json();
          //  return http::get('http://www.mocky.io/v2/5d47f24c330000623fa3ebfa');
        } catch (\Exception $exception) {
            return null;
        }
    }
}