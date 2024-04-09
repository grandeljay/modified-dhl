<?php

namespace Grandeljay\Dhl;

class Parcel
{
    private static array $sizes = [
        [
            'weight' => 2,

            'length' => 60,
            'width'  => 30,
            'height' => 15,
        ],
        [
            'weight' => 5,

            'length' => 120,
            'width'  => 60,
            'height' => 60,
        ],
        [
            'weight' => 10,

            'length' => 120,
            'width'  => 60,
            'height' => 60,
        ],
        [
            'weight' => 31.5,

            'length' => 120,
            'width'  => 60,
            'height' => 60,
        ],
    ];

    private float $weight   = 0;
    private array $products = [];

    public function __construct()
    {
        $this->weight = (float) \SHIPPING_BOX_WEIGHT;
    }

    /**
     * Weight
     */
    public function getWeight(): float
    {
        if ($this->length > 0 && $this->width > 0 && $this->height > 0) {
            $volumetric_weight = ($this->length * $this->width * $this->height) / 5000;

            if ($volumetric_weight > $this->weight) {
                return $volumetric_weight;
            }
        }

        return $this->weight;
    }
    /** */

    /**
     * Dimensions
     */
    private int $length = 0;

    public function getLength(): int
    {
        return $this->length;
    }

    private int $width = 0;

    public function getWidth(): int
    {
        return $this->width;
    }

    private int $height = 0;

    public function getHeight(): int
    {
        return $this->height;
    }
    /** */

    /**
     * Products
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    public function addProduct(array $product): void
    {
        $this->products[] = $product['id'];
        $this->weight    += $product['weight'];

        $this->length = $product['length'] ?? 0;
        $this->width  = $product['width']  ?? 0;
        $this->height = $product['height'] ?? 0;
    }
    /** */
}
