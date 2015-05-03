<?php

class Application {

    /**
     * utiliser pour sercuriser les input et les output
     * Plus precisement les GET, POST, COOKIE
     * @var type Input
     */
    protected $input;
    protected $menus;

    function __construct() {
        $this->set_reporting();
        $this->remove_magic_quotes();
        $this->unregister_globals();

        $this->input = new Security();

        $this->input->sanitize_globals();
        /*
         * GERER LA REDIRECTION SI L'UTILISATEUR N'EST PAS AUTHENTIFIER
         */
        global $url;
        //$url est une variable globale defini dans Router.php
        $urlArray = explode("/", $url);
        /**
         * $urlArray[0] = Controller
         * $urlArray[1] = Action
         * $urlArray[2...n] = Argument
         */
        $action = (isset($urlArray[1]) && $urlArray[1] != '') ? $urlArray[1] : DEFAULT_ACTION;
        /*
         * Pour eviter une redirection qui n'aboutira, 
         * On redirige seulement si nous ne somme pas a la page de connexion
         * 
         */
        if (!$this->connected() && $urlArray[0] != 'connexion') {
            header("Location:" . url('connexion'));
        } elseif ($this->connected() && $urlArray[0] == 'connexion' && $action != 'deconnect') {
            //Si je clique sur deconnect et que je suis dans le controller connexion
            //deja gerer par le constructeur de connexionController
        }
        $this->menus = new Menus();
    }

    private function set_reporting() {
        if (DEVELOPMENT_ENVIRONMENT == true) {
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');
        } else {
            error_reporting(E_ALL);
            ini_set('display_errors', 'Off');
            ini_set('log_errors', 'On');
            ini_set('error_log', ROOT . DS . 'tmp' . DS . 'logs' . DS . 'error.log');
        }
    }

    private function strip_slashes_deep($value) {
        $value = is_array($value) ? array_map(array($this, 'strip_slashes_deep'), $value) : stripslashes($value);
        return $value;
    }

    private function remove_magic_quotes() {
        if (get_magic_quotes_gpc()) {
            $_GET = $this->strip_slashes_deep($_GET);
            $_POST = $this->strip_slashes_deep($_POST);
            $_COOKIE = $this->strip_slashes_deep($_COOKIE);
        }
    }

    private function unregister_globals() {
        if (ini_get('register_globals')) {
            $array = array('_SESSION', '_POST', '_GET', '_COOKIE', '_REQUEST', '_SERVER', '_ENV', '_FILES');
            foreach ($array as $value) {
                foreach ($GLOBALS[$value] as $key => $var) {
                    if ($var === $GLOBALS[$key]) {
                        unset($GLOBALS[$key]);
                    }
                }
            }
        }
    }

    /**
     * Renvoi vrai ou faux si l'utilisateur est connected
     * S'il connected === false, alors diriger vers la page
     * d'authentification
     */
    private function connected() {
        if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
            return true;
        } else {
            return false;
        }
    }

}
