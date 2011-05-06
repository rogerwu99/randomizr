<?php App::import('Sanitize'); ?>

<?
$cnt=count($first);
for ($i=0; $i<$cnt; $i++)
{
	$first[$i]['Frame']['index']=$first[$i]['Frame']['start'].$first[$i]['Frame']['track'];
}
$cnti=count($firstindex);
for ($i=0; $i<$cnti; $i++)
{
        $firstindex[$i]['Frame']['index']=$firstindex[$i]['Frame']['minstart'].$firstindex[$i]['Frame']['track'];
}
$cnte=count($last);
for ($i=0; $i<$cnte; $i++)
{
        $last[$i]['Frame']['index']=$last[$i]['Frame']['end'].$last[$i]['Frame']['track'];
}
$cntei=count($lastindex);
for ($i=0; $i<$cntei; $i++)
{
        $lastindex[$i]['Frame']['index']=$lastindex[$i]['Frame']['maxend'].$lastindex[$i]['Frame']['track'];
}

foreach ($first as $first1) {
        $firstlist[]=$first1['Frame']['index'];
}
foreach ($last as $last1) {
        $endlist[]=$last1['Frame']['track'];
}

?>

<? //print_r($first); ?>
<? //print_r($firstindex); ?>
<? //print_r($last); ?>
<? //print_r($lastindex); ?>

<klickable hotspotid="<?php echo $first[0]['Frame']['hotspot_id']; ?>"
	>

<?
foreach ($firstindex as $first1) {
	$num=array_search($first1['Frame']['index'], $firstlist);
	if (is_numeric($num))
	{
		$start=$first[$num];
	}
	else
	{
		$start='';
	}

	$num=array_search($first1['Frame']['track'], $endlist);
	//$ending=$endlist[$num]['Frame']['index'];
	if (is_numeric($num))
	{
		$end=$last[$num];
	}
	else
	{
		$end='';
	}
?>
	<keyframe id="<?php echo $start['Frame']['hotspot_id']; ?>"
        track ="<?php echo $start['Frame']['track']; ?>"
        start ="<?php echo round($start['Frame']['start'], 1)*10; ?>"
        startid ="<?php echo $start['Frame']['id']; ?>"
        end ="<?php echo round($end['Frame']['end'], 1)*10; ?>"
        endid ="<?php echo $end['Frame']['id']; ?>"
	/>
<? } ?>

<? /* ?>
        <keyframe id="<?php echo $last['Frame']['hotspot_id']; ?>"
        start="<?php $time=round($last['Frame']['start'], 1)*10;
        echo $time;
        ?>"
        end="<?php $time=round($last['Frame']['end'], 1)*10;
        echo $time;
        ?>"
        x ="<?php echo $last['Frame']['x']; ?>"
        y ="<?php echo $last['Frame']['y']; ?>"
        width ="<?php echo $last['Frame']['width']; ?>"
        height ="<?php echo $last['Frame']['height']; ?>"
        name ="<?php $title = Sanitize::clean($last['Frame']['name'], array(' unicode'=>true));
        echo $title;
        ?>"
        object_id ="<?php echo $last['Frame']['object_id']; ?>"
        created ="<?php echo $last['Frame']['created']; ?>"
        modified ="<?php echo $last['Frame']['modified']; ?>"
        >
<? */ ?>

</klickable>
