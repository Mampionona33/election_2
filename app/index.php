<?php
// Gestion des erreurs probables

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
        $this->setPageController(new PageController());
        $this->setRouter(new Router);
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

        $this->router->handleRequest();
    }
}

$app = new App();
$app();
