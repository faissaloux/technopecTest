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

        $colors = explode(', ', $request->color);
        foreach($colors as $color){
            $Color = $this->color->newColor($product->id, $color);
            $product->colors()->save($Color);
        }

        $materials = explode(', ', $request->material);
        foreach($materials as $material){
            $Material = $this->material->newMaterial($product->id, $material);
            $product->materials()->save($Material);
        }

        $sizes = explode(', ', $request->size);
        foreach($sizes as $size){
            $Size = $this->size->newSize($product->id, $size);
            $product->sizes()->save($Size);
        }

        return redirect()->back();
    }

    public function show()
    {
        $products = $this->product->productcms()->get();
        return json_encode($products);
    }
}
