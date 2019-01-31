<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 05.12.2018
 * Time: 9:34
 */

class Gods
{
    public $id;
    public $name;
    public $date;
    public $price;
    public $count;
    public $number;

    function __construct($id, $name, $date, $price, $count, $number)
    {
        $this->id = $id;
        $this->name = $name;
        $this->date = $date;
        $this->price = $price;
        $this->count = $count;
        $this->number = $number;
    }

    function __destruct()
    {
        // TODO: Implement __destruct() method.
    }

    function setPrice($newPrice) { $this->price = $newPrice; }

    function show(){
        echo "<tr><td>".$this->id."</td> <td>".$this->name."</td> <td> ".$this->date."</td> <td> ".$this->price."</td> <td> ".$this->count."</td> <td> ".$this->number."</td></tr>";
    }

    function toString(){
        echo "".$this->price += $this->price."";
    }
}