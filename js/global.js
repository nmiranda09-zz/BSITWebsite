$(document).ready(function() {
	loadFile();
	preloader();
	urlRewrite();
	charCounter();
	addActive();
	profileSearch();
	$('.students-blk #show').load('./students-list.php');
	$('.page-edit .errors').insertAfter('.page-edit form h1');
});

function addActive() {
	var path = window.location.href;

    $('nav ul a').each(function() {
    	if (this.href === path) {
    		$(this).addClass('active');
    	}
   	});

   	$('div#navigation span').click(function() {
   		var number = $(this).index();

		if($(this).hasClass('active')) {
			$(this).removeClass('active');
			$('.sec').eq(number).removeClass('active');
		} else {
			$(this).addClass('active');
			$(this).siblings().removeClass('active');
			$('.sec').siblings().removeClass('active');
			$('.sec').eq(number).addClass('active');
		}

		$('.sec').each(function() {
			if($(this).hasClass('active')) {
				if($(this).hasClass('students')) {

					$(this).load('./students-list.php');
				} else {
					$(this).load('./faculties-list.php');
				}
			} else {
				$('.loaded').remove();
			}
		});
	});
}

function charCounter() {
	$('.subj-desc').on("input", function(){
	    var maxlength = $(this).attr("maxlength");
	    var currentLength = $(this).val().length;

	    if( currentLength >= maxlength ){
	        $('.char-count').text("You have reached the maximum number of characters.");
	    }else{
	        $('.char-count').text(maxlength - currentLength + " characters left");
	    }
	});
}

function urlRewrite() {
	if(window.location.href.indexOf('index.php') > -1) {
		window.location.href = window.location.href.replace('index.php', '');
	}
}

function preloader() {
	$('.loader').load('./loader.php').fadeOut('slow');
	$('.blk-container #show, .students-blk #show').load('./loader.php');
}

function loadFile() {
	setInterval(function() {
		$('.blk-container .loader').remove();
		$('.announcement-blk #show').load('./announcements.php');
		$('.event-blk #show').load('./events.php');
	}, 3000);
}

function editProfile() {
	$('.page-info .overlay').addClass('active');

	if ($('.page-info .overlay').hasClass('active')) {
		$('.page-info .overlay').load('./editshort-desc.php');
		$('.page-info').addClass('modal-open');
	}
}

function closeModal() {
	$('.page-info').removeClass('modal-open');
	$('.page-info .overlay').removeClass('active');
	$('.edit-show').remove();
}

function fileSelect(e, id){
	$('.file-info').text(e.target.files[0].name);
}

function profileSearch() {
	$(".page-profiles #navigation input").on("keyup", function() {
	    var value = $(this).val().toLowerCase();

	    $(".page-profiles .content .sec .loaded").filter(function() {
	      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
	});
}