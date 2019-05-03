/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {
    $('.child-li').click(function (e) {
	e.preventDefault();
	if ($(this).find('.child-menu').is(':visible')) {
	    $(this).find('.child-menu').hide('fast');
	} else {
	    $('.child-menu').hide('fast');
	    $(this).find('.child-menu').show('fast');
	}
    });
    $('.child-menu').click(function (e) {
	e.stopPropagation();
    });
    $('[data-toggle="tooltip"]').tooltip();

    $('.first-opt').click(function () {
	$('.card-option').css('width', '150px');
	$(this).css('transform', 'rotate(0deg)');
    });
    $('.last-opt').click(function () {
	$('.card-option').css('width', '50px')
	$('.first-opt').css('transform', 'rotate(180deg)');
    });
    $('.min-opt').click(function () {
	if ($('.card-body').is(":visible"))
	    $('.card-body').fadeOut();
	else
	    $('.card-body').fadeIn();
    });
    $('.back-opt').click(function () {
	location.href = $('.back-opt button').attr('data-href');
    });
});

function changeFile(event) {
    if (event.target.files[0] !== undefined) {
	var file = event.target.files[0].name;
	var name = event.target.name;
	var elem = event.target.closest('.group-file');
	var e = elem.querySelector('.file-name');
	e.value = file;
    }

}
function elclose() {
    $('.background-elfinder').remove();
}
function findAncestor(el, cls) {
    while ((el = el.parentNode) && el.className.indexOf(cls) < 0)
	;
    return el;
}

var request = null;
function queryAjax(url, data, action, method) {
    if (request !== null) {
	request.abort();
    }
    request = $.ajax({
	url: url,
	headers: {
	    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	},
	method: method == undefined ? 'POST' : method,
	data: data,
	beforeSend: function () {
	    $("body").append('<div class="loading"><div class="lds-css ng-scope"><div style="width:100%;height:100%" class="lds-eclipse"><div></div></div></div>');
	},
	success: action
    }).done(function () {
	request = null;
	$(".loading").remove();
    });
}
function setCookie(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
	var c = ca[i];
	while (c.charAt(0) == ' ') {
	    c = c.substring(1);
	}
	if (c.indexOf(name) == 0) {
	    return c.substring(name.length, c.length);
	}
    }
    return "";
}