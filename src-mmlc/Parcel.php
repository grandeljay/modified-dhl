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
        return $this->weight;
    }
    /** */

    /**
     * Dimensions
     */
    private function getDimension(string $dimension): float
    {
        foreach (self::$sizes as $parcel) {
            if ($this->weight <= $parcel['weight']) {
                return $parcel[$dimension];
            }
        }
    }

    public function getLength(): float
    {
        return $this->getDimension('length');
    }

    public function getWidth(): float
    {
        return $this->getDimension('width');
    }

    public function getHeight(): float
    {
        return $this->getDimension('height');
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
    }
    /** */
}
