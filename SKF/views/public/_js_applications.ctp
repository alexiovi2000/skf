
<script type="text/javascript">

$(function() {
	$("#menu").menu();
	$('input:radio[name="type"]').change(function () {
		var radios = $('input:radio[name="type"]');			
		var val;
		for (var i = 0; i < radios.length; i++) {
			if (radios[i].checked) {
				val = radios[i].value;
				if (val == "ProductLine") {
					$('#appNaviS').hide();
					$('#appNaviPC').show();
					$("#menu").menu();                     
				}
				else {
					$('#appNaviS').show();
					$('#appNaviPC').hide();
					$("#menu2").menu();
				}
			 }
		 }
	});
	
	
	$('.ul-menu li a').click(function(e) {
		var url = '/actselector/app/webroot/applications/' + $(this).attr('href');
		$('#appContent').load(url);
		e.preventDefault();
	});
});

</script>