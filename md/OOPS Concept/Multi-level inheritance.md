
## Multi-level inheritance
> PHP support Multi-level inheritance but does not support multiple inheritance.
- This means that you cannot have one class extend 2 other classes (see the extends keyword).  However, you can have one class extend another, which extends another, and so on.
- `$this` is object of first class which was initiated in multi-level inheritance. See the example.

```
class Builder
{
    public function getFields()
    {
        echo "Called ".__FUNCTION__ ." from ".get_class();
        echo "<br>";
        $this->getConfigFields();
        // Here **$this** is the object of **Apple** class 
        // So first it will search **getConfigFields()** method in Apple Class and if not found then it will search in first direct parent.
    }

    public function getConfigFields()
    {
        echo "Called ".__FUNCTION__ ." from ".get_class();
        echo "<br>";
    }
}

class Fruit extends Builder
{
    public function getConfigFields()
    {
        echo "Called ".__FUNCTION__ ." from ".get_class();
        echo "<br>";
    }
}

class Apple extends Fruit
{   
    
}

$app = new Apple;
$app->getFields();
```

