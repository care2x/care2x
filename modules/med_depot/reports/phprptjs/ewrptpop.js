// Popup panel for PHP Report Maker 2
// (C) 2006-2008 e.World Technology Ltd.

var EW_REPORT_POPUP_MINWIDTH = 120;
var EW_REPORT_POPUP_DEFAULTHEIGHT = 150;
var EW_REPORT_EMPTY_VALUE = "##empty##";
var EW_REPORT_NULL_VALUE = "##null##";

var ewrpt_PopupName;
var ewrpt_Popups = {};

function ewrpt_SetupPopup(name) {
	xZIndex(name+'_Popup', 100);
	var rBtn = xGetElementById(name+'_ResizeGrip');
	if (rBtn) xEnableDrag(rBtn, null, ewrpt_ResizePopup, null);
	ewrpt_ResizePopup(null, 0, 0);
}

function ewrpt_ResizePopup(ele, mdx, mdy) {
	var dd = xGetElementById(ewrpt_PopupName+'_Data');
	var pd = xGetElementById(ewrpt_PopupName+'_Popup');
	var btn = xGetElementById(ewrpt_PopupName+'_OK');	
	xResizeTo(dd,	Math.max(xWidth(dd) + mdx, EW_REPORT_POPUP_MINWIDTH), xHeight(dd) + mdy);
	xResizeTo(pd, xWidth(dd) + 4, xHeight(dd) + xHeight(btn) + 10);	
}

function ewrpt_CreatePopup(name, data) {
	var p = new PopupWindow(name+'_Popup');
	if (p) {
		p.offsetY = 20;
		p.autoHide();
		p.data = data;
		ewrpt_Popups[name] = p;
	}
	return p;
}

function ewrpt_ShowPopup(anchorname, popupname, useRange, rangeFrom, rangeTo) {
	var p = ewrpt_Popups[popupname];
	if (p) {
		ewrpt_SetPopupContent(popupname, p.data, useRange, rangeFrom, rangeTo);
		p.showPopup(anchorname);
	}	
}

function ewrpt_HidePopup(popupname) {
	var p = ewrpt_Popups[popupname];
	if (p)
		p.hidePopup();
}

function ewrpt_SetPopupContent(name, data, useRange, rangeFrom, rangeTo) {
	ewrpt_PopupName = name;
	var selectall = true;
	var showdivider = false;
	for (var i=0; i<data.length; i++)
		selectall = data[i][2] ? selectall : false;
	var checkedall = selectall ? " checked" : "";
	var html = "<form id=\"" + name + "_FilterForm\" method=\"post\">";
	html += "<input type=\"hidden\" name=\"popup\" value=\"" + name + "\" />";
	html += "<table style=\"border: 0px; border-collapse: collapse;\">";	
	html += "<tr><td style=\"background-color: White; white-space: nowrap;\">";	
	html += "<div style=\"overflow: auto; height: " + EW_REPORT_POPUP_DEFAULTHEIGHT + "px;\" id=\"" + name + "_Data\">";
	if (useRange) {
		var selected;
		html += "<table border=\"0\" cellspacing=\"1\" cellpadding=\"1\" class=\"phpreportmaker\">";
		html += "<tr><td>" + EW_REPORT_POPUP_FROM + "</td><td>";
		html += "<select name=\"rf_" + name + "\" onChange=\"ewrpt_SelectRange(this.form, '" + name + "');\">";
		html += "<option value=\"\">" + EW_REPORT_POPUP_PLEASE_SELECT + "</option>";
		for (var i=0; i<data.length; i++) {
			if (data[i][0].substring(0,2)!="@@" && data[i][0]!=EW_REPORT_NULL_VALUE && data[i][0]!=EW_REPORT_EMPTY_VALUE) {
				selected = (data[i][0]==rangeFrom) ? " selected" : "";
				html += "<option value=\"" + data[i][0] + "\"" + selected + ">" + data[i][1] + "</option>";
			}
		}
		html += "</select></td></tr>";
		html += "<tr><td>" + EW_REPORT_POPUP_TO + "</td><td>";
		html += "<select name=\"rt_" + name + "\" onChange=\"ewrpt_SelectRange(this.form, '" + name + "');\">";
		html += "<option value=\"\">" + EW_REPORT_POPUP_PLEASE_SELECT + "</option>";
		for (var i=0; i<data.length; i++) {
			if (data[i][0].substring(0,2)!="@@" && data[i][0]!=EW_REPORT_NULL_VALUE && data[i][0]!=EW_REPORT_EMPTY_VALUE) {
				selected = (data[i][0]==rangeTo) ? " selected" : "";
				html += "<option value=\"" + data[i][0] + "\"" + selected + ">" + data[i][1] + "</option>";
			}
		}
		html += "</select></td></tr></table>";
	}
	html += "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\" class=\"phpreportmaker\"><tr><td>";
	html += "<input type=\"checkbox\" name=\"sel_" + name + "[]\" value=\"\" onClick=\"ewrpt_SelectAll(this);\"" + checkedall + " />" + EW_REPORT_POPUP_ALL + "<br />";
	for (var i=0; i<data.length; i++) {
		var checked = data[i][2] ? " checked" : "";
		if (data[i][0].substring(0,2)=="@@")
			showdivider = true;
		else if (showdivider) {
			showdivider = false; html += "<hr class=\"ewPopupHorizRule\" />";
		}
		html += "<input type=\"checkbox\" name=\"sel_" + name + "[]\" value=\"" + data[i][0] + "\" onClick=\"ewrpt_UpdateSelectAll(this);\"" + checked + " />" + data[i][1] + "<br />";
	}
	html += "</td></tr></table>";
	html += "</div>";
	html += "</div>";
	html += "</td></tr>";
	html += "<tr><td align=\"right\">";	
	html += "<input type=\"button\" name=\"OK\" id=\"" + name + "_OK\" value=\"" + EW_REPORT_POPUP_OK + "\" onClick=\"if (!ewrpt_SelectedEntry(this.form,'" + name + "')) alert('" + EW_REPORT_POPUP_NO_VALUE + "'); else {this.form.submit();ewrpt_HidePopup('" + name + "');return false;}\" />";
	html += "<input type=\"button\" name=\"Cancel\" value=\"" + EW_REPORT_POPUP_CANCEL + "\" onClick=\"ewrpt_HidePopup('" + name + "');return false;\" />";
	html += "&nbsp;&nbsp;&nbsp;</td></tr>";
	html += "</table>";
	html += "<div id='" + name + "_ResizeGrip' class='ewPopupSizeGrip'><img src=\"" + EW_REPORT_IMAGES_FOLDER + "/resize.gif\" width=\"9\" height=\"9\" border=\"0\"></div>";
	html += "</form>";	
	xGetElementById(name+'_Popup').innerHTML = html;
	ewrpt_SetupPopup(name);
}

