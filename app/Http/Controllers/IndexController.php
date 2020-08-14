<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;


class IndexController extends Controller
{
    public function index(){
    	// Muestra los productos en Orden (por default)
    	$productsAll = Product::get();

    	// Muestra los productos en Orden Descendente
    	$productsAll = Product::orderBy('id','DESC')->get();

    	// Muestra los productos en Orden randomico
    	$productsAll = Product::inRandomOrder()->where('status',1)->get();

    	//Obtener Todas las categorias y sub categorias
    	$categories = Category::with('categories')->where(['parent_id'=>0])->get();

    	return view('index')->with(compact('productsAll','categories'));
    }
}
