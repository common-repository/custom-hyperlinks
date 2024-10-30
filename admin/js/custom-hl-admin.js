(function( $ ) {
	'use strict';

	$(function() {
		$("#form-total").steps({
			headerTag: "h2",
			bodyTag: "section",
			transitionEffect: "fade",
			enableAllSteps: true,
			stepsOrientation: "vertical",
			autoFocus: true,
			transitionEffectSpeed: 500,
			titleTemplate : '<div class="title">#title#</div>',
			onStepChanged: function (event, current, next) {
				if (current == $('section').length - 1) {
					applyRegex();
				}
			},
			onFinished: function (event, currentIndex) {
				event.preventDefault();
				$('#custom-hl-options').submit();
			},
			labels: {
				next : 'Preview',
				finish: 'Save Changes',
				previous: "Back"
			},
		});

		$('#custom-hl-exampleText').keyup(function(e) {
			e.preventDefault();
			applyRegex();
		});

		$('#custom-hl-options').submit(function(e) {
			jQuery('#custom-hl-ajax-saving').removeAttr('class').fadeIn('fast');
			
			$(this).ajaxSubmit({
			   success: function(){
				jQuery('#custom-hl-ajax-saving').addClass('success-animation');
				setTimeout(function(){
					jQuery('#custom-hl-ajax-saving').fadeOut();
				},500);
			   }, 
			   timeout: 5000
			});
			return false; 
		});
	});

	function applyRegex() {
		//reset the output text element
		$('#outputText').html($('#custom-hl-exampleText').val());

		var domains = $('#custom-hl-domains').val().split(/\n/);
		domains.map(domain => domain.trim());
		domains = domains.filter(domain => domain.length > 0);

		$('#outputText').find('a').each(function (index, anchorTag) {
			if(anchorTag.hostname && domains.indexOf(anchorTag.hostname) == -1) {
				if($('#custom-hl-target').val() != -1) {
					anchorTag.target = $('#custom-hl-target').val();
				}
				anchorTag.innerHTML = anchorTag.innerHTML + $('#custom-hl-element').val();
			}
		});
	}
})( jQuery );
