<?php 
if(!empty($_Auth['User']['id']))
{ 
    header('location:'.Router::url('/',true).'users');
    exit;
}

?>
<?php echo $this->element('howitworks'); ?>

