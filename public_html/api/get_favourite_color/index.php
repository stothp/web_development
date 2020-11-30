<?php
header("Content-Type: application/json");

spl_autoload_register(function ($class_name) {
    if (file_exists($class_name .'.php')) 
    {
        include $class_name . '.php';
    }
});

if (!getenv("WEBFEJLESZTES_BASE") || !getenv("WEBFEJLESZTES_CONFIG"))
{
    echo json_encode(array("error_code" => ErrorCodes::INTERNAL_ERROR), JSON_FORCE_OBJECT);
    return;
} 

if (!$ini = @parse_ini_file(getenv("WEBFEJLESZTES_BASE") . "/" . getenv("WEBFEJLESZTES_CONFIG"), true))
{
    echo json_encode(array("error_code" => ErrorCodes::INTERNAL_ERROR), JSON_FORCE_OBJECT);
    return;
}

if (!isset($_POST["email"], $_POST["password"]))
{
    echo json_encode(array("error_code" => ErrorCodes::INVALID_PARAMETERS), JSON_FORCE_OBJECT);
    return;
} 

$pw_file = getenv("WEBFEJLESZTES_BASE") . "/" . $ini["password"]["password_file"];

if (!file_exists($pw_file))
{
    echo json_encode(array("error_code" => ErrorCodes::INTERNAL_ERROR), JSON_FORCE_OBJECT);
    return;
}

$gc = new ColorQuery(
        $ini["mysql"]["host"],
        $ini["mysql"]["username"],
        $ini["mysql"]["password"],
        $ini["mysql"]["database"],
        $ini["mysql"]["port"]);

if (!$gc->query($_POST["email"]))
{
    echo json_encode(array("error_code" => ErrorCodes::INTERNAL_ERROR), JSON_FORCE_OBJECT);
    return;
}
       
if ($gc->getColor() == null)
{
    echo json_encode(array("error_code" => ErrorCodes::INVALID_EMAIL), JSON_FORCE_OBJECT);
    return;
}

$userList = new UserList($pw_file);
if (!$user = $userList->get($_POST["email"]))
{
    echo json_encode(array("error_code" => ErrorCodes::INTERNAL_ERROR), JSON_FORCE_OBJECT);
    return;
}

if (!$user->checkPassword($_POST["password"]))
{
    echo json_encode(array("error_code" => ErrorCodes::INVALID_PASSWORD), JSON_FORCE_OBJECT);
    return;
}

echo json_encode(array("color" => $gc->getColor()), JSON_FORCE_OBJECT);