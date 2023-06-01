<?php
require_once 'Modeles/monPdo.php';

class PlanningModel
{
    public static function getPlanning()
    {
        $req = monPdo::getInstance()->prepare("SELECT * FROM planning");
        $req->execute();
        $planning = $req->fetch();
        return $planning;
    }

    public static function updatePlanning($planning)
    {
        $req = monPdo::getInstance()->prepare("UPDATE planning SET planning = :planning");
        $req->bindParam(':planning', $planning);
        $req->execute();
    }

    public static function securiser($donnees)
    {
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;
    }

}
