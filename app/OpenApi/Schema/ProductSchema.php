<?php declare(strict_types=1);

namespace App\OpenApi\Schema;

/**
 * @OA\Schema(
 *     schema="Product",
 *     type="object",
 *     @OA\Property(property="id", type="integer", description="Product ID"),
 *     @OA\Property(property="name", type="string", description="Product name"),
 *     @OA\Property(property="price", type="number", format="float", description="Product price"),
 *     @OA\Property(property="description", type="string", description="Product description")
 * )
 */
class ProductSchema
{
}
