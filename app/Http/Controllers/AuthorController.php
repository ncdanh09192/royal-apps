<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Services\AuthorService;

class AuthorController extends Controller
{
    /**
     * @var AuthorService
     */
    private $authorService;

    public function __construct(AuthorService $authorService) {
        $this->authorService = $authorService;
    }

    public function delete($authorId, Request $request){
        try {
            $response = $this->authorService->delete($authorId, $request->user()->sym_token);
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
            $author = $this->authorService->detail($authorId, $request->user()->sym_token);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }

        return view('author.detail',["author" => $author]);
    }
}
