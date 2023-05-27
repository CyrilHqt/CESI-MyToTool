<?php
require_once("Models/MainManager.model.php");

class MainController{
    private $mainManager;

    public function __construct(){
        $this->mainManager = new MainManager();
    }

    private function genererPage($data){
        extract($data);
        ob_start();
        require_once($view);
        $page_content = ob_get_clean();
        require_once($template);
    }

    //Propriété "page_css" : tableau permettant d'ajouter des fichiers CSS spécifiques
    //Propriété "page_javascript" : tableau permettant d'ajouter des fichiers JavaScript spécifiques
    public function accueil(){
        // Toolbox::ajouterMessageAlerte("test", Toolbox::COULEUR_VERTE);

        $data_page = [
            "page_description" => "Description de la page d'accueil",
            "page_title" => "Titre de la page d'accueil",
            "view" => "views/accueil.view.php",
            "template" => "views/partials/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function login(){

        $data_page = [
            "page_description" => "Description de la page d'accueil",
            "page_title" => "Connexion à MyToTool",
            "view" => "views/login.view.php",
            "template" => "views/partials/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function todoList(){

        $data_page = [
            "page_description" => "Description de la page d'accueil",
            "page_title" => "Connexion à MyToTool",
            "view" => "views/todolist.view.php",
            "template" => "views/partials/template.php"
        ];
        $this->genererPage($data_page);
    }

    public function logout()
    {
        session_destroy();
        header('Location: index.php');
    }

    public function pageErreur($msg){
        $data_page = [
            "page_description" => "Page permettant de gérer les erreurs",
            "page_title" => "Page d'erreur",
            "msg" => $msg,
            "view" => "./views/erreur.view.php",
            "template" => "views/partials/template.php"
        ];
        $this->genererPage($data_page);
    }
}