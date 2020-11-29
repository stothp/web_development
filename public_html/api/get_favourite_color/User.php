<?php

class User
{   
    public string $email;
    private string $password;

    function __construct($encryptedData)
    {
        $data = Encoder::decrypt($encryptedData);
        list($this->email, $this->password) = explode("*", $data);
    }

    public function checkPassword ($password): bool
    {
        if ($password == $this->password)
        {
            return true;
        } 
        else 
        {
            return false;
        }
    }
}
    