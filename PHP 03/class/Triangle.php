<?php

/**
 * Created by PhpStorm.
 * User: students
 * Date: 30.11.2018
 * Time: 21:37
 */
class Triangle
{
    public $a;
    public $b;
    public $c;

    public $alpha;
    public $beta;
    public $gamma;

    function __construct($a, $b, $c)
    {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }

    function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

    function getP(){
        return $this->a + $this->b + $this->c;
    }

    function getS(){
        return sqrt($this->getP() * ($this->getP() - $this->a) * ($this->getP() - $this->b) * ($this->getP() - $this->c));
    }

    function getAlpha(){
        $gradAlpha = deg2rad((pow($this->a, 2) + pow($this->c, 2) - pow($this->b,2)) / (2 * $this->a * $this->c));
        return rad2deg(cos($gradAlpha));
    }

    function getBeta(){
        $gradBeta = deg2rad((pow($this->a, 2) + pow($this->b, 2) - pow($this->c,2)) / (2 * $this->a * $this->b));
        return rad2deg(cos($gradBeta));
    }

    function getGamma(){
        $gradGamma = deg2rad((pow($this->b, 2) + pow($this->c, 2) - pow($this->a,2)) / (2 * $this->c * $this->b));
        return rad2deg(cos($gradGamma));
    }

    function getType(){
        if($this->a == $this->b && $this->b == $this->c ):
            echo "<p><img src='../img/равносторонний.png' alt=''>равносторонний</p>";
        elseif ($this->a == $this->b || $this->b == $this->c || $this->c == $this->a):
            echo "<p><img src='../img/равнобедренный.png' alt=''>равнобедренный</p>";
        elseif ($this->a*$this->a == $this->b*$this->b + $this->c*$this->c || $this->b*$this->b == $this->c*$this->c + $this->a*$this->a || $this->c*$this->c == $this->a*$this->a + $this->b*$this->b):
            echo "<p><img src='../img/прямоугольный.png' alt=''>прямоугольный</p>";
        else:
            echo "<p><img src='../img/разносторонний.png' alt=''>разносторонний</p>";
        endif;
    }


    function show(){
        echo "".$this->getType()."<p>Сторона А: ".$this->a." Сторона В: ".$this->b." Сторона C: ".$this->c."</br> Угол alpha: ".$this->getAlpha()." Угол beta: ".$this->getBeta()." Угол gamma: ".$this->getGamma()."</br> Площадь ".$this->getS()." Периметр ".$this->getP()."</p>";
    }

}