<?php

namespace App\Storage;

use Illuminate\Support\Facades\Storage;

trait FileManagerTrait
{
    /**
     * @return bool
     */
    public function doesFileExist(): bool
    {
       return Storage::disk()->exists( $this->filename);
    }

    /**
     * @return array|null
     */
    public function getFromFile(): ?array
    {
        return json_decode(Storage::disk()->get($this->filename));
    }

    /**
     * @param array $data
     * @return void
     */
    public function storeInFile(array $data): void
    {
        Storage::disk()->put( $this->filename, json_encode($data));

        $this->setFileToPrivate();
    }

    /**
     * @return void
     */
    public function setFileToPrivate(): void
    {
        Storage::disk()->setVisibility($this->filename, 'private');
    }

}
