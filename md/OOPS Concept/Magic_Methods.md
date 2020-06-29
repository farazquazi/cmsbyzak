# What are Magic methods ?
- Magic methods are methods in a Class which cannot be accessed directly.
- Consider them as events for a class.


### `__construct` method 
- it will be triggered called when object is created


### `__destruct` method 
- it will be triggered called when object is destroyed


### `__get` method 
- it will be triggered when we try to access a property which is not-exist or not-accessible.


### `__set` method
- it will be triggered when we try to set a property which is not-exist or not-accessible.


### `_call` method
- it will be triggered when we try to access a not-static method which is not-exist or not-accessible.


### `_callStatic` method
- it will be triggered when we try to access a static method which is not-exist or not-accessible.


### Example of `__call` and `__callStatic` method.
- Laravel Eloquent model uses same work-flow internally


```
<?php 

class Builder
{
    public function title($param)
    {
        echo $param;
        echo "<br>";
        echo "Finally title method is called";
        echo "<br>";
        echo "Laravel eloquent model uses same workflow internally";
    }
}

abstract class Fruit
{
    // There is no static `title` method.
    // so it will call `__callStatic` Method.
    public static function __callStatic($method,$parameters){
        (new static)->$method(...$parameters);
        // We could have wright `new self` keyword but our class is abstract so object cannot be created.
        // So We create the object of apple class by writing `new static` keyword.
        // We have actually wright this (new Apple)->$method(...$parameters);
        // it is called late static bindings and it call on runtime.
        // Late static bindings references the class that was initially called.
    }

    // Now There is no `title` method.
    // so it will call `__call` Method.
    public function __call($method,$parameters){
        $this->builder()->$method(...$parameters);
        // Now we are calling `title` method from Builder class
    }

    private function builder(){
        return (new Builder);
    }

}

class Apple extends Fruit
{   
    //there is no static `title` method here so it will search in Fruit Class
}

Apple::title('Apple');//Result printed below


// Apple
// Finally title method is called
// Laravel Eloquent model uses same work-flow internally.

?>
```