function ewrpt_SelectedEntry(f,name) {
	var elemname = "sel_" + name + "[]";
	if (!f.elements[elemname]) return false;
	if (f.elements[elemname][0]) {
		for (var i=1; i<f.elements[elemname].length; i++) {
			if (f.elements[elemname][i].checked)
				return true;
		}
	} else {
		return f.elements[elemname].checked;
	}
	return false;
}

function ewrpt_SelectRange(f, name) {
	var rangeFrom, rangeTo;
	var elemname = "rf_" + name;
	rangeFrom = f.elements[elemname].options[f.elements[elemname].selectedIndex].value;
	var elemname = "rt_" + name;
	rangeTo = f.elements[elemname].options[f.elements[elemname].selectedIndex].value;
	if ((rangeFrom == null) || (rangeFrom == "") || (rangeTo == null) || (rangeTo == ""))
		return;
	elemname = "sel_" + name + "[]";
	ewrpt_SetRange(f, elemname, rangeFrom, rangeTo, true);
}

function ewrpt_ClearRange(elem) {
	var fromname, toname, rangeFrom, rangeTo;
	var f = elem.form;
	var elemname = elem.name;
	var name = elemname.substring(4, elemname.length-2); // remove "sel_" and "[]"
	fromname = "rf_" + name;
	toname = "rt_" + name;
	if (f.elements[fromname] && f.elements[toname]) {
		if (f.elements[fromname].selectedIndex > 0 && f.elements[toname].selectedIndex > 0) {
			rangeFrom = f.elements[fromname].options[f.elements[fromname].selectedIndex].value;
			rangeTo = f.elements[toname].options[f.elements[toname].selectedIndex].value;
			f.elements[fromname].selectedIndex = 0;
			f.elements[toname].selectedIndex = 0;
			ewrpt_SetRange(f, elemname, rangeFrom, rangeTo, false);
		}
	}
}

function ewrpt_SetRange(f, elemname, rangeFrom, rangeTo, set) {
	var bInRange = false;
	if (!f.elements[elemname]) return;
	if (f.elements[elemname][0]) {
		for (var i=0; i<f.elements[elemname].length; i++) {
			if (f.elements[elemname][i].value == rangeFrom) bInRange = true;
			if (bInRange)
				f.elements[elemname][i].checked = bInRange && set;
			else
				if (set) f.elements[elemname][i].checked = false;
			if (f.elements[elemname][i].value == rangeTo) bInRange = false;
		}
	} else {
		if (set)
			f.elements[elemname].checked = ((f.elements[elemname].value == rangeFrom) ||
							(f.elements[elemname].value == rangeTo));
	}
}

function ewrpt_SelectAll(elem) {
	var f = elem.form;
	var elemname = elem.name;
	if (!f.elements[elemname]) return;
	ewrpt_ClearRange(elem); // clear any range set
	if (f.elements[elemname][0]) {
		for (var i=0; i<f.elements[elemname].length; i++)
			f.elements[elemname][i].checked = elem.checked;	
	} else {
		f.elements[elemname].checked = elem.checked;	
	}
}

function ewrpt_UpdateSelectAll(elem) {
	var f = elem.form;
	var elemname = elem.name;	
	if (!f.elements[elemname]) return;
	ewrpt_ClearRange(elem); // clear any range set
	var allChecked = true;
	if (f.elements[elemname][0]) {
		for (var i=1; i<f.elements[elemname].length; i++) {
			if (!f.elements[elemname][i].checked) { 
				allChecked = false;
				break;
			}	
		}
		f.elements[elemname][0].checked = allChecked;
	}	
}
