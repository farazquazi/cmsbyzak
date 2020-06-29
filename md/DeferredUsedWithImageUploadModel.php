<?php

namespace Acme\Robot\Models;

use Model;
use Db;
use Mail;

/**
 * Model
 */
class Task extends Model {

    use \October\Rain\Database\Traits\Validation;

    /*
     * Validation
     */

    public $rules = [
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'acme_robot_tasks';

    public function scopeUser($query) {
        $customers = Db::table('acme_robot_customers')->get();
        foreach ($customers as $customer) {
            return $query->where('customer', $customer->company_name);
        }
    }

    public function afterSave() {
		$this->sendEmailOfTask();
    }

    public $attachOne = [
        'featured_images' => ['System\Models\File']
    ];

	public function sendEmailOfTask(){
		$uploaded_image_path = $this->getUploadedImagePath();

		$task = DB::table('acme_robot_tasks')->where("id","=",$this->id);
		// $task->path = $uploaded_image_path;
		// $task->save();
		$task->update(['path'=>$uploaded_image_path]);

		$task_info = $task->first();
        $emailTaskVars = [
            'client_name' => $task_info->client_name,
            'client_email' => $task_info->client_email,
            'emergency_contact' => $task_info->emergency_contact,
            'task_query' => $task_info->task_query,
            'rotation' => $task_info->rotation,
            'qty_across' => $task_info->qty_across,
            'qty_around' => $task_info->qty_around,
            'teeth_qty' => $task_info->teeth_qty,
            'imaging' => $task_info->imaging,
            'stepped_query' => $task_info->stepped_query,
            'customer' => $task_info->customer,
            'project_name' => $task_info->project_name,
            'task_no' => $task_info->task_no,
            'path' => $task_info->path
        ];
        Mail::sendTo($task_info->client_email, 'acme.robot::mail.task', $emailTaskVars);
	}

	public function getUploadedImagePath(){	
		$sessionKey = post('_session_key');
		$featured_images = $this->featured_images()->withDeferred($sessionKey)->first();
        if(isset($featured_images)){
            return $featured_images->getPath();
        }
		else{
            return FALSE;
        }

    }

}
