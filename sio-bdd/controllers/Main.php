<?php

namespace controllers;

use controllers\base\Web;
use Exception;
use models\DbUser;

class Main extends Web
{
    function home()
    {
        $this->header();
        include("views/global/home.php");
        $this->footer();
    }

    function offre($id = "")
    {
        if (!$id) {
            $this->redirect("/");
        }

        if ($this->hasPreviousTeams()) {
            $this->redirect("/createOffre");
        }

        $this->header();
        include("views/global/offre.php");
        $this->footer();
    }

    function createTeam($id = "", $team = "")
    {
        $error = false;
        if ($this->hasPreviousTeams()) {
            $teams = $this->previousTeams();
        } else {
            $team = $this->normalizeName($team);

            if (!$id || !$team) {
                $this->redirect("/");
            }

            $teams = array();

            if ($id == 2) {
                // Création de deux teams
                $teams = array(
                    array("db"=> $team, "team" => $team . "-1", "password" => $this->randomPassword()),
                    array("db"=> $team, "team" => $team . "-2", "password" => $this->randomPassword()),
                );
            } else {
                // Creation d'une team
                $teams = array(
                    array("db"=> $team, "team" => $team, "password" => $this->randomPassword()),
                );
            }

            $this->saveGeneratedTeams($teams);
            try {
                $this->generateInDb($teams);
            } catch (Exception $e) {
                $error = true;
            }

        }

        $this->header();
        if(!$error) {
            $config = include ("./configs.php");
            include("views/global/end.php");
        } else {
            include("views/global/error.php");
        }
        $this->footer();
    }

    function hasPreviousTeams()
    {
        return isset($_COOKIE["teams"]);
    }

    function previousTeams()
    {
        if ($this->hasPreviousTeams()) {
            return json_decode($_COOKIE["teams"], true);
        } else {
            return array();
        }
    }


    function saveGeneratedTeams($teams)
    {
        setcookie("teams", json_encode($teams), strtotime('+365 days'));
    }

    function normalizeName($name)
    {
        $name = strtolower($name);
        $name = str_replace(" ", "-", $name);
        $name = preg_replace('/[[:^ascii:]]/', '', $name);
        return preg_replace(array('/[^\w\s\_\-]+/', '/[^a-zA-Z0-9\-\_]+/'), array('', '-'), $name);
    }

    function randomPassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    private function generateInDb($teams)
    {
        $dbUser = new DbUser();
        $dbUser->createDb($teams[0]["db"]);
        foreach ($teams as $account) {
            $dbUser->createAccount($account["db"], $account['team'], $account['password']);
        }
    }

}