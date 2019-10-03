jQuery(document).ready(function($) {

	var archivecount = $('.archive .archive-row').data('archivecount');
	var count = $('.archive .archive-container article').length;

	// alert(count);

	archivecount = Number(archivecount);
	count = Number(count);

	if( (archivecount - count) == 0 ) {
		$('.archive .pagination-row .btn-more-ajax').remove();
	}

	$('.btn-more-ajax').on('click', function() {

		let this_obj = $(this);
		let category_name;
		let countBlocks;
		let pageID;

		// Архивная страница
		if( $('body').hasClass('archive') ) {
			category_name = $('.archive .archive-row').data('archivename');
			countBlocks = $('.archive .archive-container article').length;
		} 
		
		var data = {
			id					: pageID,
			count				: countBlocks,
			category		:	category_name,
			action 			: 'btn_more_ajax',
			nonce 			: btn_more_ajax.nonce
		};

		$.ajax({
			url 				: btn_more_ajax.url,
			data				: data,
			type				: 'POST',
			dataType		: 'json',
			beforeSend	: function(xhr) {
				this_obj.text('Загрузка')
			},
			error	: function(xhr) {
				this_obj.text('Ошибка')
			},
			success: function(data) {
				this_obj.text('Смотреть ещё')

				// Архивная страница
				if( $('body').hasClass('archive') ) {
					
					$('.archive .archive-row').append( data.btn_more );

					var archivecount = $('.archive .archive-row').data('archivecount');
					var count = $('.archive .archive-container article').length;

					archivecount = Number(archivecount);
					count = Number(count);

					if( (archivecount - count) == 0 ) {
						$('.archive .pagination-row .btn-more-ajax').remove();
					}

				}
			}
		});
	});

});