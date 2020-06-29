## Abstract class

- Abstract class use as a Base Class (Parent class)
- Object cannot be created of Abstract class
- An Abstract class is **partially(Not completed in it's own)** class
- An Abstract method is used to tell the programmer that **some method (abstract methods)** must be created in the child class.
- for example: 

		<?php
		abstract class AbstractClass
		{
		    // Forcing Extending class to define this method
		    abstract protected function getValue();

		    public function printOut() 
		    {
		        print $this->getValue() . "\n";
		    }
		}

# Important notes
- Here **getValue()** is an abstract method and it must be created without body
- Here **getValue()** method is forcing the child class to must have a method with that same name

## Interface class is basically an abstract class but

- Only public functions can be declared in it
- No constructor, no member variable


# Important notes
- All methods in it will be automatically abstract methods without even writing **abstract keyword**
- Multiple Inheritence by implements =>

		interface Logger 
		{
		    public function execute($message);
		}

		interface Manager 
		{
		    public function manage($message);
		}
		
		class LogToDatabase implements Logger,Manager 
		{
		    // Forced execute method from Logger Interface
		    public function execute($message){
		        var_dump('log the message to a database :'.$message);
		    }

		    // Forced manage method from Manager Interface
		    public function manage($message){
		        var_dump('log the message to a database :'.$message);
		    }
		}
- Interface also used in achieving polymorphism.

