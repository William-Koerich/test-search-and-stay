<?php
namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class StoresController extends Controller
{
    public function index()
    {
        $store = Store::all();
        return view('stores.index', ['stores' => $store]);
    }

    public function create()
    {
        return view('stores.create');
    }

    public function store(Request $request)
    {

        $store = new Store($request->all());
        $store->save();

        // Redirecionar para a rota de index de stores após o cadastro
        return redirect()->route('stores.index')->with('success', 'Store created successfully.');
    }

    public function edit($id)
    {

        $store = Store::findOrFail($id);
        // Busca a loja pelo ID e falha se não encontrar
        return view('stores.edit', compact('store')); // Retorna a view de edição com os dados da loja
    }

    public function show(Store $store)
    {
        return $store;
    }

    public function update(Request $request, $id)
    {
        $store = Store::query()->find($id);
        $store->name = $request->name;
        $store->address = $request->address;
        $store->active = $request->active;
        $store->save();

        // Após salvar, redirecionar para a lista de lojas
        return redirect()->route('stores.index')->with('success', 'Store updated successfully!');
    }

    public function destroy(Store $store)
    {
        $store->delete();

        return redirect()->route('stores.index')->with('success', 'Store deleted successfully.');

    }
}
