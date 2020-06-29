## In **Plugin.php**, Register schedule like that

    public function registerSchedule($schedule){
        $schedule->call(function () {
        	// write your business logic here
        })->daily();
    
    //Or you can schedule a console command like that

		$schedule->command('cricket:showplayers')->daily();

    }

- above are the 2 ways of scheduling any task.

## For scheduled tasks to operate correctly, you should add the following Cron entry to your server. if you are on ssh then run **crontab -e** to open that file.

	* * * * * php /full root path/artisan schedule:run >> /dev/null 2>&1

- Be sure to replace /full root path/artisan with the absolute path to the artisan file in the root directory of OctoberCMS

## Why we are setting up scheduling twice ?
- The Octobercms has more **Schedule options** then we can have in Cron setup-ed on server.

## How it will work ?
- The Cron from server will call the octobercms command scheduler every minute or every hour whetever we setup there 
- and then OctoberCMS will run any scheduled tasks setup in it.

## Schedule options => 

### Run the task every minute
	->everyMinute();

### Run the task every five minutes
	->everyFiveMinutes();

### Run the task every ten minutes
	->everyTenMinutes();

### Run the task every thirty minutes
	->everyThirtyMinutes();

### Run the task every hour
	->hourly();

### Run the task every day at midnight
	->daily();

### Run the task every day at 13:00
	->dailyAt('13:00');

### Run the task daily at 1:00 & 13:00
	->twiceDaily(1, 13);

### Run the task every week
	->weekly();

### Run the task every month
	->monthly();

