<?php

namespace App\Services;
use GuzzleHttp\Client;

class BookService
{
    /**
     * @var Client
     */
    private $client;
    private $sourceName = 'books';
    /**
     * AuthorService constructor.
     * @param Client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function delete($bookId, $symToken){
        $client = new Client();
        return $client->delete(config('core.SYM_SKL_APU_URL').'/'.$this->sourceName.'/'.$bookId,[
            'headers' => [ 'Authorization' => 'Bearer ' . $symToken ],
        ]);
    }

    public function create($createBookParams, $symToken){
        $client = new Client();
        return $client->post(config('core.SYM_SKL_APU_URL').'/'.$this->sourceName, [
            'headers' => [ 'Authorization' => 'Bearer ' . $symToken ],
            'json' => [
                "author" => [ "id" => $createBookParams['author_id'] ],
                "title" => $createBookParams['title'],
                "release_date" => $createBookParams['release_date'],
                "description" => $createBookParams['description'],
                "isbn" => $createBookParams['isbn'],
                "format" => $createBookParams['format'],
                "number_of_pages" => (int)$createBookParams['number_of_pages']
            ]
        ]);
    }

    public function getBooksByAuthor($authorId , $symToken){
        $sourceName = 'authors';
        $books = [];
        $client = new Client();
        $response = $client->get(config('core.SYM_SKL_APU_URL').'/'.$sourceName.'/'.$authorId, [
            'headers' => [ 'Authorization' => 'Bearer ' . $symToken ],
        ]);
        if(!empty($response)){
            $author = json_decode($response->getBody());
            $books = $author->books ?? [];
        }

        return $books;
    }
}
