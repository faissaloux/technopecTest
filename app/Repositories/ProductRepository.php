<?php
declare(strict_types = 1);

namespace App\Repositories;

use App\Product;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ProductRepository implements ProductRepositoryInterface
{
    /**
     * @var Product
     */
    private $model;

    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function newProduct($request): ?Model
    {
        $product = new $this->model;
        $product->product = $request->title;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        
        return $product;
    }

    public function productcms(): ?Builder
    {
        return $this->model->with('colors')
                           ->with('materials')
                           ->with('sizes');
    }
}