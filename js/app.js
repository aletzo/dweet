/**************************************
 * begin the post submit functionality
 */
$('#post_submit').click(function(e) {
    if ($(this).hasClass('disabled')) {
        alert('160 max characters allowed!');

        return false;
    }

    e.preventDefault();

    var text = $('#post').val();

    $.ajax({
        type: "POST",
        url: baseurl + '/post/create',
        data: {
            text: text
        },
        dataType: "json",
        success: function(response) {
            if (response.success) {
                var new_post = $('<div class="post"><div class="author">'
                    + response.author
                    + ' <span>'
                    + response.date
                    + '</span></div><div class="text">'
                    + text
                    + '</div><a class="reply" href="#" rel="'
                    + response.post_id
                    + '">reply</a></div>');

                $('#posts').prepend(new_post.fadeIn(1000));

                $('#post').val('');
            }
        },
        error: function(response) {
            alert('failure');
        }
    });
});
/*
 * end the post submit functionality
 ************************************/

/*****************************************
 * begin the comment submit functionality
 */
var clicked_link = null;
var post_id      = null;

var reply_textarea = $('#reply_textarea');
var tips           = $('.validate_tips');

function updateTips(t) {
	tips.text(t)
		.addClass('ui-state-highlight');
	setTimeout(function() {
		tips.removeClass('ui-state-highlight', 1500);
	}, 500 );
}

function checkLength( o, n, min, max ) {
	if ( o.val().length > max || o.val().length < min ) {
		o.addClass('ui-state-error');
		updateTips('Length of '
		    + n
		    + ' must be between '
		    + min
		    + ' and '
		    + max
		    + '.');
		return false;
	} else {
		return true;
	}
}


$('#dialog-form').dialog({
	autoOpen: false,
	height: 350,
	width: 350,
	modal: true,
	buttons: {
		"Reply!": function() {
			
			var isValid = true;

			reply_textarea.removeClass('ui-state-error');

			isValid = isValid && checkLength(reply_textarea, 'reply', 1, 160);

			if (isValid) {
				sendComment();

				$(this).dialog('close');
			}
		},
		Cancel: function() {
			$(this).dialog('close');
		}
	},
	close: function() {
		reply_textarea.val('').removeClass('ui-state-error');
	}
});

function sendComment() {

    var text = $('#reply_textarea').val();

    $.ajax({
        type: "POST",
        url: baseurl + '/comment/create',
        data: {
            post_id: post_id,
            text: text
        },
        dataType: "json",
        success: function(response) {
            if (response.success) {
                var new_comment = $('<div class="comment" style="display:none"><div class="author">'
                    + response.author
                    + ' <span>'
                    + response.date
                    + '</span></div><div class="text">'
                    + text
                    + '</div></div>');

                new_comment.insertAfter(clicked_link.parent()).fadeIn(1000);
            }
        },
        error: function(response) {
            alert('failure');
        }
    });
}

$('a.reply').live('click', function(e) {
    e.preventDefault();

    clicked_link = $(this);
    
    post_id = clicked_link.attr('rel');

	$('#dialog-form').dialog('open');
});
/*
 * end the comment submit functionality
 ***************************************/

/*******************************************
 * begin the characters count functionality
 */
$('#post').simplyCountable({
    counter:            '#characters em',
    countType:          'characters',
    wordSeparator:      ' ',
    maxCount:           160,
    strictMax:          false,
    countDirection:     'down',
    safeClass:          'safe',
    overClass:          'over',
    thousandSeparator:  ',',
    onOverCount:        function(count, countable, counter) {
        $('#post_submit').addClass('disabled');
    },
    onSafeCount:        function(count, countable, counter){
        $('#post_submit').removeClass('disabled');
    },
    onMaxCount:         function(count, countable, counter){}
});

$('#reply_textarea').simplyCountable({
    counter:            '#comment_characters em',
    countType:          'characters',
    wordSeparator:      ' ',
    maxCount:           160,
    strictMax:          false,
    countDirection:     'down',
    safeClass:          'safe',
    overClass:          'over',
    thousandSeparator:  ',',
    onOverCount:        function(count, countable, counter) {
    },
    onSafeCount:        function(count, countable, counter){
    },
    onMaxCount:         function(count, countable, counter){}
});
/*
 * end the characters count functionality
 *****************************************/
