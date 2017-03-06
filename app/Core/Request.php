<?php
namespace SimpleMVC\Core;

class Request
{
    const METHOD_VALID = ['get', 'post', 'put', 'delete'];

    private $method = null;
    private $https = false;

    public function __construct()
    {
        // Method
        $request_method = strtolower($_SERVER['REQUEST_METHOD']);

        if (!in_array($request_method, self::METHOD_VALID)) {
            throw new \Exception('Invalid request method');
        }

        $this->method = $request_method;

        // HTTPS
        $this->https = isset($_SERVER['HTTPS']);
    }

    public function getParam($param, $filter = true)
    {
        return $this->param(INPUT_GET, $param, $filter);
    }

    public function postParam($param, $filter = true)
    {
        if (!$this->isPost()) {
            return null;
        }

        return $this->param(INPUT_POST, $param, $filter);
    }

    private function param($method, $param, $filter = true)
    {
        if ($filter === true) {
            $filter_val = FILTER_SANITIZE_SPECIAL_CHARS;
        } elseif ($filter === false) {
            $filter_val = FILTER_UNSAFE_RAW;
        } else {
            $filter_val = $filter;
        }

        return filter_input(
            $method,
            $param,
            $filter_val
        );
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function isPost()
    {
        return $this->getMethod() === 'post';
    }

    public function isHttps()
    {
        return $this->https;
    }

    public function getClientIP()
    {
        if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
            return filter_input(INPUT_SERVER, 'HTTP_CF_CONNECTING_IP', FILTER_VALIDATE_IP);
        }

        return filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP);
    }
}