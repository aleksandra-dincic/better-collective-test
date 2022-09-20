<?php

namespace App\Support;

use Illuminate\Contracts\Support\Arrayable;

interface ArrayableInterface extends Arrayable
{
    /**
     * @return array
     */
    public function toArray(): array;
}
