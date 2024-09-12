<?php declare(strict_types=1);

/**
 * @OA\Schema(
 *     schema="Product",
 *     type="object",
 *     title="Product",
 *     description="Product model",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="Product ID",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Name of the product",
 *         example="Product Name"
 *     ),
 *     @OA\Property(
 *         property="price",
 *         type="number",
 *         format="float",
 *         description="Price of the product",
 *         example=19.99
 *     ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         description="Description of the product",
 *         example="A brief description of the product."
 *     )
 * )
 */
