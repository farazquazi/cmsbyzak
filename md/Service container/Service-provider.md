# Service providers
-	Service providers are a great way to create libraries
-	you might register a custom authentication driver, register your application's repository classes with the Service container, or even setup a custom Artisan command.


# Define a service provider
-	To create a service provider, simply extend the `October\Rain\Support\ServiceProvider` class and define a register method:
- 	You must create a folder (For example: `service_providers` ) in Plugin root folder and create a file with below class.

		class FooServiceProvider extends \October\Rain\Support\ServiceProvider
		{
		    public function register()
		    {
			    $this->app->bind(PlayerProfile::class, function() {
					return new Batsmen(new Translator(config('app.locale')));
			    });
		    }
		}

- Now add this in `providers` array of `config/app.php` or dynamically register like below code in boot method of `Plugin.php`

		App::register('Your service provider with name space');

# Register method and Boot method

-	Register method must be used only to register Service container `bindings` only.
-	Boot method is called after all other service providers have been registered  meaning you have access to all other services that have been registered by the framework

