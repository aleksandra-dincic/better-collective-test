<?php

namespace App\Support\Traits;

trait AssociativeArrayTrait
{
    /**
     * @param int $id
     * @param $data
     * @return int|null
     */
    public function findAssociativeID(int $id, $data = null): ?int
    {
        if(!$data) {
            return null;
        }

        $key = array_search($id, array_column($data, 'id'));

        return $key !== false ? $key : null;
    }
}
