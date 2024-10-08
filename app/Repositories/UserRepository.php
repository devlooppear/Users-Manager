<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    /**
     * UserRepository constructor.
     */
    public function __construct()
    {
        parent::__construct(new User());
    }
}
