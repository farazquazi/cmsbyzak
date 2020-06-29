# Create a console command

	php artisan create:command AuthorName.PluginName MyCommand
- The above code will create a **console** folder in plugin directory and Class with name **MyCommand**

## Class File would be like this

	<?php namespace AuthorName\PluginName\Console;

	use Illuminate\Console\Command;
	use Symfony\Component\Console\Input\InputOption;
	use Symfony\Component\Console\Input\InputArgument;

	class MyCommand extends Command
	{
	    /**
	     * @var string The console command name.
	     */
	    protected $name = 'pluginname:mycommand';

	    /**
	     * @var string The console command description.
	     */
	    protected $description = 'Does something cool.';

	    /**
	     * Execute the console command.
	     * @return void
	     */
	    public function handle(){
	        if($this->confirm('do you want to see players ?')){
				$this->info("yes why not");
	        }else{
		        $this->error('Okay your Loss');
	        	$this->info($this->secret('What is the password?'));
	        }

	        $this->info($this->ask('What do you want ?'));

	        if($this->confirm('Will you ever give up ?') == FALSE){
		        $this->info('You are amazing. never think negative and never give your precious attention to wrong people');
	        }
	    }

	    /**
	     * Get the console command arguments.
	     * @return array
	     */
	    protected function getArguments()
	    {
	        return [];
	    }

	    /**
	     * Get the console command options.
	     * @return array
	     */
	    protected function getOptions()
	    {
	        return [];
	    }

	}

## Now in **Plugin.php** file, add below code. now console command has been registered

    public function register(){
        $this->registerConsoleCommand('pluginname.mycommand', '\AuthorName\PluginName\Console\MyCommand');
    }

---

## Now below command can be run from console
	php artisan pluginname:mycommand

- This command will invoke **handle()** method where you can write your business logic

## below are some functions which can be used in **handle()** method

- Sending information
	
		$this->info('Display this on the screen');
	
- Sending an error message
	
		$this->error('Something went wrong!');
	
- Asking the user for input

		$name = $this->ask('What is your name?');
	
- Asking the user for secret input

		$password = $this->secret('What is the password?');
	
- Asking the user for confirmation

		if ($this->confirm('Do you wish to continue? [yes|no]'))
		{
		    //
		}


