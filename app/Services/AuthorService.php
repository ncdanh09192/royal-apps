<?php

namespace App\Services;
use GuzzleHttp\Client;

class AuthorService
{
    /**
     * @var Client
     */
    private $client;
    private $sourceName = 'authors';
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

    public function delete($authorId, $symToken){
        $client = new Client();
        return $client->delete(config('core.SYM_SKL_APU_URL').'/'.$this->sourceName.'/'.$authorId,[
            'headers' => [ 'Authorization' => 'Bearer ' . $symToken ],
        ]);
    }

    public function detail($authorId , $symToken){
        $author = [];
        $client = new Client();
        $response = $client->get(config('core.SYM_SKL_APU_URL').'/'.$this->sourceName.'/'.$authorId, [
            'headers' => [ 'Authorization' => 'Bearer ' . $symToken ],
        ]);
        if(!empty($response)){
            $author = json_decode($response->getBody());
        }

        return $author;
    }
}
