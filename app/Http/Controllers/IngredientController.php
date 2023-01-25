<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ingredients = Ingredient::all();
        return view('ingredient.index')->with('ingredients', $ingredients);
    }
    public function delete($id)
    {
        $ingredient = Ingredient::find($id);
        return view('ingredient.delete')->with('ingredient', $ingredient);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ingredient.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:ingredients', 'max:20'],
            'price' => ['required', 'max:234'],
            'image' => ['required', 'max:234'],

        ]);
    
        $ingredient = new Ingredient();
        $ingredient->name = $request->name;
        $ingredient->price = $request->price;
        $ingredient->image = $request->image;
        $ingredient->save();
    
        return redirect()->route('ingredients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function show(Ingredient $ingredient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ingredient = Ingredient::find($id);
        return view('ingredient.edit')->with('ingredient', $ingredient);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        $request->validate([
            'name' => ['required', Rule::unique('ingredients')->ignore($ingredient), 'max:20'],
            'price' => ['required', 'max:234'],
            'image' => [ 'max:234'],

        ]);
    
        $ingredient->update($request->only(['name', 'image', 'price']));
        return redirect()->route('ingredients.index')->with('success', 'Product updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();
        return redirect()->route('ingredients.index')->with('success', 'Product deleted successfully');
    }
}
