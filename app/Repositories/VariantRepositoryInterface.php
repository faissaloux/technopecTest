<?php
declare(strict_types = 1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface VariantRepositoryInterface
{
    /**
     * Add new variants for product in variants table.
     * 
     * @param Request variants $v
     * @return Model|null
     */
    public function newVariant($v): ?Model;
}