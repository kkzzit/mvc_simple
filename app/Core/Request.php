<?php
namespace SimpleMVC\Core;

class Request
{
    const METHOD_VALID = ['get', 'post', 'put', 'delete'];

    private $method = null;
    private $https = false;

    /**
     * Create the request object
     *
     * @throws \Exception If REQUEST_METHOD is invalid
     */
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

    /**
     * Return GET parameter if set
     *
     * @param mixed $param Parameter to get
     * @param int $filter Filter to use (http://php.net/manual/en/filter.filters.php)
     * @return mixed Parameter value or null
     */
    public function getParam($param, $filter = true)
    {
        return $this->param(INPUT_GET, $param, $filter);
    }

    /**
     * Return POST parameter if set
     *
     * @param mixed $param Parameter to get
     * @param int $filter Filter to use (http://php.net/manual/en/filter.filters.php)
     * @return mixed Parameter value or null
     */
    public function postParam($param, $filter = true)
    {
        if (!$this->isPost()) {
            return null;
        }

        return $this->param(INPUT_POST, $param, $filter);
    }

    /**
     * Actual parameter grabber
     *
     * @param int $method Method to use (POST/GET)
     * @param mixed $param Parameter to get
     * @param int $filter Filter to use (http://php.net/manual/en/filter.filters.php)
     * @return mixed Parameter value or null
     */
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

    /**
     * Get current request type
     *
     * @return string The method
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Check if current request was sent as POST
     *
     * @return bool
     */
    public function isPost()
    {
        return $this->getMethod() === 'post';
    }

    /**
     * Check if current request was sent using SSL
     *
     * @return bool
     */
    public function isHttps()
    {
        return $this->https;
    }

    /**
     * Return visitor's IP
     *
     * @return string IP
     */
    public function getClientIP()
    {
        // Check if CloudFlare is enabled. If it is then get actual user IP and not the CF one
        if (isset($_SERVER['HTTP_CF_CONNECTING_IP'])) {
            return filter_input(INPUT_SERVER, 'HTTP_CF_CONNECTING_IP', FILTER_VALIDATE_IP);
        }

        return filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_VALIDATE_IP);
    }
}