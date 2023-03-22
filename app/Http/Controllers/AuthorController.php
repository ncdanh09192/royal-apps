<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Services\AuthorService;

class AuthorController extends Controller
{
    private $sourceName = 'authors';

    /**
     * @var AuthorService
     */
    private $authorService;

    public function __construct(AuthorService $authorService) {
        $this->authorService = $authorService;
    }
    public function delete($authorId, Request $request){
        try {
            $client = new Client();
            $response = $client->delete(config('core.SYM_SKL_APU_URL').'/'.$this->sourceName.'/'.$authorId,[
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

    public function detail($authorId, Request $request){
        $author = [];
        try {
            $client = new Client();
            $response = $client->get(config('core.SYM_SKL_APU_URL').'/'.$this->sourceName.'/'.$authorId, [
                'headers' => [ 'Authorization' => 'Bearer ' . $request->user()->sym_token ],
            ]);
            if(!empty($response)){
                $author = json_decode($response->getBody());
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        return view('author.detail',["author" => $author]);
    }
}
