<?php

namespace App;

use Controller\Controller;

class Page
{
    public $title = 'Select2 Provinces';
    public TagBody $body;
    public TagHtml $html;

    public Controller $controller;
    public string $action;

    public function __construct(array $configs)
    {
        $this->title = $configs['title'] ?? $this->title;
        $this->body = new TagBody();
        $this->html = new TagHtml();
        $this->controller = $configs['controller'];
        $this->action = $configs['action'];
    }

    public function body(): string
    {
        return $this->controller->{$this->action}();
    }
}
