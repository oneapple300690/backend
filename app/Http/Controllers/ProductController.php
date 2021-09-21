<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    function add(Request $req)
    {
        $product = new Product();
        $product->name = $req->input('name');
        $product->price = $req->input('price');
        $product->description = $req->input('description');
        $product->file_path = $req->file('prod_file')->store('products');
        $product->save();
        return $product;
    }

    function update(Request $req)
    {
        // No need to store image if no file is slected
        $file_path = '';
        if($req->hasFile('prod_file')){
            $file_path = $req->file('prod_file')->store('products');
        }

        $data_input = [
            'name' => $req->input('name'),
            'price' => $req->input('price'),
            'description' => $req->input('description'),
            'file_path' => $file_path,
        ];

        $product = Product::where('id', $req->input('id'))->update(array_filter($data_input));
        if ($product === 1) {
            return ['message' => 'Book is updated successfully!'];
        } else {
            return ['message' => 'Book is not updated successfully!'];
        }
    }

    function list()
    {
        return Product::all();
    }

    function delete($id)
    {
        $result = Product::where('id', $id)->delete();
        if ($result) {
            return ['result' => 'Product ID ' . $id . ' has been deleted!'];
        } else {
            return ['result' => 'There is no product ID ' . $id . ' to delete!'];
        }
    }

    function get(string $id): object
    {
        $result = Product::find($id);
        return $result;
    }

    function search(string $key): object
    {
        $result = Product::where('name', 'LIKE', "%$key%")->get();
        return $result;
    }
}
