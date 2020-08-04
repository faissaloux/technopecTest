<?php
declare(strict_types = 1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface MaterialRepositoryInterface
{
    /**
     * Add new products materials to materials table.
     * 
     * @param int $id
     * @param string $material
     * @return Model|null
     */
    public function newMaterial($id, $material): ?Model;
}