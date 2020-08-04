<?php
declare(strict_types = 1);

namespace App\Repositories;

use App\Color;
use Illuminate\Database\Eloquent\Model;

class ColorRepository implements ColorRepositoryInterface
{

    /**
     * @var Color
     */
    private $model;

    public function __construct(Color $model)
    {
        $this->model = $model;
    }

    public function newColor($id, $color): ?Model
    {
        $Color = new $this->model;
        $Color->product_id = $id;
        $Color->color = $color;
        return $Color;
    }
}