<?php

namespace App;

use Illuminate\Support\Facades\Session;

class Acl
{
    private static $rules = "";
    private static $allow = [];
    private static $deny = [];

    public static function allow($role, $actions=[])
    {
        self::$allow[$role] = $actions;
    }

    public static function isAllowed($role, $action) {

        if(!self::isNotAllowed($role))
        {
            return false;
        }

        $rules = self::$allow;
        if(!array_key_exists($role, $rules))
        {
            return false;
        }

        if(count($rules[$role]) == 0) {
            self::reset();
            return true;
        }
        foreach($rules[$role] as $rule) {
            if($rule == $action) {
                self::reset();
                return true;
            }
        }
        self::reset();
        return false;
    }

    public static function deny($role, $actions = [])
    {
        self::$deny[$role] = $actions;
    }

    public static function isNotAllowed($role) {
        $rules = self::$deny;
        if(array_key_exists($role, $rules))
        {
            self::reset();
            return false;
        }
        return true;
    }

    public static function getRules($rules) {

        $acl = [];

        $ruleParts = explode(":", $rules);

        $role = $ruleParts[0];

        if (strpos($ruleParts[1], '|') !== false) {
            $aclParts = explode("|", $ruleParts[1]);
            $acl = [$role => $aclParts];
        } else {
            $acl = [$role => $ruleParts[1]];
        }
        return $acl;
    }

    private static function reset() {
        self::$allow = [];
    }
}