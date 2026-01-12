<?php
namespace PHPFrw;

class Application
{
    protected string $uri;

    public Request $request;
    public Response $response;

    public Router $router;
    public View $view;
    public Session $session;
    public Cache $cache;
    public DataBase $db;

    public static Application $app;

    protected array $container = [];

    public function __construct()
    {
        self::$app=$this;


        $this->uri = $_SERVER['REQUEST_URI'];

        $this->session = new Session();
        $this->cache = new Cache();
        $this->request = new Request($this->uri);
        $this->response = new Response();

        $this->router = new Router($this->request, $this->response);
        $this->view = new View(LAYOUT);

        $this->generatedCsrfToken();
        $this->db = new DataBase();
        Auth::setUser();
    }

    public function run(): void // void - ничего не возвращаем
    {
        echo $this->router->dispatch();
    }

    public function generatedCsrfToken(): void
    {
        if (!session()->has('csrf_token')){
            session()->set('csrf_token', md5(uniqid(mt_rand(), true)));
        }
    }

    public function set($key, $value): void
    {
        $this->container[$key] = $value;
    }

    public function get($key, $default = null)
    {
        return $this->container[$key] ?? $default;
    }

}