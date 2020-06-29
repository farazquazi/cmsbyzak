# Method Overriding
- The Child Class overridden method cannot have a weaker access then Parent Class method and it will throw error.
- For example, public method of Parent Class cannot be overridden by protected method of Child Class but vice-versa is possible.

```
<?php 

class Sports
{
    protected function ground()
    {
        echo "called from Sports";
    }
}

class Cricket extends Sports
{
    public function ground(){
        echo "called from Cricket";
    }

    public function test(){
        return $this->ground();
    }
}

$obj = new Cricket();
$obj->test();
// result => 'called from Cricket'
// OverRidden by Child Class method

```
