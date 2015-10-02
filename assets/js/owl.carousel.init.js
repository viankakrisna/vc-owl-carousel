jQuery(document).on('vc_js', function ($) {
	jQuery(document).ready(function($) {
		$('.vc_owlcarousels').each(function(){
			var el = window[$(this).attr('data-settings')];
			var prop;
			for (prop in el) {
			    if (el.hasOwnProperty(prop)) {
			        if (!isNaN(el[prop])){
			        	el[prop] = Number(el[prop]);
			        }
			        if (el[prop] === 'false' || el[prop] === '' || el[prop] === 0) {
			            el[prop] = false;
			        }
			        if (el[prop] === 'true') {
			            el[prop] = true;
			        }
			        if (typeof el[prop] === 'string') {
			            if (el[prop].indexOf(',') !== -1) {
			                el[prop] = el[prop].split(',');
			            }
			        }
			    }
			}
			$('.' + el.id).owlCarousel(el);
		})
	});
})
