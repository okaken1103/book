<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\book;
use Carbon\Carbon;
use App\Models\History;

class BookController extends Controller
{
    
    public function add()
    {
        return view('admin.book.create');
    }
    public function create(Request $request)
    {
        $this->validate($request, book::$rules);

        $book = new book;
        $form = $request->all();
        if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $book -> image =  basename($path);
        } else {
            $book->image = null;
        }
        
        unset($form['_token']);
        unset($form['image']);

        $book->fill($form);
        $book->save();
        
        return redirect('admin/book/create'); 
    }
   public function index(Request $request)
{
    $cond_title = $request->cond_title;
    $cond_publisher = $request->cond_publisher;
    $cond_author = $request->cond_author;

    $query = book::query()
        ->when(!is_null($cond_title), function($q) use ($cond_title) {
            $q->where('title', $cond_title);
        })
        ->when(!is_null($cond_publisher), function($q) use ($cond_publisher) {
            $q->where('publisher', $cond_publisher);
        })
        ->when(!is_null($cond_author), function($q) use ($cond_author) {
            $q->where('author', $cond_author);
        });

    $posts = $query->get();

    return view('admin.book.index', [
        'posts' => $posts,
        'cond_title' => $cond_title,
        'cond_publisher' => $cond_publisher,
        'cond_author' => $cond_author
    ]);
}
public function edit(Request $request)
    {
        // News Modelからデータを取得する
        $book = book::find($request->id);
        if (empty($book)) {
            abort(404);
        }
        return view('admin.book.edit', ['book_form' => $book]);
    }

    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, book::$rules);
        // News Modelからデータを取得する
        $book = book::find($request->id);
        // 送信されてきたフォームデータを格納する
        $book_form = $request->all();
        
        if ($request->remove == 'true') {
            $book_form['image'] = null;
        } elseif ($request->file('book_image')) {
            $path = $request->file('book_image')->store('public/image');
            $book_form['image'] = basename($path);
        } else {
            $book_form['image'] = $book->image;
        }

        unset($book_form['book_image']);
        unset($book_form['remove']);
        unset($book_form['_token']);

        // 該当するデータを上書きして保存する
        $book->fill($book_form)->save();
    
        $history = new History();
        $history->book_id = $book->id;
        $history->edited_at = Carbon::now();
        $history->save();

        return redirect('admin/book');
    }
    public function delete(Request $request)
    {
        // 該当するNews Modelを取得
        $book = book::find($request->id);

        // 削除する
        $book->delete();

        return redirect('admin/book');
    }
}