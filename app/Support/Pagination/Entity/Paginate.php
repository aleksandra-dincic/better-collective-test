<?php

namespace App\Support\Pagination\Entity;

class Paginate
{
    /**
     * @var int|null
     */
    private ?int $page = null;

    /**
     * @var int|null
     */
    private ?int $size = null;

    /**
     * @param $page
     * @param $size
     */
    public function __construct($page, $size)
    {
        if($this->isValid($page, $size)) {
            $this->page = (int)$page;
            $this->size = (int)$size;
        }
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize(int $size): void
    {
        $this->size = $size;
    }

    /**
     * @param $page
     * @param $size
     * @return bool
     */
    private function isValid($page, $size): bool
    {
        return (!empty($page) && (int)$page >= 0) &&
            (!empty($size) && (int)$size > 0);
    }
}
