$(function(){
	$('.site-navigation-toggle').on('click', function(){
		var $button = $(this);
		var expanded = $button.attr('aria-expanded') === 'true';

		$button.attr('aria-expanded', expanded ? 'false' : 'true');
		$button.next('.site-navigation-content').toggleClass('is-open', !expanded);
	});
});
