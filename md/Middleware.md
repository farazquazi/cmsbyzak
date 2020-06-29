
# Middleware

-	Middleware filter the HTTP requests entering your application.
-	It's best to envision middleware as a series of "layers" and HTTP requests must pass through it before they hit your application. Each layer can examine the request and even reject it entirely.
-	All middleware are resolved via the service container, so you may type-hint any dependencies you need within a middleware's constructor.


## in Octobercms, You can use plugin `boot()` method to register new middleware like this:

	public function boot()
	{
	    // Add a new middleware to beginning of the stack.
	    $this->app['Illuminate\Contracts\Http\Kernel']
	         ->prependMiddleware('Path\To\Custom\Middleware');

	    // Add a new middleware to end of the stack.
	    $this->app['Illuminate\Contracts\Http\Kernel']
	         ->pushMiddleware('Path\To\Custom\Middleware');
		
		

and if you want to add it in CMS controller only then write this:

	    \Cms\Classes\CmsController::extend(function($controller) {
	        $controller->middleware('Path\To\Custom\Middleware');
	    });

Same you can do for Backend controller

	    \Backend\Classes\Controller::extend(function($controller) {
	        $controller->middleware('Path\To\Custom\Middleware');
	    });

	}

## and if you want to add specifically for any backend controller then add it in constructor of that controller

	public function __construct()
	{
	    parent::__construct();
	    $this->middleware(function ($request, $response) {
	        // Middleware functionality
	    });
	}