<?php
declare(strict_types = 1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface ColorRepositoryInterface
{
    /**
     * Add new products colors to colors table.
     * 
     * @param int $id
     * @param string $color
     * @return Model|null
     */
    public function newColor($id, $color): ?Model;
}