<?php

namespace App\Services;

use App\Models\User;

abstract class Service
{
    /**
     * @var null|User
     */
    protected $user = null;

    /**
     * @param User|null $user
     * @return $this
     */
    public function withUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return User $user
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Create new service instance
     *
     * @return $this
     */
    public static function new()
    {
        return app(static::class);
    }
}
