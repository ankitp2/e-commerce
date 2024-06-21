<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

use function Laravel\Prompts\error;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.showproducts', [
            'products' => DB::table('products')->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.addproducts');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category' => 'required',
            'description' => 'required',
            'image' => 'required',
            'status' => 'required',
        ]);
        $imagepath = $request->file('image')->store('images/product_image', 'public');
        $product = new Product();
        $product->name = $request['name'];
        $product->price = $request['price'];
        $product->category = $request['category'];
        $product->description = $request['description'];
        $product->status = $request['status'];
        $product->image = $imagepath;
        $product->save();
        return redirect()->route('admin.create')->with('alert', 'Product details uploaded successfully!');
        // $data=Product::create($request->all());
        // $file->move(public_path('\images\product_image'),$file->getClientOriginalName());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = Product::find($id);
        return view('admin.updateproducts', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);
        if ($request->file('image')) {
            $imagepath = $request->file('image')->store('images/product_image', 'public');
        } else {
            $data = Product::find($id);
            $imagepath = $data['image'];
        }
        $product = Product::find($id);
        $product->name = $request['name'];
        $product->price = $request['price'];
        $product->category = $request['category'];
        $product->description = $request['description'];
        $product->status = $request['status'];
        $product->image = $imagepath;
        $product->save();
        return redirect()->route('admin.index')->with('alert', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Product::find($id)->delete();
        return redirect()->route('admin.index')->with('alert', 'Product deleted successfully!');
    }
    public function showCamera()
    {
        $data = Product::all()->where('category', 'camera');
        return view('productpage', compact('data'));
    }
    public function showLaptop()
    {
        $data = Product::all()->where('category', 'laptop');
        return view('productpage', compact('data'));
    }
    public function showMobile()
    {
        $data = Product::all()->where('category', 'mobile');
        return view('productpage', compact('data'));
    }
    public function multiple()
    {
        return view('admin.addmultipleproducts');
    }
    public function multiple_store(Request $request)
    {
        $name = $request->name;
        $price = $request->price;
        $category = $request->category;
        $description = $request->description;
        $imagepath = $request->file('image');
        for ($i = 0; $i < count($name); $i++) {
            $product = new Product();
            $product->name = $name[$i];
            $product->price = $price[$i];
            $product->category = $category[$i];
            $product->description = $description[$i];
            $product->image = $imagepath[$i];
            $imagepath[$i]->store('images/product_image', 'public');
            $product->save();
        }
        return redirect()->back()->with('success', 'Data inserted successfully.');
    }
    public function productForms()
    {
        $products = Product::all();
        // dd($product);
        return view('admin.editproductform', [
            'products' => DB::table('products')->paginate(3)
        ]);
    }
    public function formUpdate(Request $request)
    {
        if ($request->ajax()) {
            try {
                $id = $_REQUEST['id'];
                $name = $_REQUEST['name'];
                $price = $_REQUEST['price'];
                $category = $_REQUEST['category'];
                // $images=$_REQUEST['images'];
                $status = $_REQUEST['status'];
                $description = $_REQUEST['description'];
                for ($i = 0; $i < count($name); $i++) {
                    $data = Product::find($id[$i]);
                    if (isset($images[$i])) {
                        // $imagepath = $images[$i]->store('images/product_image', 'public');
                        $image = Product::find($id[$i]);
                        $imagepath = $image['image'];
                    } else {
                        $image = Product::find($id[$i]);
                        $imagepath = $image['image'];
                    }
                    $data->name = $name[$i];
                    $data->price = $price[$i];
                    $data->category = $category[$i];
                    $data->description = $description[$i];
                    $data->image = $imagepath;
                    $data->status = $status[$i];
                    $data->save();
                }
                return Response()->json(['message' => 'Data upadated successfully.']);
            } catch (Exception $e) {
                return $e;
            }
        }
    }

    //     for ($i = 0; $i < count($request->name); $i++) {
    //         $id = $request->id[$i];
    //         $data = Product::find($id);
    //         if ($request->file('image')[$i]) {
    //             $imagepath = $request->file('image')[$i]->store('images/product_image', 'public');
    //         } else {
    //             $image = Product::find($id);
    //             $imagepath = $image['image'];
    //         }
    //         $data->name = $request->name[$i];
    //         $data->price = $request->price[$i];
    //         $data->category = $request->category[$i];
    //         $data->description = $request->description[$i];
    //         $data->image = $imagepath;
    //         $data->status = $request->status[$i];
    //         $data->save();
    //     }
    //     return redirect()->back()->with('success', 'Data Updated Successfully.');
}
