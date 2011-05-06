<?php
class User extends AppModel {

	var $name = 'User';
    var $actsAs = array('Containable');
	var $hasOne = array(
        'Movie' => array(
	        'className'             => 'Movie',
    		'unique'				=> false
    					),
		'Interest' => array(
	    	'className'             => 'Interest',
    		'unique'				=> false
    					),
		'Place' => array(
	    	'className'             => 'Place',
    		'unique'				=> false
    					),
		'Userprofile' => array(
	        'className'             => 'Userprofile',
    		'unique'				=> false
    					),
		'Work' => array(
	    	'className'             => 'Work',
    		'unique'				=> false
    					),
		'School' => array(
	    	'className'             => 'School',
    		'unique'				=> false
    					),
	
	/*	'Book' => array(
	    	'className'             => 'Book',
    		'unique'				=> false
    					),
		
		'Work' => array(
	    	'className'             => 'Work',
    		'unique'				=> false
    					),
		'School' => array(
	    	'className'             => 'School',
    		'unique'				=> false
    					),
		'Purchase' => array(
	    	'className'             => 'Purchase',
    		'unique'				=> false
    					),
		'Aspiration' => array(
	    	'className'             => 'Aspiration',
    		'unique'				=> false
    					),
		'Charity' => array(
	    	'className'             => 'Charity',
    		'unique'				=> false
    					),
		'Travel' => array(
	    	'className'             => 'Travel',
    		'unique'				=> false
    					)
		*/);
	  				
    
	function identicalFieldValues($field=array(), $compare_field=null ) 
    {
        foreach( $field as $key => $value )
        {
            $v1 = $value;
            $v2 = $this->data[$this->name][ $compare_field ];                 
            if($v1 !== $v2) 
            {
                return false;
            } 
            else 
            {
                continue;
            }
        }
        return true;
    } 
    
    var $validate = array(
    	'screen_name' => array(
    					'screennameUnique' => array(
							'rule'=>'isUnique',
							'message' => 'This screen name has already been registered with Bantana.',
							'last'=>true,
							'on' => 'create'
							
						)
    			),
	
    	'email' => array(
    					'emailFormat' => array(
    							'rule'=>'email',
	   							'required' =>true,
    							'message' => 'Please input valid email address',
    							'last'=>true,
								'on' => 'create'
    					),
						'emailUnique' => array(
							'rule'=>'isUnique',
							'message' => 'This email has already been registered with Bantana.',
							'last'=>true,
							'on' => 'create'
							
						)
    			),
		'new_password' => array
    					(
    					'ruleNotEmpty' => array(
    						'rule' => array('minLength', '8'),
    						'required' =>true,
    						'message' => 'Please provide password of at least 8 characters.',
    						'last'=>true,
							'on' => 'create'
    											), 
    					'newPasswordRule' => array(
    						'rule' => array('identicalFieldValues', 'confirm_password'),
    						'required' =>true,
    						'message' => 'Passwords must match.',
							'on' => 'create'
    					)
    		),
		'accept' => array
					(
					'rule' => array('equalTo', '1'),
					'message' => 'Must accept terms.',
					'on' => 'create'
					)
  		);


}
?>
