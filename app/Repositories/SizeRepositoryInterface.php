<?php
declare(strict_types = 1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface SizeRepositoryInterface
{
    /**
     * Add new products materials to materials table.
     * 
     * @param int $id
     * @param string $size
     * @return Model|null
     */
    public function newSize($id, $size): ?Model;
}