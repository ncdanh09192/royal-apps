<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Requests\CreateBookRequest;
use App\Services\BookService;

class BookController extends Controller
{
    private $sourceName = 'books';
    /**
     * @var BookService
     */
    private $bookService;

    public function __construct(BookService $bookService) {
        $this->bookService = $bookService;
    }

    public function delete($bookId, Request $request){
        try {
            $response = $this->bookService->delete($bookId, $request->user()->sym_token);
            if(!empty($response)){
                return redirect()->back()->with('delete_message', 'Delete successfully');
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }
        return redirect()->back()->with('delete_message', 'Delete fail! - try again later');
    }

    public function add(Request $request){
        $authors = $request->user()->getAuthors();
        return view('book.add',["authors" => $authors]);
    }

    public function create(CreateBookRequest $request){
        try {
            $response = $this->bookService->create([
                "author_id" => $request->author_id,
                "title" => $request->title,
                "release_date" => $request->release_date,
                "description" => $request->description,
                "isbn" => $request->isbn,
                "format" => $request->format,
                "number_of_pages" => (int)$request->number_of_pages
            ], $request->user()->sym_token);
            if(!empty($response)){
                return redirect()->back()->with('create_msg', 'Created');
            }
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return redirect()->back()->with('create_msg', 'Created fail!');
        }
    }
}
