<?php

class Cargo
{
    private int $id;
    private string $nombre;
    private string $descripcion;

    public function __construct(int $id, string $nombre, string $descripcion)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setNombre(string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function setDescripcion(string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    public function __toString(): string
    {
        return "Cargo{" .
            "id=" . $this->id .
            ", nombre='" . $this->nombre . '\'' .
            ", descripcion='" . $this->descripcion . '\'' .
            '}';
    }
}
