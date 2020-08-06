<?php

namespace App\Http\Controllers;

use App\Http\Requests\productRequest;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\VariantRepositoryInterface;

class ProductController extends Controller
{

    /**
   * @var ProductRepositoryInterface
   */
    private $product;

     /**
     * @var VariantRepositoryInterface
     */
    private $variant;

    /**
   * Product Controller constructor
   * 
   * @param ProductRepositoryInterface $product
   * @param VariantRepositoryInterface $variant
   * @return void
   */
    public function __construct(
        ProductRepositoryInterface $product,
        VariantRepositoryInterface $variant)
    {
        $this->product = $product;
        $this->variant = $variant;
    }

    public function create(productRequest $request)
    {

        $product = $this->product->newProduct($request);
        $product->save();
        
        if(count($request->variants)){
            foreach($request->variants as $v){
                $variant = $this->variant->newVariant($v);
                $product->variants()->save($variant);
            }
        }

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
