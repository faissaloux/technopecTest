<?php
declare(strict_types = 1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

interface ProductRepositoryInterface
{

    /**
     * Add new product to products table.
     * 
     * @param productRequest $request
     * @return Model|null
     */
    public function newProduct($request): ?Model;

    /**
     * Bring all products from products table
     * with its colors from colors table
     * and materials from materials table
     * and sizes from sizes table.
     * 
     * @return Builder|null
     */
    public function productcms(): ?Builder;

}