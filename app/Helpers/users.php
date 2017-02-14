<?php

/**
 *
 * Check if the user is logged in
 *
 * @return bool
 */
function isLoggedIn() {
    if(Auth::check()) {
        return true;
    }
    return false;
}

/**
 * Determine if the user is an administrator
 *
 * @return bool
 */
function isAdmin() {
    if(isLoggedIn()) {
        $role = Auth::user()->role;

        if($role == "admin" || $role == "super_admin") {
            return true;
        }
    }
    return false;
}

/**
 * Determines if the user is a student
 *
 * @return bool
 */
function isEditor() {
    if(isLoggedIn()) {
        $role = Auth::user()->role;

        if($role == "editor") {
            return true;
        }
    }
    return false;
}

/**
 * Determine if the user is a member of staff
 *
 * @return bool
 */
function isMember() {
    if(isLoggedIn()) {
        $role = Auth::user()->role;

        if($role == "member") {
            return true;
        }
    }
    return false;
}