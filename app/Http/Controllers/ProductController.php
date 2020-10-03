<?php

namespace App\Http\Controllers;

use App\Events\ProductSaved;
use App\Http\Requests\productRequest;
use App\Repositories\ProductRepositoryInterface;

class ProductController extends Controller
{

    /**
   * @var ProductRepositoryInterface
   */
    private $product;

    /**
   * Product Controller constructor
   * 
   * @param ProductRepositoryInterface $product
   * @return void
   */
    public function __construct(ProductRepositoryInterface $product)
    {
        $this->product = $product;
    }

    public function create(productRequest $request)
    {

        $product = $this->product->newProduct($request);
        $product->save();
        
        event(new ProductSaved($request, $product));

        if($product->save()){
            session()->flash('success', 'Product added successfully');
        }else{
            session()->flash('failed', 'Something went wrong!');
            $product->delete();
        }
        return response()->json(['status' => 'ok']);
    }

    public function show()
    {
        $products = $this->product->productwithVariants()->get();
        return json_encode($products);
    }
}
