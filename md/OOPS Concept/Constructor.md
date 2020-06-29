# Constructor is called when an Object is created so it means you can initialize the object before creating.

```
    <?php
    Class Test{
        
        public $name;
        
        public function __construct($name){
            echo "Construct called";
            $this->name = $name;
        }
    }

    $a = new Test('zakir'); //Constructor is called
```

# 3 Concepts for constructor calling between parent and child class.

- When Child Class doesn't have constructor then it will be called from Parent Class.

```
    Class Test{
        public function __construct(){
            echo "This is Test class constructor";
            }

    class Subtest extends Test{

    }

    $a = new Subtest();// only parent constructor is called
```

- When Child Class have constructor then only Child class cnstructor will be called.

```
    Class Test{

        public function __construct(){
            echo "This is Test class constructor";
        }
    }

    class Subtest extends Test
    {
        public function __construct()
        {
            parent::__construct();
            echo "This is subclass constructor";
        }
    }

    $a = new Subtest();// only child constructor called
```

- Include parent class construtor with Child Class so both will be called.

```

    Class Test{

        public function __construct(){
            echo "This is Test class constructor";
        }
    }

    class Subtest extends Test
    {
        public function __construct()
        {
            parent::__construct();
            echo "This is subclass constructor";
        }
    }

    $a = new Subtest();// child constructor called with parent constructor
```
