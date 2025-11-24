<?php

namespace Models;

class Origin
{
    private int $id;
    private string $name;
    private string $urlImg;

    public function __construct(string $name = "", string $urlImg = "")
    {
        $this->name = $name;
        $this->urlImg = $urlImg;
    }


    public function getId(): int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }

    public function getName(): string { return $this->name; }
    public function setName(string $name): void { $this->name = $name; }

    public function getUrlImg(): string { return $this->urlImg; }
    public function setUrlImg(string $urlImg): void { $this->urlImg = $urlImg; }
}