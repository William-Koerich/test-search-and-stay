<?php
// BooksController.php
namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Store;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $stores = Store::all(); // Busca todas as lojas para exibir na listagem
        return view('books.index', ['books' => $books, 'stores' => $stores]);

    }

    public function create()
    {
        $stores = Store::all();
        return view('books.create', ['stores' => $stores]);
    }

    public function store(Request $request)
    {
        $book = new Book();
        $book->name = $request->name;
        $book->isbn = $request->isbn;
        $book->value = $request->value;
        $book->store_id = $request->store_id; // Atribui o store_id ao livro

        $book->save();
        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    public function edit($id)
    {
        $book = Book::findOrFail($id); // Busca o livro pelo ID e falha se não encontrar
        $stores = Store::all();
        return view('books.edit', compact('book', 'stores')); // Retorna a view de edição com os dados do livro
    }


    public function show(Book $book)
    {
        return $book;
    }

    public function update(Request $request, $id)
    {
        $book = Book::query()->find($id);
        $book->name = $request->name;
        $book->isbn = $request->isbn;
        $book->value = $request->value;
        $book->store_id = $request->store_id;
        $book->save();

        // Após salvar, redirecionar para a lista de lojas
        return redirect()->route('books.index')->with('success', 'Book updated successfully!');
    }
    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Store deleted successfully.');
    }
}
