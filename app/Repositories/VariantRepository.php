<?php
declare(strict_types = 1);

namespace App\Repositories;

use App\Variant;
use Illuminate\Database\Eloquent\Model;

class VariantRepository implements VariantRepositoryInterface
{
    /**
     * @var Variant
     */
    private $model;

    public function __construct(Variant $model)
    {
        $this->model = $model;
    }

    public function newVariant($v): ?Model
    {
        $variant = new $this->model;
        $variant->size = $v['size'];
        $variant->color = $v['color'];
        $variant->material = $v['material'];
        $variant->price = $v['price'];
        $variant->quantity = $v['quantity'];

        return $variant;
    }
}