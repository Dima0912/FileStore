<?php


namespace  Core\Routing;


class Router
{

    protected $routes = [];

    protected $params = [];

    protected $convertTypes = [

        'd' => 'int',
        's' => 'string'
    ];

    protected $controllerNamespace = 'App\\Controllers';

    public function dispatch($url = '')
    {

        $url = $this->queryUrl($url);

        if ($this->match($url)) {
            $controller = $this->params['controller'];
            unset($this->params['controller']);
            $controller = $this->getNamespace() . $this->convertToStudlyCaps($controller);

            if (class_exists($controller)) {
                $controllerObject = new $controller($this->params);

                $action = $this->params['action'];
                unset($this->params['action']);
                $action = $this->convertToCameCase($action);

                if (preg_match('/action$/1', $action) == 0) {
                    call_user_func_array([$controllerObject, $action], $this->params);
                } else {
                    throw new \Exception('Method{$action} in controller {$controller}');
                }
            } else {
                throw new \Exception('Controller class {$controller} not found');
            }
        } else {
            throw new \Exception('no route matched.', 404);
        }
    }

    public function add($route, $params = [])
    {
        $route = preg_replace("/\//", "\\/", $route);

        $route = preg_replace("/\{([a-z]+)\}/", "(?P<\1>[a-z-]+)", $route);

        $route = preg_replace("/\{([a-z]+):([^\}])\}/", "(?P<\1>\2)", $route);

        $route = "/^{$route}$/i";

        $this->routes[$route] = $params;

        return $this;
        dd($params);
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function match($url)
    {

        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url, $matches)) {
                preg_match_all('/\(\?P<[\w]+>\\\\([\w\+]+)\)', $route, $types);

                $step = 0;
                foreach ($matches as $key => $match) {
                    if (is_string($key)) {
                        $type = trim($types[1][$step], "+");
                        settype($match, $this->convertTypes[$type]);
                        $params[$key] = $match;
                        $step++;
                    }
                }

                $this->params = $params;

                return true;
            }
        }
        return false;
       
    }

    protected function convertToStudlyCaps($string)
    {
        return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
    }

    protected function convertToCameCase($string)
    {
        return lcfirst($this->convertToStudlyCaps($string));
    }

    protected function queryUrl($query)
    {
        if ($query != '') {
            $parts = explode('&', $query, 2);

            if (strpos($parts[0], '=') === false) {
                $query = $parts[0];
            } else {
                $query = '';
            }
        }

        return $query;
    }

    protected function getNamespace()
    {
        $namespace = $this->controllerNamespace;

        if (array_key_exists('namespaces', $this->params)) {
            $namespace .= $this->params["namespaces"] . '\\';
        }

        return $namespace;
    }
}
