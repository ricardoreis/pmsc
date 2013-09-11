<?php

include_once dirname(__FILE__) . '/../config.php';

?>
$j = jQuery;







//	Funções para o menu principal	//
$j(document).ready(function () {
	$j(".nav ul:not(.sub)").each(function () {
		$j(this).find("li:first")
		.each(function () {
			var li = $j(this),
				ul = li.parent(),
				sub = li.find(".select_sub");

			sub.data("defaultLeft", sub.css("left"));
			sub.css("left", li.position().left + "px");

			li
			.mouseover(function () {
				var cur = $j(".nav .current .select_sub");

				if (!ul.hasClass("current")) cur.css("display", "none");
			}).mouseout(function () {
				var cur = $j(".nav .current .select_sub");

				if (!ul.hasClass("current")) cur.css("display", "block");
			});
		});
	});
});
//	=============================	//







//	Funções para o formulário de busca	//
$j(document).ready(function () {
	var search = $j("#top-search");

	search.find(".top-search-url").selectbox({ inputClass: "top-search-url" });

	search.find(".top-search-inp")
	.focus(function () { if (this.value == '<?php echo S_DEFAULT ?>') this.value = ''; })
	.blur(function () { if (this.value == '') this.value = '<?php echo S_DEFAULT ?>'; })
	.keypress(function (event) {
		var key = event.which;

		if (key == 13) {
			event.preventDefault();
			search.find("a.search").click();
		}
	});

	search.find("a.search")
	.click(function () {
		var form = search.find("form")[0],
			s = search.find(".top-search-inp")[0],
			url = search.find("select[name=url]").val();

		form.action = url;
		if (s.value == '<?php echo S_DEFAULT ?>') s.value = '';
		form.submit();

		return false;
	});
});
//	==================================	//







//	Funções para os tooltips	//
$j(document).ready(function () {
	$j('a.info-tooltip').tooltip({
		track: true,
		delay: 0,
		fixPNG: true, 
		showURL: false,
		showBody: " - ",
		top: 0,
		left: 0
	});
});
//	========================	//







//	Funções para o botão "Minha Conta"	//
$j(document).ready(function () {
    $j(".showhide-account").click(function () {
        $j(".account-content").slideToggle("fast");
        $j(this).toggleClass("active");
        return false;
    });
});
//	==================================	//







//	Funções para a página de login	//
$j(document).ready(function () {
	var login_box = $j("#login-inner");

	login_box.find("form").submit(function () {
		var form = $j(this);

		form.find("a.submit").css("display", "none");
		form.find(".submit_loading").css("display", "block");

		return true;
	});

	login_box.find("form").find("input[type=text], input[type=password]").keypress(function (event) {
		var key = event.which;

		if (key == 13) {
			event.preventDefault();
			login_box.find("form").submit();
		}
	});

	login_box.find("a.submit").click(function () {
		login_box.find("form").submit();
		return false;
	});

	login_box.find("form").find("input[name=login]").focus();

	$j(".back-login").click(function () {
		$j("#loginbox").show();
		$j("#forgotbox").hide();
		return false;
	});

	$j(".forgot-pwd").click(function () {
		$j("#loginbox").hide();
		$j("#forgotbox").show();
		return false;
	});
});
//	==============================	//







//	Funções para o box de mensagem	//
$j(document).ready(function() {
	var mb = $j(".message-box");

	mb.find(".right a").click(function () {
		mb.fadeOut("slow");
		return false;
	});
});
//	==============================	//







//	Funções para a tela de busca	//
$j(document).ready(function () {
    $j('#search-table tr').hover(function () { $j(this).addClass('activity-blue'); }, function () { $j(this).removeClass('activity-blue'); });

	$j('#actions-box #actions-box-slider .action-delete').click(function () {
		var link = $j(this),
			form = link.parents('form:first'),
			checked_items = form.find("input[type=checkbox]:checked");

		if (checked_items.length) {
			if (confirm('Tem certeza de que deseja excluir os registros selecionados?')) form.submit();
		} else {
			alert('Selecione pelo menos um item antes de excluir.');
		}

		return false;
	});

	$j('.paginacao_select').selectbox({ inputClass: "paginacao_select" });

	$j('#content-table-inner a.paginacao_ok').click(function () {
		$j(this).parents('form:first').submit();
		return false;
	});
});

