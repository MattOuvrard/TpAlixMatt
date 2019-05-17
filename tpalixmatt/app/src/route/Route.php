<?php
/**
 * Created by PhpStorm.
 * User: Alix
 * Date: 2019-04-04
 * Time: 10:58
 */

namespace App\Src\Route;

class Route
{
    private $method;

    private $pattern;

    private $callable;

    private $arguments;

    public function __construct(string $method, string $pattern, callable $callable)
    {
        $this->method = $method;
        $this->pattern = $pattern;
        $this->callable = $callable;
        $this->arguments = array();
    }

    public function match(string $method, string $uri)
    {
        if ($this->method != $method)
            return false;

        if (preg_match($this->compilePattern(), $uri, $this->arguments))
        {
            array_shift($this->arguments);

            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return $this->pattern;
    }

    /**
     * @return callable
     */
    public function getCallable(): callable
    {
        return $this->callable;
    }

    /**
     * @return array
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }


    private function compilePattern()
    {
        return sprintf('#^%s$#', $this->pattern);
    }

}