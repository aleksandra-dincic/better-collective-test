<?php

namespace App\Support\Traits;

trait IDFormatterTrait
{
    /**
     * @param array|null $data
     * @return int
     */
    public function formatID(array $data = null): int
    {
        return $data ? max(array_column($data, 'id')) + 1 : 1;
    }

}