actions_box_open = function (open) {
	var _action = $j("#actions-box .action-slider"),
		_slider = $j("#actions-box #actions-box-slider"),
		speed = "fast";

	if (typeof open == "undefined") open = !_action.hasClass("activated");

	open ? _slider.slideDown(speed) : _slider.slideUp(speed);
	_action.toggleClass("activated", open);
}

actions_box_close = function () { actions_box_open(false); }

$j(document).ready(function () {
    $j("#actions-box").find(".action-slider, #actions-box-slider a").click(function () {
        actions_box_open();
        return false;
    });
});
//	============================	//







//	Funções para o formulário de cadastro	//
$j(document).ready(function () {
	$j('#search-table input[type=checkbox].toggle-all').checkBox();

	$j('#search-table a.toggle-all').click(function () {
		var toggle_all = $j(this),
			toggle_class = 'toggle-checked',
			toggle_checked = !toggle_all.hasClass(toggle_class);

		toggle_all.toggleClass(toggle_class, toggle_checked);

		$j('#search-table input[type=checkbox].toggle-all').checkBox('changeStatus', toggle_checked);

		return false;
	});
});

$j(document).ready(function () {
	$j(document).ready(function() {
		$j('.selectbox_form_1').selectbox({ inputClass: "selectbox_form_1" });
		$j('.selectbox_form_2').selectbox({ inputClass: "selectbox_form_2" });
	});
});

$j(document).ready(function () {
	$j("#form-table .input.file").filestyle({
		cssClass: "file-upload",
		buttonLabel: "Escolher"
	});
});
//	=====================================	//







//	Funções gerais	//
$j(document).bind("click", function (e) {
    if (e.target.id != $j(".showhide-account").attr("class")) $j(".account-content").slideUp();
});

$j(document).bind("click", function (e) {
    if (e.target.id != $j("#actions-box .action-slider").attr("class")) actions_box_close();
});

$j(document).ready(function () {
	$j(document).pngFix();
});
//	==============	//







//	Funções para o cadastro de submenus	//
submenus_fotos_upload = function (form) {
	var defaultAction = form.action,
		defaultTarget = form.target,
		iframe = document.getElementById("submenus_fotos_upload");

	form.action = iframe.src;
	form.target = iframe.id;

	form.submit();

	form.action = defaultAction;
	form.target = defaultTarget;

	$j("#submenus_foto_input").css("display", "none");
	$j("#submenus_foto_loading").css("display", "block");
}

submenus_fotos_show = function (HTML) {
	$j("#submenus_fotos_preview").html(HTML);

	$j("#submenus_foto_input").css("display", "block");
	$j("#submenus_foto_input").find(".input.file").val("");
	$j("#submenus_foto_loading").css("display", "none");
}

$j(document).ready(function () {
	$j("#submenus_foto_input input[type=file]").bind("change", function () {
		submenus_fotos_upload(this.form);
	});
});
//	===================================	//







//	Funções para o cadastro de dicas	//
dicas_fotos_upload = function (form) {
	var defaultAction = form.action,
		defaultTarget = form.target,
		iframe = document.getElementById("dicas_fotos_upload");

	form.action = iframe.src;
	form.target = iframe.id;

	form.submit();

	form.action = defaultAction;
	form.target = defaultTarget;

	$j("#dicas_foto_input").css("display", "none");
	$j("#dicas_foto_loading").css("display", "block");
}

dicas_fotos_show = function (HTML) {
	$j("#dicas_fotos_preview").html(HTML);

	$j("#dicas_foto_input").css("display", "block");
	$j("#dicas_foto_input").find(".input.file").val("");
	$j("#dicas_foto_loading").css("display", "none");
}

$j(document).ready(function () {
	$j("#dicas_foto_input input[type=file]").bind("change", function () {
		dicas_fotos_upload(this.form);
	});
});
//	================================	//







//	Funções para o cadastro de cursos	//
$j(document).ready(function () {
	$j("#form-table input[name=data]").datepicker();
	$j("#form-table input[name=data_atualizacao]").datepicker();
});
//	=================================	//