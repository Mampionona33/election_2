<?php
// Gestion des erreurs probables

use controller\AuthController;
use controller\PageController;
use lib\Autoload;
use router\Router;

error_reporting(E_ALL);
ini_set('display_errors', '1');
// ----------------------------

require_once './lib/Autoload.class.php';

final class App
{
    private $router;
    private $autoload;
    private $pageController;
    private $authController;

    public function setAuhController(AuthController $authController): void
    {
        $this->authController = $authController;
    }

    public function getAuthController(): AuthController
    {
        return $this->authController;
    }

    public function setPageController(PageController $pageController): void
    {
        $this->pageController = $pageController;
    }

    public function getPageController(): PageController
    {
        return $this->pageController;
    }

    public function setAutoLoad(Autoload $autoload): void
    {
        $this->autoload = $autoload;
    }

    public function getAutoLoad(): Autoload
    {
        return $this->autoload;
    }

    public function setRouter(Router $router): void
    {
        $this->router = $router;
    }

    public function getRouter(): Router
    {
        return $this->router;
    }

    public function __construct()
    {
        $this->setAutoLoad(new Autoload());
        spl_autoload_register([$this->autoload, "loadClass"]);
        $this->authController = new AuthController();
        $this->setRouter(new Router);
        $this->pageController = new PageController($this->authController);
    }

    public function __invoke()
    {
        /**
         * equivalent a :
         * $this->router->get("/", function () {
         *      $this->userController->handleHome();
         * });
         */
        $this->router->get("/", [$this->pageController, "renderHomePage"]);
        $this->router->get("/login", [$this->pageController, "renderLoginPage"]);
        $this->router->post("/login", [$this->authController, "handleLogin"]);
        $this->router->get("/dashboard", [$this->pageController, 'renderDashboard']);
        $this->router->get("/logout", [$this->authController, "handleLogout"]);

        $this->router->handleRequest();
    }
}

// session_save_path(__DIR__ . "/tmp");

$app = new App();
$app();
