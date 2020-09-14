<?php

declare(strict_types=1);

namespace App\Actions;

use App\Application\Classes\QueryParamValue;
use JsonException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;
use Slim\Views\PhpRenderer;
use Throwable;

abstract class Action
{
    /**
     * @var Request
     */
    protected Request $request;

    /**
     * @var Response
     */
    protected Response $response;

    /**
     * @var array
     */
    protected array $args;

    protected PhpRenderer $view;

    public function __construct(PhpRenderer $view)
    {
        $this->view = $view;
    }

    /**
     * @param Request  $request
     * @param Response $response
     * @param array    $args
     * @return Response
     * @throws HttpBadRequestException
     */
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;

        return $this->action();
    }

    /**
     * @return Response
     * @throws HttpBadRequestException
     */
    abstract protected function action(): Response;

    /**
     * @param string $viewName
     * @param array $params
     * @return Response
     * @throws Throwable
     */
    protected function render(string $viewName, array $params = []): Response
    {
        if (\strpos($viewName, '.php') === false) {
            $viewName .= '.php';
        }

        return $this->view->render($this->response, $viewName, $params);
    }

    /**
     * @param $data
     * @return Response
     * @throws JsonException
     */
    protected function asJson($data): Response
    {
        $json = json_encode($data, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT);
        $this->response->getBody()->write($json);

        return $this->response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
    }

    /**
     * @param string $name
     * @param $defaultValue
     * @return QueryParamValue
     */
    protected function getQueryParam(string $name, $defaultValue): QueryParamValue
    {
        $params = $this->request->getQueryParams();
        if (isset($params[$name])) {
            return new QueryParamValue($params[$name]);
        }

        return new QueryParamValue($defaultValue);
    }
}
