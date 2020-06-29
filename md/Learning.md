### Pages, partials and layout templates can include up 
to 3 sections. 
Configuration = this section sets the template parameters.
PHP code = "all code should be written between functions like in onStart() or orEnd() etc."
Twig markup = "This section defines the markup to be rendered."

### page variables can be prepared in the PHP Section of the page or 
layout or by Components

### The properties of a page can be accessed in
the PHP code section or Components by 
referencing $this->page.

### use the {% styles %} and {% scripts %} tags 
to print css and js added dynamically by php code
for example we can add css and js in component 
onRun() method like these : 
	
	<?php 
	public function onRun(){
		$this->addCss('assets/css/hello.css');
		$this->addJs('assets/js/app.js');
	}
	?>

=====================================
### Partials
Partials are extremely useful for page elements that repeat on different pages or layouts.

A good partial example is partial header/footer which is used in different layouts. 
Also, partials are required for updating the page content with AJAX.

### Very Important: try to avoid use of component 
in partial because it rendered late in request lifecycle. 

=====================================
### Components

When you add a component to a page or layout then
it automatically creates a page variable that matches
the component name for example:

[demoTodo]
==
{% component 'demoTodo' %}

### Note: If two components with the same name are
assigned to a page and layout together, the page
component overrides any properties of the layout component.

### use of alias component
[demoTodo myTodo]

### pass value to component properties
[demoTodo]
itemID = {{ :itemid }} // it will fetch itemid slug from url 

### component added on partial can use parameter passed from page like that 

{% partial 'blog/post-detail' postslug='cricket' %}

now this `postslug` variable can be use in that `post-detail` partial.

### Overriding component partials
for example: in plugin component directory we have
"blogpost/default.htm"

then it can be override in themes/<THEME_NAME>/partials directory by 
creating a folder with same name as component has
"blogpost/default.htm"

or we can use component alias also and use like that
	
	[blogpost zakir]

	{% component 'zakir' %}

	"zakir/default.htm"


=====================================
#Event Hook are of two types
## Global Event Hook
	<?php 
		\Event::listen('media.file.upload', function($widget, $newPath) {
			if(@explode('/',$newPath)[1] == 'images'){
				$filename = basename($newPath);
				// now make a remote request to "site 2"
				$laravel_upload_path = 'http://www.quickwill.com/zr_image_upload/'.$filename;
				file_get_contents($laravel_upload_path);
			}
		});
	?>

## Local event hook
	<?php 
	 User::extend(function($model) {
	    $model->bindEvent('model.getAttribute', function($attribute, $value) {
	        if ($attribute == 'foo') {
	            return 'bar';
	        }
	    });
	});
	?>

======================================

# Variable concate with twig filters
	<link href='{{("assets/css/custom-style.css?ver="~time_in_sec)|theme }}' rel="stylesheet">


# Techniques for assigning variable in Twig
	{% set find_more_link %}
		{{ url() }}/search?{{ Result.saved_query_string }}
	{% endset %}

	{% set find_more_link = "zakir" %}

=======================================

# Partial Update Front End Code
	
	<a rel="nofollow" 
		data-request="ModifiedProductsByCategory::onProductFilter" 
	    data-request-data="'orderBy':'retail_price_with_tax','sort':'asc'"
		data-request-update="'filter/product_filter': '#products-grid'"
	    class="select-list" title="Price, low to high">
	{{ 'Price, low to high'|_ }}
	</a>


<div id="products-grid" class="products-grid">
	{% partial 'filter/product_filter' productsPagination=productsPagination %}
</div>

========================================

	<script type="text/javascript">
	//show ajax page indicatior on header when ajax called from javascript api
	$.oc.stripeLoadIndicator.show();
	</script>

========================================

# For form fields:
Mediafinder field type should have a field in database but fileupload and and image should have attachOne relationship and gallery should have attachMany relationships on model. 

=========================================

#	Add dynamic method to controllers and models through other plugins

	<?php 
	\PeterHegman\SlickSlider\Models\SlideShows::extend(function($model) {
		$model->addDynamicProperty('translatable',[]);
	    $model->translatable[] = 'slide_show_content';
	});
	?>

==========================================

# Add and remove forms field through other plugins

	<?php 
	\Jiri\JKShop\Controllers\Categories::extendFormFields(function($widget) {
	    // Prevent extending of related form instead of the intended User form
	    if (!$widget->model instanceof \Jiri\JKShop\Models\Category) {
	        return;
	    }
		$widget->removeField('holder');
		$widget->removeField('parent');
	    $configFile = __DIR__ . '/config/category_fields.yaml';
	    $config = \Yaml::parse(\File::get($configFile));
	    $widget->addTabFields($config);
	});
	?>

===========================================

# Extend Plugin Controller and Change Html Portion of it
	
	<?php 
	\RainLab\User\Controllers\User::extend(function($controller) {
		$custom_view_paths = __DIR__.'users';
		$controller->addViewPath($custom_view_paths);
		// here $custom_view_paths must be the same view folder as we have on User Controller but now you can change the codes in new view folder
	});
	?>

===========================================
# Run your plugin after all the other plugins loaded first in Plugin.php file
	
	<?php
	public function boot(){
		\App::before(function() { 
			/*Write your code here*/
		});
	}
	?>

# Check if App is running in backend area of admin
	
	<?php
	if (\App::runningInBackend()) {
	    $model->addJsonable('service_details');
	    $model->addJsonable('requirements');
	}
	?>

============================================

<!-- Very Very important -->
<!-- Very Very important -->
This controller is responsible for front-end cms pages.
#) it can generate a page url by its baseFileName with parameters
#) a lot of more functionalities is there. please learn it from basic
/modules/cms/classes/Controller.php
<!-- Very Very important -->
<!-- Very Very important -->
=============================================

	<?php 
	#To get all CMS page object lists
	$cmspages = \Cms\Classes\Page::listInTheme(\Cms\Classes\Theme::getActiveTheme(), true);

	#To get all static page object list
	$staticPages = \RainLab\Pages\Classes\Page::all();

	#To get a single CMS Page object by its filename
	$pageObject = \Cms\Classes\Page::loadCached(\Cms\Classes\Theme::getActiveTheme(), 'blog-category.htm');
	?>

=============================================
# On any model you can add a custom attribute which will be available whenever that model fetched.
## You can add it like it on a model and it will be available with as 
	<?php 
	public function getZakirAttribute(){
	   return "dfdffdf";
	}
	?>

=============================================

# Every model already have a method getDateFormat() in it.
# so a new method with that getDateFormat() name will be a duplicate.
# and \Carbon class will show you problems of trailing data.

=============================================






