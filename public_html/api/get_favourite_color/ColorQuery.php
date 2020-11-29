<?php

class ColorQuery
{
    private string $host, $username, $password, $database, $port;
    private ?string $color;
    private static array $colorCodes = array(
        "piros" => "red",
        "zold" => "green",
        "sarga" => "yellow",
        "kek" => "blue",
        "fekete" => "black",
        "feher" => "white"
    );

    function __construct($host, $username, $password, $database, $port)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->port = $port;
        $this->color = null;
    }

    function query($email): bool
    {
        $this->color = null;
        $mysqli = new mysqli($this->host, $this->username, $this->password, $this->database, $this->port);
        if ($mysqli->connect_errno)
        {
            return false;
        }

        $prep = $mysqli->prepare("SELECT Titkos FROM tabla WHERE Username=?");
        $prep->bind_param("s", $email);
        $prep->execute();
        if ($prep->affected_rows > 0)
        {
            $prep->bind_result($titkos);
            $prep->fetch();

            if (!isset(self::$colorCodes[$titkos]))
            {
                return false;
            }

            $this->color = self::$colorCodes[$titkos];
        }
        $prep->close();
        $mysqli->close();
        
        return true;
    }   

    function getColor(): ?string
    {
        return $this->color;
    }       
}