<?php
declare(strict_types = 1);

namespace App\Repositories;

use App\Material;
use Illuminate\Database\Eloquent\Model;

class MaterialRepository implements MaterialRepositoryInterface
{
    /**
     * @var Material
     */
    private $model;

    public function __construct(Material $model)
    {
        $this->model = $model;
    }

    public function newMaterial($id, $material): ?Model
    {
        $Material = new $this->model;
        $Material->product_id = $id;
        $Material->material = $material;

        return $Material;
    }
}