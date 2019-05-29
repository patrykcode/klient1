var ALERTS = {
    hideAlert: 150000,
    show: function (data) {
	var icon = {'success': 'fa-check', 'danger': 'fa-exclamation', 'info': 'fa-check'};
	var msgBox = document.createElement('div');
	msgBox.className = "alerts alerts-" + data.type;
	var clear;
	msgBox.onclick = function () {
	    clearTimeout(clear);
	    ALERTS.rePosition(this);
	    this.outerHTML = '';
	};
	var i = document.createElement('i');
	i.className = "fa " + icon[data.type];
	var strong = document.createElement('strong');
	strong.innerHTML = data.message;
	strong.style.margin = '3px 10px';
	var b = document.createElement('b');
	b.innerHTML = '&times;';
	msgBox.appendChild(i);
	msgBox.appendChild(strong);
	msgBox.appendChild(b);
	var position = this.checkPosition();
	msgBox.setAttribute('id', position.index);
	msgBox.style.top = position.topPx;
	document.body.appendChild(msgBox);
	clear = setTimeout(function () {
	    msgBox.outerHTML = '';
	    ALERTS.rePosition(msgBox);
	}, ALERTS.hideAlert);
    },
    checkPosition: function () {
	var items = document.querySelectorAll('.alerts');
	var pos = {height: 0, top: 10};
	if (items.length)
	    pos = items[items.length - 1].getBoundingClientRect();
	var top = pos.height + pos.top + 5;
	return {top: top, topPx: top + 'px', index: items.length};
    },
    rePosition: function (item) {
	var items = document.querySelectorAll('.alerts');
	for (var i = 0; i < items.length; i++) {
	    if (!ALERTS.isbefore(item, items[i])) {
		var tmp = items[i - 1] === undefined ? {top: 10} : items[i - 1].getBoundingClientRect();
		items[i].style.top = (tmp.top) + 'px';
	    }
	}
    },
    isbefore: function (a, b) {
	if (a.parentNode == b.parentNode) {
	    for (var cur = a; cur; cur = cur.previousSibling) {
		if (cur === b) {
		    return true;
		}
	    }
	}
	return false;
    }
}