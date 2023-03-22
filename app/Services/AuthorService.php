<?php

namespace App\Services;
use GuzzleHttp\Client;
use App\Models\User;

class AuthorService
{
    /**
     * @var Client
     */
    private $client;
    /**
     * AuthorService constructor.
     * @param Client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getAuthors($symToken){
        $result = [];
        try {
            $client = new Client();
            $response = $client->get(config('core.SYM_SKL_APU_URL').'/authors', [
                'headers' => [ 'Authorization' => 'Bearer ' . $symToken ],
            ]);
            if(!empty($response)){
                $result = json_decode($response->getBody());
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        return $result;
    }
}
