<?php

namespace App\Http\Controllers;

use App\Http\Requests\productRequest;
use App\Repositories\ColorRepositoryInterface;
use App\Repositories\MaterialRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\SizeRepositoryInterface;

class ProductController extends Controller
{

    /**
   * @var ProductRepositoryInterface
   */
    private $product;

    /**
     * @var ColorRepositoryInterface
     */
    private $color;

    /**
     * @var MaterialRepositoryInterface
     */
    private $material;

    /**
     * @var SizeRepositoryInterface
     */
    private $size;

    /**
   * Product Controller constructor
   * 
   * @param ProductRepositoryInterface $product
   * @param ColorRepositoryInterface $color
   * @param MaterialRepositoryInterface $material
   * @param SizeRepositoryInterface $size
   * @return void
   */
    public function __construct(
        ProductRepositoryInterface $product,
        ColorRepositoryInterface $color,
        MaterialRepositoryInterface $material,
        SizeRepositoryInterface $size)
    {
        $this->product = $product;
        $this->color = $color;
        $this->material = $material;
        $this->size = $size;
    }

    public function create(productRequest $request)
    {

        $product = $this->product->newProduct($request);
        $product->save();

        foreach($request->colors as $color){
            $Color = $this->color->newColor($product->id, $color['value']);
            $product->colors()->save($Color);
        }

        foreach($request->materials as $material){
            $Material = $this->material->newMaterial($product->id, $material['value']);
            $product->materials()->save($Material);
        }

        foreach($request->sizes as $size){
            $Size = $this->size->newSize($product->id, $size['value']);
            $product->sizes()->save($Size);
        }

        if($product->save()){
            session()->flash('success', 'Student added successfully');
        }else{
            session()->flash('failed', 'Something went wrong!');
            $product->delete();
        }
        return response();
    }

    public function show()
    {
        $products = $this->product->productcms()->get();
        return json_encode($products);
    }
}
