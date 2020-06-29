# Model Relationship =>
- Model Relationship are relations between one model to other model.
- More then two models can also have relationships.


# Example =>
- A post can have can have multiple comments (i.e. **hasMany** relation) and comment will atleast **belongsTo** one post. 
- A user can have multiple roles and a role can be assigned to multiples users. (i.e. **belongsToMany** or **Many to Many** relation)


====================================================================


# HasMany relation.
	<?php 
	class Post extends Model
	{

		## a post can have multiple comments
	    public $hasMany = [
	        'comments' => ['Acme\Blog\Models\Comment','key' => 'post_id','otherKey'=>'id']
	    ];
	}
	?>

# BelongsTo relation.
	<?php 
	class Comment extends Model
	{	
		## but a comment can only belong to one post
	    public $belongsTo = [
	        'post' => ['Acme\Blog\Models\Post','key' => 'post_id']
	    ];
	}
	?>

# Notes: 
- **Hasmany** and **belongsTo** will always be parallel to each other it means if a model has **HasMany relation** then other related model will have **belongsTo** relation.
- in **Hasmany**, related model will have key and current model will have otherKey
- in **belongsTo**, current model will have key and related model will have otherKey
- **$post->comments()** will give you relation data(mostly use to acces Pivot data of many to many relation) and **$post->comments** will give you `comments` of `post`.

==================================================================

# belongsToMany Relation
	<?php 
	class User extends Model
	{	
		public $belongsToMany = [
		    'roles' => [
		        'Acme\Blog\Models\Role',
		        'table'    => 'acme_blog_role_user',
		        'key'      => 'my_user_id',
		        'otherKey' => 'my_role_id',
		        'pivot' => ['price', 'extra_info']
		    ]
		];
	}
	?>
- **table** => This index is use to provide pivot table name and only needed if we did not follow pivot table naming convention
- **key** => it is the user_id column we use on pivot table and only needed if we did not follow relationship column convention
- **otherKey** => it is the role_id column we use on pivot table and only needed if we did not follow relationship column convention
- **pivot**: This is very very important. these are the extra pivot columns in pivot table. These columns can be used when we save User model with Role Model or vice versa and we want to save extra data with that.

# Accesing pivot model

	$user = User::find(1);
	foreach ($user->roles as $role) {
	    echo $role->pivot->price;
	}


# Notes:
- A pivot table is a central table of Two models in **Many to Many** relation.
- Here price are the pivot column. 
- Notice that here each Role model we retrieve is automatically assigned a pivot attribute. 
- This attribute contains a model representing the intermediate table, and may be used like any other model.
- make a habit to call the relation like this **$user->roles()** and not like this **$user->roles**. it will save you to indulge in problems 

=====================================================================
