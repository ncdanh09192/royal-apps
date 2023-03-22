<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BookService;
class DashboardController extends Controller
{
    //
    /**
     * @var BookService
     */
    private $bookService;

    public function __construct(BookService $bookService) {
        $this->bookService = $bookService;
    }

    public function index(Request $request) {
        $authors = $request->user()->getAuthors();
        if(!empty($authors) && !empty($authors->items)){
            foreach ($authors->items as &$author) {
                $author->books = $this->bookService->getBooksByAuthor($author->id, $request->user()->sym_token);
            }
        }
        return view('dashboard',["authors" => $authors]);
    }
}
