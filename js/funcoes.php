// JavaScript Document

$j = jQuery;


/*	jQuery Cycle	*/
$j(document).ready(function() {
    $j('#slideshow').cycle({
        fx:     'scrollHorz',
        timeout: 6000,
        speed:   800,
        pager:  '#nav_cycle'
    });
});
/*	============	*/


/* Function form message */
send_form_message_message = "Enviando solicitação...";

form_message_send = function () {
	if ($j("#form_message .answer").html() != send_form_message_message) {
         $j.ajax({ type: "POST",
                   url: "mensagem_post.php",
                   data: $j("#form_message").serialize() + "&send=send",
                   dataType: "html",
                   beforeSend: function () { $j("#form_message .answer").html(send_form_message_message); },
                   success: function (HTML) { $j("#form_message .answer").html(HTML); }
                 } );
	} else {
    	alert("Aguarde enquanto a mensagem está sendo enviada.");
    }
}
/* ============================== */

/* Function form contact */
/*send_form_contact_message = "Enviando solicitação...";

form_contact_send = function () {
	if ($j("#form_contact .answer").html() != send_form_contact_message) {
         $j.ajax({ type: "POST",
                   url: "contato_post.php",
                   data: $j("#form_contact").serialize() + "&send=send",
                   dataType: "html",
                   beforeSend: function () { $j("#form_contact .answer").html(send_form_contact_message); },
                   success: function (HTML) { $j("#form_contact .answer").html(HTML); }
                 } );
	} else {
    	alert("Aguarde enquanto a mensagem está sendo enviada.");
    }
}
/* ============================== */


/*	Navigator top	*/
$j(document).ready(function() {
	$j('#nav li a').hover(function() {
    	if ($j(this).parent().parent().hasClass('level1')) {
			$j('#nav li a').removeClass('active2');
        }

    	if ($j(this).hasClass('submenu')) {
	        $j(this).next('ul:first').stop().show();
            if ($j(this).parent().parent().hasClass('level1')) {
            	$j(this).addClass('active2');
            }
        } else if ($j(this).parent().parent().hasClass('level1')) {
        	$j('ul.level2').stop().hide().opacity(1);
            $j(this).addClass('active');
        } else if ($j(this).parent().parent().hasClass('level2')) {
        	$j('ul.level3').stop().hide().opacity(1);
        } else if ($j(this).parent().parent().hasClass('level3')) {
        	$j('ul.level4').stop().hide().opacity(1);
        }
    	window.clearTimeout(timeout_nav);
    });
    
    /*$j('#nav li a').hover(function() {
    	if ($j(this).hasClass('submenu')) {
            if ($j(this).parent().parent().hasClass('level1')) {
            	$j(this).addClass('active2');
	        	var orig_height = $j(this).next('ul:first').show().height();
                $j(this).next('ul:first').css('height', '0');
                $j(this).next('ul:first').animate({
                	height: orig_height
				}, 200);
            } else {
	        	var orig_width = $j(this).next('ul:first').show().width();
            	$j(this).next('ul:first').css('width', '0');
                $j(this).next('ul:first').animate({
                	width: orig_width
				}, 200);
            }
        } else if ($j(this).parent().parent().hasClass('level1')) {
        	$j('ul.level2').stop().css('height', '0');
            $j(this).addClass('active');
        } else if ($j(this).parent().parent().hasClass('level2')) {
        	$j('ul.level3').stop().css('width', '0');
        } else if ($j(this).parent().parent().hasClass('level3')) {
        	$j('ul.level4').stop().css('width', '0');
        }
    });*/
    
    $j('#nav').mouseleave(function() {
        window.timeout_nav = setTimeout(function (){
            $j('#nav li ul').hide();
            $j('#nav li a').removeClass('active2');
        }, 1000);
    });

	/*$j('#nav li:not(.submenu)').hover(function() {
        $j(this).next('ul:first').fadeIn(500);
        alert(1);
    });*/
});
/*	=============	*/