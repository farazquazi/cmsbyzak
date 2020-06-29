
# Laravel/OctoberCMS Service Container

## Auto-Resolving
- Laravel `Auto-resolve` dependency of dependency of dependency and so on... until dependency remain a Class

		use Bowler
		class Cricket extends Controller
		{
		    public function handle(Bowler $player)
		    {
		        return $player->name(12);
		    }
		}  

- In above example, Laravel `Service Container` will automatically resolve the dependency of `Bowler` Class and so on..
- Here Class `Cricket` is depend on `object` of class `Bowler`.
- it means `Cricket` should not responsible for creating an object of Class `Bowler` and that is why we have used Dependency injection.
- Laravel can only `Auto-resolve` until dependency is injected.

## Bind To The Container
- Now suppose `Bowler` class has `Translator` Class dependency

		use Translator;
		class Bowler
		{
		    private $translator;
		    public function __construct(Translator $translator)
		    {
		        $this->translator = $translator;
		    }
		    public function name(int $userId)
		    {
				//return name
		    }
		}

- And Translator class is

		class Translator
		{
		    private $language;
		    public function __construct(string $language)
		    {
		        $this->language = $language;
		    }
		    public function translate(string $word)
		    {
		        // Translate word...
		    }
		}

- Now Auto-resolve won't work because it does not know from where `string` will come into translator Class constructor.
- and in this situation, we need to manually tell Laravel how to use this `string` dependencies.
- so for this case we will use `Binding` feature of `Service Container`.

	    $this->app->bind(Bowler::class, function() {
			return new Bowler(new Translator(config('app.locale')));
	    });

- In OctoberCMS, The above code can be written in boot method of `Plugin.php` 
- or can be written in Service Provider. in Laravel we will always written it in `register` method of Service provider.

## Bind To Interface
-   Suppose I have another class `Batsmen` which must have an `name` method.
-   So I am gonna use interface `PlayerProfile` on both `Batsmen` and `Bowler` Class.
	
		interface PlayerProfile{
			public function name();
		}

-	So My `Bowler` Class

		use Translator;
		class Bowler implements PlayerProfile
		{
		    private $translator;
		    public function __construct(Translator $translator)
		    {
		        $this->translator = $translator;
		    }
		    public function name(int $userId)
		    {
				//return Bowler name
		    }
		}

-	And `Batsmen` Class would be

		use Translator;
		class Batsmen implements PlayerProfile
		{
		    private $translator;
		    public function __construct(Translator $translator)
		    {
		        $this->translator = $translator;
		    }
		    public function name(int $userId)
		    {
				//return Batsmen name
		    }
		}

-	And if I need bowler profile then I just need to change binding like this:

	    $this->app->bind(PlayerProfile::class, function() {
			return new Bowler(new Translator(config('app.locale')));
	    });

-	And if I need batsmen profile then I just need to change binding like this:

	    $this->app->bind(PlayerProfile::class, function() {
			return new Batsmen(new Translator(config('app.locale')));
	    });

-  Now i can just use type-hint in handle method and then I won't have to change this code ever again.

		use PlayerProfile
		class Cricket extends Controller
		{
		    public function handle(PlayerProfile $player)
		    {
		        return $player->name(12);
				// OR
				// $player = \App::make(PlayerProfile::class);
		        // return $player->name(12);
		    }
		} 

## Sharing An Instance: use singleton

	    $this->app->singleton(PlayerProfile::class, function() {
			return new Batsmen(new Translator(config('app.locale')));
	    });

### we can also pass true in 3rd parameter of bind method to make it singleton

	    $this->app->bind(PlayerProfile::class, function() {
			return new Batsmen(new Translator(config('app.locale')));
	    },TRUE);

### 2 Advantages of singleton.

**Store State**
	- When you store some information inside an instance that should still be there when another part of your application resolves it, then it makes sense to create a singleton.

**Performance**
	- You maybe have lots of dependencies you need to take care of, load configurations and more so singleton will improve your performance


## Check if App is in running in backend
	App::runningInBackend();

## Check if App is in running in console
	App::runningInConsole();
