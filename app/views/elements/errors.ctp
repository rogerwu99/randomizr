<?php // views/elements/errors.ctp
if (!empty($errors)) { ?>
<div class="errors">
<span style="color:#F00;font-size:14px;">
<?php if (count($errors)==1): ?>
There is 1 error in your submission.
<?php else: ?>
There are <? echo count($errors); ?> errors in your submission.
<?php endif; ?>

</span>
    
    
        <?php foreach ($errors as $field => $error) { ?>
        <li><span style="color:#000;font-size:12px;"><?php echo $error; ?></span></li>
        <?php } ?>
    
</div>
<?php } ?>