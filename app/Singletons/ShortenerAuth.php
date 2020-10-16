<?php

namespace App\Singletons;

use App\Models\User;

class ShortenerAuth {

    private static $instance;
    private static $user;
    private static $guest = true;

    private function __construct()
    {

    }

    private function __clone()
    {

    }

    private function __wakeup()
    {

    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public static function guest()
    {
        return SELF::$guest;
    }

    public static function user()
    {
        return SELF::$user;
    }

    public static function setUser(User $user) {
        SELF::$user = $user;
        SELF::$guest = false;
    }

    public static function getInstance()
    {
        if(SELF::$instance === null) {
            SELF::$instance = new SELF;
        }

        return SELF::$instance;
    }
}
