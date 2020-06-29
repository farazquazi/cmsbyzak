# Dependency Injection and type hinting

- When a class depends on another class, it actually depends on `object` of that class.
- So dependency injection provides us a way to create a `Direct object` of that class.
- While creating an object, it also Auto-resolve dependency of dependency of dependency and so on.. of classes. you will learn more about it in Service container Document.

## For Example: 

	Use A;
	class B
	{
	    public function __construct(A $a){
	    	//use $a object here 
	    }

	    public function c(A $a){
	    	//use $a object here 
	    }

	}

- Here we passed $a object in contstructor and function in Class B with Type-hinting **A**
- Type-hinting is to check whether **$a** object data type is of Class **A**
