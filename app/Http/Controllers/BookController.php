<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Requests\CreateBookRequest;
use App\Services\AuthorService;

class BookController extends Controller
{
    private $sourceName = 'books';
    /**
     * @var AuthorService
     */
    private $authorService;

    public function delete($bookId, Request $request){
        try {
            $client = new Client();
            $response = $client->delete(config('core.SYM_SKL_APU_URL').'/'.$this->sourceName.'/'.$bookId,[
                'headers' => [ 'Authorization' => 'Bearer ' . $request->user()->sym_token ],
            ]);
            if(!empty($response)){
                return redirect()->back()->with('delete_message', 'Delete successfully');
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }
        return redirect()->back()->with('delete_message', 'Delete fail! - try again later');
    }

    public function detail($bookId, Request $request){
        $book = [];
        try {
            $client = new Client();
            $response = $client->get(config('core.SYM_SKL_APU_URL').'/'.$this->sourceName.'/'.$bookId, [
                'headers' => [ 'Authorization' => 'Bearer ' . $request->user()->sym_token ],
            ]);
            if(!empty($response)){
                $book = json_decode($response->getBody());
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        return view('book.detail',["book" => $book]);
    }

    public function add(Request $request){
        $authors = $request->user()->getAuthors();
        return view('book.add',["authors" => $authors]);
    }

    public function create(CreateBookRequest $request){
        $book = [];
        try {
            $client = new Client();
            $response = $client->post(config('core.SYM_SKL_APU_URL').'/'.$this->sourceName, [
                'headers' => [ 'Authorization' => 'Bearer ' . $request->user()->sym_token ],
                'json' => [
                    "author" => [ "id" => $request->author_id ],
                    "title" => $request->title,
                    "release_date" => $request->release_date,
                    "description" => $request->description,
                    "isbn" => $request->isbn,
                    "format" => $request->format,
                    "number_of_pages" => (int)$request->number_of_pages
                ]
            ]);
            \Log::info(json_encode($response));
            if(!empty($response)){
                return redirect()->back()->with('create_msg', 'Created');
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('create_msg', 'Created fail!');
        }
    }
}
