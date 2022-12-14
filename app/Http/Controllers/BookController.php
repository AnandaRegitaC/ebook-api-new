<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
   
    public function index()
    {
        $book = Book::all();
        return $book;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $book = Book::create([
            "title" => $request->title,
            "description" => $request->description,
            "author" => $request->author,
            "publisher" => $request->publisher,
            "date_of_issue" => $request->date_of_issue
        ]);

        return response()->json([
            'status' => 200,
            'data' => $book
        ], 200);

    }

    public function show($id)
    {
        $book = book::find($id);
        if ($book) {
            return response()->json([
                'status' => 200,
                'data' => $book
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'id atas' . $id . 'tidak ditemukan'
            ], 404);
        }
    }    

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $book = book::find($id);
        if($book){
            $book->title = $request->title ? $request->title : $book->title;
            $book->description = $request->description ? $request->description : $book->description;
            $book->author = $request->author ? $request->author : $book->author;
            $book->publisher = $request->publisher ? $request->publisher : $book->publisher;
            $book->date_of_issue = $request->date_of_issue ? $request->date_of_issue : $book->date_of_issue;
            $book->save();
            return response()->json([
                'status' => 200,
                'data' => $book
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => $id . 'tidak ditemukan'
            ], 404);
        }
    }

    public function destroy($id)
    {
        $book = book::where('id', $id)->first();
        if($book){
            $book->delete();
            return response()->json([
                'status' => 404,
                'message' => 'id' . $id . 'tidak ditemukan'
            ], 404);
        }
    }
}
