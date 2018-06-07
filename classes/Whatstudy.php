<?php

class Whatstudy {
    private $pest;
    private $token;

    public function __construct() {
        // Initialiseer de Pest-module met de URL van de API
        $this->pest = new PestJSON('https://whatstudy-api.clow.nl');
        $this->restoreToken();
    }

    public function login($username, $password) {
        $token = $this->pest->get('/v1/token', array(
            'number' => $username,
            'password' => $password
        ));
        $this->storeToken($token);
    }

    public function logout (){
        session_destroy();
    }
    /**
     * Sla token op in sessie
     * @param $token
     */
    private function storeToken($token) {
        $this->token = $token;
        $_SESSION['token'] = $token;
    }

    /**
     * Haal token op uit sessie indien aanwezig
     */
    private function restoreToken() {
        if (isset($_SESSION['token'])) {
            $this->token = $_SESSION['token'];
        }
    }

    public function getUserName() {
        return $this->token['name'];
    }
}