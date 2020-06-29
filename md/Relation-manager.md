# Summary [just 5 steps to follow]

- first of all create a proper basic relationship whether it's hasmany, belongsTomany etc.
- go to Target controller and implement relation behavior and add **config_relation.yaml** file.
- go to Target model fields.yaml file and convert **type: relation** field into **type: partial** field.
- go to Target controller view directory and create **_partial.htm** file and add code **<?= $this->relationRender('field key in config_relation.yaml') ?>** in it.
- now finally go to **config_relation.yaml** file and add configuration in it.


# Relation behavior
- Relation behavior is a controller modifier used for easily managing complex model relationships on a page


- On controller, you can use **Relation behavior** like this

		public $implement = [
		    'Backend\Behaviors\RelationController',
		];
		public $relationConfig = 'config_relation.yaml';

- The **config_relation.yaml** is relation behavior configuration file and should be placed into that respective controller views directory.
- The configuration in that file depends on the relationship type(**belongsToMany or hasMany etc.**) between the target model and the related model.

# hasMany Relation
## Suppose we have hasMany relation on Post model. Example below
    
    public $hasMany = [
    	'comment' => ['\Zakir\Cricket\Models\Comment']
    ];

## Configuration in **config_relation.yaml** file.

	# ===================================
	#  Relation Behavior Config
	# ===================================

	comment:
	    label: Comment
	    view:
	        list: $/acme/blog/models/comment/columns.yaml
	        toolbarButtons: create|delete
	    manage:
	        form: $/acme/blog/models/comment/fields.yaml
	        list: $/acme/blog/models/comment/columns.yaml

- Relation records are displayed as a list (view.list).
- Create button will display a create form (manage.form).
- Add Button will display a relation record list from which you can select and add (manage.list).
- Clicking a record will display an update form (manage.form).
- Clicking Delete will destroy the record(s).
- Clicking Remove will orphan the relationship.

---

# belongsToMany Relation
## Suppose we have belongsToMany relation on User model. Example below
    
    public $belongsToMany = [
        'roles' => [
            'October\Test\Models\Role',
            'table' => 'october_test_users_roles',
			'key' => 'role_id',
			'otherKey' => 'user_id',
        ],	
    ];

## Configuration in **config_relation.yaml** file.
-  it is the same as in hasMany relation

---


# belongsToMany Relation with Pivot Data
## Suppose we have belongsToMany relation on User model. Example below
    
    public $belongsToMany = [
        'roles' => [
            'October\Test\Models\Role',
            'table' => 'october_test_users_roles',
			'key' => 'role_id',
			'otherKey' => 'user_id',
			'pivot' => ['base_price'],
            'pivotModel' => 'yk1\ykshop\Models\ProductPropertyOptionPivot',
        ],	
    ];

- **pivot**: This is very very important. these are the extra pivot columns in pivot table. These columns can be used when we save User model with Role Model or vice versa and we want to save extra data with that. 
- **pivotModel**: This is used because when need to upload an image with Pivot and add validation with other pivot fields

## Configuration in **config_relation.yaml** file.

	# ===================================
	#  Relation Behavior Config
	# ===================================

	roles:
	    label: Role
	    view:
	        list: $/acme/user/models/role/columns.yaml
	    manage:
	        list: $/acme/user/models/role/columns.yaml
	    pivot:
	        form: $/acme/user/models/role/fields.yaml

- Related records are displayed as a list (view.list).
- Clicking a record will display an update form (pivot.form).
- Clicking Add will display a selection list (manage.list), then a data entry form (pivot.form).
- Clicking Remove will destroy the pivot table record(s).


---

### How to show/render this relation manager in form.
- add a partial field in fields.yaml file. Example below

	    comment:
	        label: Kit
	        span: left
	        type: partial
	        path: kit
- the path == **kit** will be .htm file in controller view folder 
- now add **<?= $this->relationRender('comments') ?>** in that .htm file
- here **comments** is the key used in **config_relation.yaml** file.

### How to refresh relation manager **view.list**
- **$this->listRefresh()** work on listBehavior 
- but if you have added relation manager in a form then it won't be refresh as a list
- so you need to add below code

        $this->initForm($formModel);
        $this->initRelation($formModel,"field key in config_relation.yaml");
		return $this->relationRefresh("field key in config_relation.yaml");

