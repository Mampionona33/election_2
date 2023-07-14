<?php

namespace  Api;

use controller\AuthorisationController;
use model\CandidatModel;

class CandidatApi extends Api
{
    private $candidatModel;
    private $authorisationController;

    /**
     * getter and setter
     */
    public function setAuthorisationController(AuthorisationController $authorisationController): void
    {
        $this->authorisationController = $authorisationController;
    }

    public function getAuthorisationController(): AuthorisationController
    {
        return $this->authorisationController;
    }

    public function setCandidatModel(CandidatModel $candidatModel): void
    {
        $this->candidatModel = $candidatModel;
    }

    public function getCandidatModel(): CandidatModel
    {
        return $this->candidatModel;
    }

    // ----------------------------------------------------

    public function __construct()
    {
        $this->setCandidatModel(new CandidatModel());
    }

    public function create(): void
    {

        if ($this->verifySession()) {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                // Récupérer les données du formulaire ici
                $requestData = json_decode(file_get_contents('php://input'), true);

                if (!empty($requestData)) {
                    $this->candidatModel->create($requestData);
                    $this->sendResponse(200, ["message" => "Candidat Create successfully"]);
                } else {
                    $this->sendResponse(500, ["error" => "Error when trying to create candidat"]);
                }
            }
        } else {
            $this->sendResponse(403, ["error" => "Vous n'êtes pas autorisé à faire cette action."]);
        }
    }

    public function get(): void
    {
        if ($this->verifySession()) {
            if (isset($_GET) && isset($_GET["id_candidat"])) {
                $candidat =   $this->candidatModel->getById($_GET);
                if (!empty($candidat)) {
                    $this->sendResponse(200, ["data" => $candidat]);
                } else {
                    $this->sendResponse(500, ["error" => "Error when trying to get candidat"]);
                }
            }
        }
    }

    private function verifySession(): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (
            isset($_SESSION["user"])
            && isset($_SESSION["user"][0])
            && isset($_SESSION["user"][0]["id_groupe"])
        ) {
            return true;
        }
        return false;
    }
}
