
## What is behavior
=> Behavior is just like trait but
	=> Behaviors can have their own constructor.
	=> Classes can be extended with behaviors dynamically.
=> they also known as "Private traits"

##Notes
=>  The first parameter to the Behavior's constructor will always be the object of the class which implement this behavior.
=>  Any class that uses the Extendable or ExtendableTrait can be extended by a static method "extend", check below
	MyNamespace\Class::extend(function($class_contructor_para_1,$class_contructor_para_2 and so on ..) {
	    //
	});
	=> here the closure function will have the class constructor parameters


##Conclusion
=> \October\Rain\Extension\ExtensionBase == extend any class to make it a Behavior class

=> \October\Rain\Extension\Extendable == extend the class by this, in which you want to -implement- the Behaviour Class

=> Every model and controller of octobercms already extending "\October\Rain\Extension\Extendable" so it means any behavior can be implemented into them and property or method can be added into them anytime. Amazing Feature !!!