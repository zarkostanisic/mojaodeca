
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./lazy');

$(document).ready(function(){

	$('#filter-mob').click(function() {
		$('.filter-bar').show('slow');
		$('#filter-mob').css("cssText", "display:none !important;");
		$('.rezultati-div').hide();
		$("html, body").animate({ scrollTop: 0 }, "slow");
	});

	$('#showPhone').click(function() {
		$(this).hide();
		$('#phone').show();
	});

	$('#filter-mob-close').click(function() {
		$('.rezultati-div').show();
	    $('#filter-mob').show();
	    $('.filter-bar').hide("slow");
	});

	$("#select-cat-index").on("change", changeFormAction);

	function changeFormAction() {
		var cat_name=$( "#select-cat-index option:selected" ).val();

		if(cat_name){
			document.getElementById('search-index-form').action = "/"+cat_name;
		}else{
			document.getElementById('search-index-form').action = "/pretraga";
		}
	}

	$("a[href='#top']").click(function() {
		$("html, body").animate({ scrollTop: 0 }, "slow");
		return false;
	});

	$("#list-overlay").fadeOut("slow");

	function order_by() {
		var orderBy = $('select.order').find(':selected').val();
		$('#search-form').append('<input type="hidden" name="order" value="'+orderBy+'" /> ');
		$("#search-form").submit();
	}

	$('select.order').change(function() {
		order_by();
	}); 

	$("#search-form :input").each(function(){
		$(this).on('change', function () {
			order_by();
			var Class=$(this).parent().attr('class');
			if(Class == 'category-check'){
				$('.subcategory-check input:checkbox').prop('checked', false);
			}
			
			$('.'+Class+' input:checkbox').not(this).prop('checked', false);
			$("#search-form").submit();
		});
	})
});

