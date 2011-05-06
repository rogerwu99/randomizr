<?php
class Interest extends AppModel {

	var $name = 'Interest';
    //var $actsAs = array('Containable');
	  				
     var $belongsTo = array(
	 						'User'=>array(
	 							'className'=>'User',
								'unique'=>false,
							));
	/*var $validate = array(
    	'description' => array(
    							'rule'=>'notEmpty',
	   							'message' => 'Must have a description.',
    							'last'=>true,
							  ),
    	'end_date' => array(
    							'rule'=>array('dateorder','start_date'),
	   							'message' => 'End date must be after start date.',
    							'last'=>true,
							  ),
		
		'threshold' => array
					(
					'rule' => array('comparison', '>=', 1),
					'message' => 'Must have at least one point.'
					)
  		);*/
    



	
	 

}
?>
