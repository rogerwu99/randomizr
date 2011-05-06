<div id="jsplan">
<script type="text/javascript">
var prem = document.getElementById('prem');
var supe = document.getElementById('supe');
var star = document.getElementById('star');
while (prem.hasChildNodes()) {
	prem.removeChild(prem.lastChild);
}
while (supe.hasChildNodes()) {
	supe.removeChild(supe.lastChild);
}
while (star.hasChildNodes()) {
	star.removeChild(star.lastChild);
}
<? if (!$starting): ?>
	prem.appendChild(document.createTextNode('Premium $99 / mo'));
	supe.appendChild(document.createTextNode('Super $59 / mo'));
	star.appendChild(document.createTextNode('Starter $35 / mo'));
<? else: ?>
	prem.appendChild(document.createTextNode('Premium $79 / mo - 2 months free!'));
	supe.appendChild(document.createTextNode('Super $49 / mo - 2 months free!'));
	star.appendChild(document.createTextNode('Starter $29 / mo - 2 months free!'));
	var prem_val = document.getElementById('UserChooseAPlan1');
	var supe_val = document.getElementById('UserChooseAPlan2');
	var star_val = document.getElementById('UserChooseAPlan3');

	prem_val.value = "Premium_Disc";
	supe_val.value = "Super_Disc";
	star_val.value = "Starter_Disc";

<? endif; ?>
</script>
</div>