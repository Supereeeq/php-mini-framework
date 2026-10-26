<?php
abstract class Shape{
    abstract public function area() :float;
    public function describe() :string
    {
        return static::class . ": " . round($this->area(), 2);
        // return self::class . ": " . round($this->area(), 2);
    }
}

class Circle extends Shape{
    public function __construct(
        private int $radius
    ){}
    public function area() :float
    {
        return round(pi() * $this->radius * $this->radius, 2);
    }
}

class Rectangle extends Shape{
    public function __construct(
        private int $side
    ){}
    public function area() :float
    {
        return ($this->side * $this->side);
    }
}

$figury = array(new Circle(1), new Circle(2), new Circle(5), new Rectangle(1), new Rectangle(2), new Rectangle(5));

$opisy = array_map(fn(Shape $figura) => $figura->describe(), $figury);

echo "Opisy figur:\n";
foreach ($opisy as $opis) {
    echo "- " . $opis . "\n";
}

$suma = array_sum(array_map(fn(Shape $figura) => $figura->area(), $figury));
echo "\nSuma pól: " . $suma . "\n";