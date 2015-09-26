<?php
class Base_Model
{
    private $dbc;
    function __construct()
    {
        try {
            $dbc = new PDO("mysql:host=$MYSQL_SERVER;dbname=$MYSQL_DBNAME", $MYSQL_USERNAME, $MYSQL_USERPASS);
            $dbc->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e){
            throw new ResourceFailed($e->getMessage());
        }
    }
}
class Base_Controller
{
}
class Base_View
{
}
?>