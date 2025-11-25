<?php

namespace Helpers;

class Message
{
    public const COLOR_SUCCESS = "success";
    public const COLOR_ERROR   = "error";
    public const COLOR_INFO    = "info";

    private string $content;
    private string $color;
    private string $title;

    public function __construct(string $content, string $color = self::COLOR_INFO, string $title = "")
    {
        $this->content = $content;
        $this->color   = $color;
        $this->title   = $title;
    }

    public function getContent(): string { return $this->content; }
    public function getColor(): string { return $this->color; }
    public function getTitle(): string { return $this->title; }
}
