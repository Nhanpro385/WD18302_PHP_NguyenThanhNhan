<?php




namespace App\Core;


class Field{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_NUMBER = 'number';


public string $type;
public string $attribute;



public function __construct(string $attribute){
$this->type=self::TYPE_TEXT;
$this->attribute=$attribute;
}

public function toString(){
    return sprintf('
    <div class="form-group">
        <label>%s</label>
        <input type="%s" name="%s">
    </div>
    ', $this->getLabels($this->attribute),
    $this->type,
    $this->attribute
    );
    
}

public function passwordField(){
$this->type=self::TYPE_PASSWORD;
return $this;
}


public function labels(): Array{
return[
'firstName'=>'First Name',
'lastName'=>'Last Name',
'email'=>'Your Email',
'password'=>'Password',
'confirmPassword'=>'Confirm password',
];
}

public function getLabels($attribute){
return $this->labels()[$attribute]??$attribute;
}

}