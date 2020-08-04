<?php
declare(strict_types = 1);

namespace App\Repositories;

use App\Size;
use Illuminate\Database\Eloquent\Model;

class SizeRepository implements SizeRepositoryInterface
{
    /**
     * @var Size
     */
    private $model;

    public function __construct(Size $model)
    {
        $this->model = $model;
    }

    public function newSize($id, $size): ?Model
    {
        $Size = new $this->model;
        $Size->product_id = $id;
        $Size->size = $size;

        return $Size;
    }
}