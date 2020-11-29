<?php

class UserList
{
    private array $users;

    public const INVALID_USER = 1;

    function __construct($encryptedFn)
    {
        $this->users = array();
        if (!$f = fopen($encryptedFn, "rb"))
        {
            throw new Exception ("Error during opening the file.");
        }
        while ($encryptedLine = fgets($f))
        {
            $this->add(new User(trim($encryptedLine)));
        }        
    }    

    public function add(User $user)
    {
        $this->users[$user->email] = $user;
    }

    public function get ($email): ?User
    {
        if (!isset($this->users[$email]))
        {
            return null;
        } 
        else 
        {
            return $this->users[$email];
        }        
    }
}