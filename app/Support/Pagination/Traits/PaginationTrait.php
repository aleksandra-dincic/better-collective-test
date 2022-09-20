<?php

namespace App\Support\Pagination\Traits;

use App\Support\Pagination\Entity\Paginate;
use Illuminate\Support\Collection;

trait PaginationTrait
{
    /**
     * @var int
     */
    private static int $maxPerPage = 50;

    /**
     * @return Paginate
     */
    public function getPagination(): Paginate
    {
        $pageNum = request('page');
        $page = (int) $pageNum && $pageNum > 0 ? $pageNum : 1;

        $pageSize = request('size');
        $size = (int) $pageSize && $pageSize > 0 && $pageSize <= static::$maxPerPage ? $pageSize : static::$maxPerPage;

        return new Paginate($page, $size);
    }

    /**
     * @param Paginate $pagination
     * @param Collection $data
     * @return array
     */
    public function getPaginationMetaData(Paginate $pagination, Collection $data): array
    {
        return [
            'page' => $pagination->getPage(),
            'per_page' => $pagination->getSize(),
            'total' => !empty($data) ? $data->count() : 0
        ];
    }
}
