<?php

namespace App\Models;

use App\Storage\FileManagerTrait;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use FileManagerTrait;

    /**
     * @var string
     */
    public string $filename = 'users.json';

}
