<?php

interface Car
{
    function start();
    function stop();
}

class Tesla implements Car
{
    protected string $model;
    function __construct(string $model)
    {
        $this->model = $model;
    }

    public function start()
    {
        echo "Tesla " . $this->model . "is starting silently.\n";
    }

    public function stop()
    {
        echo "Tesla " . $this->model . "is stopping silently.\n";
    }
}


$teslaCar = new Tesla("Model S");
$teslaCar->start();
