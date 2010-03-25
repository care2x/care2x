// JavaScript for Flyout Menu (Requires IE5+, NS6+ or FF1+)

var KILL_DELAY = 600

function Menu()
{
	this.CreateMenu = Menu_CreateMenu;
	this.CreateLink = Menu_CreateLink;
	this.CreateAction = Menu_CreateAction;

	this.AddItem = Menu_AddItem;
	this.SetChromeImages = Menu_SetChromeImages;
	this.SetDynamicStyles = Menu_SetDynamicStyles;
	this.SetHorizontalAlignment = Menu_SetHorizontalAlignment;
	this.SetMenuStyle = Menu_SetMenuStyle;
	this.SetRootMenuStyle = Menu_SetRootMenuStyle;
	this.SetOrientation = Menu_SetOrientation;
	this.SetSize = Menu_SetSize;
	this.SetSubMenuImage = Menu_SetSubMenuImage;
	this.SetVerticalAlignment = Menu_SetVerticalAlignment;
	this.SetShowHoverOnHighlight = Menu_SetShowHoverOnHighlight;
	this.SetClickToShowMenu = Menu_SetClickToShowMenu;
	
	//this.AddCssRule = Menu_AddCssRule;
	
	this.Render = Menu_Render;

	// internal properties	
	this._type = "root";
	this._aItems = new Array();
	this._sNodeID = null;
	this._sChildSetID = Menu_GetNewUniqueID();
	_Menu_TimersByUniqueID[this._sChildSetID] = this;
	
	this._bHasChrome = false;
	this._bHasSize = false;
	this._bHasStyleScheme = false;	
//	if (document.all && document.createStyleSheet) {
//		this._oStyleSheet = document.createStyleSheet();	  
//	} else {
//		this._oStyleSheet = document.createElement('STYLE');
//		this._oStyleSheet.setAttribute('type', 'text/css');
//	  document.body.appendChild(this._oStyleSheet);
//	}
	this._parentItem = null;
	this._parentMenu = this;
	this._sHAlign = "L";
	this._sOrientation = "H";
	this._sStyleMenu = "ewFlyoutMenuStyle";
	this._sStyleRootMenu = "ewFlyoutRootMenuStyle";
	this._sVAlign = "M";
	this._bShowHoverOnHighlight = false;
	this._bClickToShowMenu = false;
	
	this._sDefaultNormalStyle = "ewFlyoutMenuLinkNormalStyle";
	this._sDefaultHoverStyle = "ewFlyoutMenuLinkHoverStyle";
	this._sDefaultHighlightStyle = "ewFlyoutMenuLinkHighlightStyle";
	this._sFloatRule = "ewFlyoutMenuFloatStyle";
	
//	this._sDefaultNormalStyle = Menu_GetNewRuleName();
//	this._sDefaultHoverStyle = Menu_GetNewRuleName();
//	this._sDefaultHighlightStyle = Menu_GetNewRuleName();
//	this.AddCssRule("." + this._sDefaultNormalStyle, ewFlyoutMenuLinkNormalStyle);
//	this.AddCssRule("." + this._sDefaultHoverStyle, ewFlyoutMenuLinkHoverStyle);
//	this.AddCssRule("." + this._sDefaultHighlightStyle, ewFlyoutMenuLinkHighlightStyle);

	// initialize	
//	this._sFloatRule = Menu_GetNewRuleName();
//	this.AddCssRule("." + this._sFloatRule, "display: none; position: absolute;");
	
	//this.SetMenuStyle(ewFlyoutMenuStyle);
	//this.SetRootMenuStyle(ewFlyoutRootMenuStyle);

}

// support
var _Menu_CreatedItemsByUniqueID = new Array();
var _Menu_TimersByUniqueID = new Array();

//function Menu_AddCssRule(sSelector, sStyle)
//{
//	if (document.all && document.createStyleSheet) {
//		this._oStyleSheet.addRule(sSelector, sStyle);	  
//	} else {
//		var html = this._oStyleSheet.innerHTML;
//		html += "\n" + sSelector + " {" + sStyle + "}";
//		this._oStyleSheet.innerHTML = html;
//	}
//}

function getNNVersionNumber()
{
	if (navigator.appName == "Netscape") {
		var appVer = parseFloat(navigator.appVersion);
		if (appVer < 5) {
			return appVer;
		} else {
			if (typeof navigator.vendorSub != "undefined") {
				return parseFloat(navigator.vendorSub);
			}
		}
	}
	return 0;
}

// a Menu item is a container for other items, including
// other Menu items, Link items, and Action items
function Menu_CreateMenu()
{
	return new Menu_MenuItem(this);
}

// a Link item takes the user directly to another page
function Menu_CreateLink()
{
	return new Menu_LinkItem(this);
}

// an Action item executes script provided by the page author
function Menu_CreateAction()
{
	return new Menu_ActionItem(this);
}

// this is the constructor for a Menu item
function Menu_MenuItem(oParentMenu)
{
	Menu_ItemBase(this, oParentMenu);
	
	this.AddItem = Menu_AddItem;
	this.SetSize = Menu_SetSize;
	this.SetChromeImages = Menu_SetChromeImages;
	this.SetOrientation = Menu_SetOrientation;
	this.SetMenuStyle = Menu_SetMenuStyle;
	this.SetSubMenuImage = Menu_SetSubMenuImage;
	
	this.href = "";

	// internal properties	
	this._type = "menu";
	this._aItems = new Array();
	this._sChildSetID = Menu_GetNewUniqueID();

	this._bHasChrome = false;
	this._bHasSize = false;
	this._bHasStyleScheme = false;
	this._sHAlign = "L";
	this._sOrientation = "V";
	this._sVAlign = "M";
}

// this is the constructor for a Link item
function Menu_LinkItem(oParentMenu)
{
	Menu_ItemBase(this, oParentMenu);

	this.href = "#";

	// initialize
	this._type = "link";
}

// this is the constructor for an Action item
function Menu_ActionItem(oParentMenu)
{
	Menu_ItemBase(this, oParentMenu);

	this.action = null;

	// initialize
	this._type = "action";
}

// this helper function helps construct all Item classes
function Menu_ItemBase(oItem, oParentMenu)
{
	var sUniqueID = Menu_GetNewUniqueID();
	_Menu_CreatedItemsByUniqueID[sUniqueID] = oItem;
	oItem._sNodeID = sUniqueID;
	oItem._parentMenu = oParentMenu._parentMenu;
	oItem._parentItem = null;

	oItem.SetHighlight = Menu_SetHighlight;
	oItem.SetDynamicStyles = Menu_SetDynamicStyles;
	oItem.SetHorizontalAlignment = Menu_SetHorizontalAlignment;
	oItem.SetVerticalAlignment = Menu_SetVerticalAlignment;

	oItem.displayHtml = "&lt;item&gt;";

	// internal properties and events
	oItem.Activate = Menu_Activate;
	oItem.Deactivate = Menu_Deactivate;
	oItem.Hover = Menu_Hover;
	oItem.Unhover = Menu_Unhover;
	
	oItem._bActive = false;
	oItem._bHover = false;
	oItem._bHighlight = false;
}

// this method adds a menu to the owner
function Menu_AddItem(oItem)
{
	if (oItem._type != null)
		{
		if (oItem._type == "menu" || oItem._type == "link" || oItem._type == "action")
			{
			oItem._parentItem = this;
			this._aItems[this._aItems.length] = oItem;
			}
		}
}

function Menu_SetHighlight()
{
	this._bHighlight = true;
	if (this._parentItem != null)
		{
		if (this._parentItem._type == "menu")
			this._parentItem.SetHighlight();
		}
}

function Menu_SetSubMenuImage(sImageURL, cx, cy)
{
	this._sSubImage = sImageURL;
	this._cxSubImage = cx;
	this._cySubImage = cy;
}

function Menu_SetMenuStyle(sMenuStyle)
{
	if (sMenuStyle.length > 0)
		{
		var sRuleName = Menu_GetNewRuleName();
		this._parentMenu.AddCssRule("." + sRuleName, sMenuStyle);
		this._sStyleMenu = sRuleName;
		}
	else
		this._sStyleMenu = null;
}

function Menu_SetRootMenuStyle(sMenuStyle)
{
	if (sMenuStyle.length > 0)
		{
		var sRuleName = Menu_GetNewRuleName();
		this._parentMenu.AddCssRule("." + sRuleName, sMenuStyle);
		this._sStyleRootMenu = sRuleName;
		}
	else
		this._sStyleRootMenu = null;
}

function Menu_SetDynamicStyles(sNormalStyle, sHoverStyle, sHighlightStyle)
{
	this._bHasStyleScheme = true;

	//var oMenuStyleSheet = this._parentMenu._oStyleSheet;
		
	var sRuleName = Menu_GetNewRuleName();
	this._parentMenu.AddCssRule("." + sRuleName, sNormalStyle);
	this._sStyleNormal = sRuleName;
	
	sRuleName = Menu_GetNewRuleName();
	this._parentMenu.AddCssRule("." + sRuleName, sHoverStyle);
	this._sStyleHover = sRuleName;
	
	sRuleName = Menu_GetNewRuleName();
	this._parentMenu.AddCssRule("." + sRuleName, sHighlightStyle);
	this._sStyleHighlight = sRuleName;
}

function Menu_SetChromeImages(sImageURL_TopLeft, sImageURL_Top, sImageURL_TopRight, sImageURL_Left, sImageURL_Right, sImageURL_BottomLeft, sImageURL_Bottom, sImageURL_BottomRight, cxLeft, cxRight, cyTop, cyBottom)
{
	this._bHasChrome = true;
	this._sChromeTL = sImageURL_TopLeft;
	this._sChromeTM = sImageURL_Top;
	this._sChromeTR = sImageURL_TopRight;
	this._sChromeLF = sImageURL_Left;
	this._sChromeRT = sImageURL_Right;
	this._sChromeBL = sImageURL_BottomLeft;
	this._sChromeBM = sImageURL_Bottom;
	this._sChromeBR = sImageURL_BottomRight;
	this._cxChromeL = cxLeft;
	this._cxChromeR = cxRight;
	this._cyChromeT = cyTop;
	this._cyChromeB = cyBottom;
}

function Menu_SetOrientation(sOrientation)
{
	var s = sOrientation.substr(0, 1).toUpperCase();
	if (s == "H" || s == "V")
		{
		this._sOrientation = s;
		if (s == "V")
			this.SetSubMenuImage(EW_REPORT_IMAGES_FOLDER + "/flyout_arrow.gif", 4, 7);
		else
			this.SetSubMenuImage(EW_REPORT_IMAGES_FOLDER + "/flyout_arrow_h.gif", 7, 4);
		}
	else
		this._sOrientation = null;
}

// this method sets the size of 
function Menu_SetSize(cxWidth, cyHeight)
{
	this._bHasSize = true;
	this._cx = cxWidth;
	this._cy = cyHeight;
}

// this method set the horizontal text alignment
// Parameters
//		sHAlign
//			type: string
//			use: the first character of the string indicates the desired horizontal alignment
//			examples: L; left; Left; C; center; r; Right
function Menu_SetHorizontalAlignment(sHAlign)
{
	var s = sHAlign.substr(0, 1).toUpperCase();
	if (s == "L" || s == "C" || s == "R")
		this._sHAlign = s;
	else
		this._sHAlign = null;
}

function Menu_SetVerticalAlignment(sVAlign)
{
	var s = sVAlign.substr(0, 1).toUpperCase();
	if (s == "T" || s == "M" || s == "B")
		this._sVAlign = s;
	else
		this._sVAlign = null;
}

function Menu_SetShowHoverOnHighlight(bShow)
{
	this._bShowHoverOnHighlight = bShow;
}

function Menu_SetClickToShowMenu(bClick)
{
	this._bClickToShowMenu = bClick;
}

// Events
function Menu_OnClickLink(elmItem)
{
	var oItem = Menu_GetItemFromID(elmItem.id);
	oItem.Activate();
	window.location = oItem.href;
}

function Menu_OnClickAction(elmItem)
{
	var oItem = Menu_GetItemFromID(elmItem.id);
	oItem.Activate();
	eval(unescape(oItem.action));
	oItem.Deactivate();
}

function Menu_OnClickMenu(elmItem)
{
	var oItem = Menu_GetItemFromID(elmItem.id);
	if (oItem._parentMenu._bClickToShowMenu) {
		if (oItem._bActive)
			oItem.Deactivate();
		else
			oItem.Activate();
	} else {
		if (oItem.href != "")
			window.location = oItem.href;
	}
}

function Menu_OnOverLeaf(elmItem)
{
	var parentMenu = Menu_GetRootMenuFromID(elmItem.id);
	if (_Menu_TimersByUniqueID[parentMenu._sChildSetID])
	{
		window.clearTimeout(_Menu_TimersByUniqueID[parentMenu._sChildSetID]);
		_Menu_TimersByUniqueID[parentMenu._sChildSetID] = null;
	}
	var oItem = Menu_GetItemFromID(elmItem.id);
	if (! oItem._parentMenu._bClickToShowMenu)
		oItem.Activate();
	oItem.Hover();
}

function Menu_OnOverNode(elmItem)
{
	var parentMenu = Menu_GetRootMenuFromID(elmItem.id);
	if (_Menu_TimersByUniqueID[parentMenu._sChildSetID])
	{
		window.clearTimeout(_Menu_TimersByUniqueID[parentMenu._sChildSetID]);
		_Menu_TimersByUniqueID[parentMenu._sChildSetID] = null;
	}
	var oItem = Menu_GetItemFromID(elmItem.id);
	if (! oItem._parentMenu._bClickToShowMenu)
		oItem.Activate();
	oItem.Hover();	
}

function Menu_OnOutLeaf(elmItem)
{
	var oItem = Menu_GetItemFromID(elmItem.id);	
	oItem.Unhover();
	var parentMenu = Menu_GetRootMenuFromID(elmItem.id);
	_Menu_TimersByUniqueID[parentMenu._sChildSetID] = window.setTimeout("Menu_RemoveFlyout('" + elmItem.id + "')", KILL_DELAY);	
}

function Menu_OnOutNode(elmItem)
{
	var oItem = Menu_GetItemFromID(elmItem.id);
	oItem.Unhover();
	var parentMenu = Menu_GetRootMenuFromID(elmItem.id);
	_Menu_TimersByUniqueID[parentMenu._sChildSetID] = window.setTimeout("Menu_RemoveFlyout('" + elmItem.id + "')", KILL_DELAY);
}

// Event Helper
function Menu_GetItemFromID(sItemID)
{
	return _Menu_CreatedItemsByUniqueID[sItemID];
}

function Menu_Activate()
{
	this._bActive = true;
	var oParentItem;
	oParentItem = this._parentItem;
	var aItems = oParentItem._aItems;
	for (var nItem = 0; nItem < aItems.length; nItem++)
		{
		var oItem = aItems[nItem];
		if (oItem !== this)
			{
			oItem.Deactivate();
			Menu_Refresh(oItem);
			}
		}
	if (this._type == "menu")
		Menu_DisplaySubMenu(this);
	if (oParentItem._type == "menu")
		oParentItem.Activate();
}

function Menu_GetRootMenuFromID(id)
{
	var oItem = Menu_GetItemFromID(id);
	var parentMenu = oItem._parentMenu; 
	while (parentMenu != null && parentMenu != parentMenu._parentMenu)
		parentMenu = parentMenu._parentMenu;	
	return parentMenu;
}

function Menu_RemoveFlyout(id)
{
	var parentMenu = Menu_GetRootMenuFromID(id); 
	var aItems = parentMenu._aItems;
	for (var nItem = 0; nItem < aItems.length; nItem++)
		{
		var oItem = aItems[nItem];
		if (oItem !== this)
			{
			oItem.Deactivate();
			Menu_Refresh(oItem);
			}
		}	
}

function Menu_Deactivate()
{
	this._bActive = false;
	if (this._type == "menu")
		Menu_HideSubMenu(this);	
}

function Menu_Hover()
{
	this._bHover = true;
	Menu_Refresh(this);
}

function Menu_Unhover()
{
	this._bHover = false;
	Menu_Refresh(this);
}

function Menu_Refresh(oItem)
{
	var elmItem = document.getElementById(oItem._sNodeID);
	var sRule;
	if (oItem._bHover) {
		if ((!oItem._bHighlight) || (oItem._bHighlight && oItem._parentMenu._bShowHoverOnHighlight)) {
			sRule = Menu_GetChildHoverStyle(oItem);
			elmItem.className = sRule;
		}
		if (oItem._type == "menu" && oItem.href != "" || oItem._type == "link")
			window.status = oItem.href;
	} else {
		if (oItem._type == "menu") {
			if (! oItem._bActive)
				{
				if (oItem._bHighlight)
					sRule = Menu_GetChildHighlightStyle(oItem);
				else
					sRule = Menu_GetChildNormalStyle(oItem);
				elmItem.className = sRule;
				}
		} else {
			if (oItem._bHighlight)
				sRule = Menu_GetChildHighlightStyle(oItem);
			else
				sRule = Menu_GetChildNormalStyle(oItem);
			elmItem.className = sRule;
			if (oItem._type == "link")
				window.status = window.defaultStatus;
		}
	}
}

function Menu_DisplaySubMenu(item)
{
	var element = document.getElementById(item._sNodeID);
	var elmDiv = document.getElementById("div_" + item._sChildSetID);
	if (elmDiv == null)
		{
		elmDiv = document.createElement("DIV");
		elmDiv.id = "div_" + item._sChildSetID;
		document.body.appendChild(elmDiv);
		elmDiv.className = item._parentMenu._sFloatRule;
		elmDiv.innerHTML = item._sHtml;
		}
	elmDiv.style.visible = "hidden";
	elmDiv.style.display = "block";
	if (Menu_GetChildOrientation(item._parentItem) == "H")
		{
		if (getNNVersionNumber() == 6) {
			elmDiv.style.top = (Menu_GetOffsetTop(element) + Menu_GetChildHeight(item)) + 'px';			
		} else {
			elmDiv.style.top = (Menu_GetOffsetTop(element) + element.clientHeight) + 'px';		
			if (elmDiv.style.pixelBottom > (document.body.scrollTop + document.body.clientHeight))
				elmDiv.style.top = (Menu_GetOffsetTop(element) - elmDiv.clientHeight) + 'px';
		}
		if (item._sHAlign == "L")
			elmDiv.style.left = Menu_GetOffsetLeft(element) + 'px';
		else if(item._sHAlign == "R")
			elmDiv.style.left = ((Menu_GetOffsetLeft(element) + element.clientWidth) - oDiv.clientWidth) + 'px';
		}
	else
		{
		elmDiv.style.top = Menu_GetOffsetTop(element) + 'px';
		if ((Menu_GetOffsetTop(elmDiv) + elmDiv.clientHeight) > (document.body.scrollTop + document.body.clientHeight))
			{
			elmDiv.style.top = Math.max((Menu_GetOffsetTop(element) - elmDiv.clientHeight) + element.clientHeight, 0) + 'px';
			}
		if (getNNVersionNumber() == 6)
			elmDiv.style.left = (Menu_GetOffsetLeft(element) + Menu_GetChildWidth(item) - 6) + 'px';	
		else
			elmDiv.style.left = (Menu_GetOffsetLeft(element) + element.clientWidth) + 'px';			
		}
	elmDiv.style.visible = "visible";
}

function Menu_HideSubMenu(item)
{
	var oDiv = document.getElementById("div_" + item._sChildSetID);
	if (oDiv != null)
		{
		oDiv.style.display = "none";
		for (var nItem = 0; nItem < item._aItems.length; nItem++)
			{
			var oChildItem = item._aItems[nItem];
			if (oChildItem._type == "menu" && oChildItem._bActive)
				oChildItem.Deactivate();
			}
		}
}

function Menu_GetOffsetTop(element)
{
	return element.offsetTop + (element.offsetParent != null ? Menu_GetOffsetTop(element.offsetParent) : 0);
}

function Menu_GetOffsetLeft(element)
{
	return element.offsetLeft + (element.offsetParent != null ? Menu_GetOffsetLeft(element.offsetParent) : 0);
}

// this method writes the HTML for the entire menu (including children) inline to the document
function Menu_Render()
{
	var sID;	
	sID = Menu_GenerateHtml(this);	
	document.write(this._sHtml);
	return sID;
}

// this function produces the HTML for the menu and sub menus
function Menu_GenerateHtml(item)
{
	// outer TABLE start tag
	var sMenuBeginOpen = "<table";
	var sMenuBeginClose = ">";
	
	var sUniqueID = " id=\"" + item._sChildSetID + "\"";

	var sParentID = "";
	var sParentItemID = item._sNodeID;
	if (sParentItemID != null)
		if (sParentItemID.length > 0)
			sParentID = " _menu_parentID=\"" + sParentItemID + "\"";
	
	var sWhiteSpace = " cellpadding=\"0\" cellspacing=\"0\""
		
	var sClass = "";	
	sClass = Menu_GetChildMenuStyle(item);	
	if (sClass.length > 0)
		sClass = " class=\"" + sClass + "\"";

	var sMenuWidth = "";
	var cx = Menu_GetBodyWidth(item);
	if (cx > 0)
		{
		cx += Menu_GetChildChromeWidthLeft(item) + Menu_GetChildChromeWidthRight(item);
		sMenuWidth = " width=\"" + cx.toString() + "px\"";
		}
	
	var sMenuHeight = "";
	var cy = Menu_GetBodyHeight(item);
	if (cy > 0)
		{
		cy += Menu_GetChildChromeHeightTop(item) + Menu_GetChildChromeHeightBottom(item);
		sMenuHeight = " height=\"" + cy.toString() + "px\"";
		}
		
	var sMenuBeginTag = sMenuBeginOpen + sUniqueID + sParentID + sWhiteSpace + sClass + sMenuWidth + sMenuHeight + sMenuBeginClose;
	
	// outer TABLE end tag
	var sMenuEndTag = "</table>";
	
	// chrome
	var sChromeTop = Menu_GetChromeTop(item);
	var sChromeBottom = Menu_GetChromeBottom(item);

	var sRows = "";
	var sRowBeginTag = "<tr>";
	var sRowEndTag = "</tr>";

	// contents	
	var cRows = Menu_GetRowCount(item);
	var cCols = Menu_GetColumnCount(item);
	for (var nRow = 1; nRow <= cRows; nRow++)
		{
		var sCols = "";
		for (var nCol = 1; nCol <= cCols; nCol++)
			{
			sCols += Menu_GetItemHtml(item._aItems[(nRow - 1) + (nCol - 1)]);
			}
		sRows += sRowBeginTag + Menu_GetChromeLeft(item) + sCols + Menu_GetChromeRight(item) + sRowEndTag;
		}
	
	// Place the HTML inside a property of the menu item
	var sMenu = sMenuBeginTag + sChromeTop + sRows + sChromeBottom + sMenuEndTag;
	item._sHtml = sMenu;
	
	// Recursively build child menus	
	for (var nItem = 0; nItem < item._aItems.length; nItem++)
		{
		oItem = item._aItems[nItem];
		if (oItem._type == "menu")
			Menu_GenerateHtml(oItem);
		}
	return sParentItemID;
}

function Menu_GetItemHtml(item)
{
	var sItemBeginTag;
	var sItemBeginTagOpen = "<td";
	var sItemBeginTagClose = "><div style=\"position:relative; left:0px; top:0px;\">";
	var sItemEndTag = "</div></td>";

	var sUniqueID = " id=\"" + item._sNodeID + "\"";
	
	var sClass = "";
	if (item._bHighlight)
		sClass = Menu_GetChildHighlightStyle(item);
	else
		sClass = Menu_GetChildNormalStyle(item);
	sClass = " class=\"" + sClass + "\"";
			
	var sWidth;
	var sHeight;
	var cx;
	var cy;
	cx = Menu_GetParentWidth(item);
	cy = Menu_GetParentHeight(item);
	if (cx > 0)
		sWidth = " width=\"" + cx.toString() + "px\"";
	if (cy > 0)
		sHeight = " height=\"" + cy.toString() + "px\"";
		
	var sHAlign = Menu_GetChildHAlign(item);
	sHAlign = (sHAlign == "L") ? "left" : (sHAlign == "C") ? "center" : (sHAlign == "R") ? "right" : "";
	if (sHAlign.length > 0)
		sHAlign = " align=\"" + sHAlign + "\""
	
	var sVAlign = Menu_GetChildVAlign(item);
	sVAlign = (sVAlign == "T") ? "top" : (sVAlign == "M") ? "middle" : (sVAlign == "B") ? "bottom" : "";
	if (sVAlign.length > 0)
		sVAlign = " valign=\"" + sVAlign + "\""
	
	var sOnClick = "";
	if (item._type == "link")
		sOnClick = " onclick=\"javascript:Menu_OnClickLink(this);\" ondblclick=\"javascript:Menu_OnClickLink(this);\"";
	else if(item._type == "action")
		sOnClick = " onclick=\"javascript:Menu_OnClickAction(this);\" ondblclick=\"javascript:Menu_OnClickAction(this);\"";
	else if(item._type == "menu")
		sOnClick = " onclick=\"javascript:Menu_OnClickMenu(this);\" ondblclick=\"javascript:Menu_OnClickMenu(this);\"";
		
	var sOnOver = "";
	if (item._type == "link" || item._type == "action")
		sOnOver = " onmouseover=\"javascript:Menu_OnOverLeaf(this);\"";
	else if(item._type == "menu")
		sOnOver = " onmouseover=\"javascript:Menu_OnOverNode(this);\"";
	
	var sOnOut = "";
	if (item._type == "link" || item._type == "action")
		sOnOut = " onmouseout=\"javascript:Menu_OnOutLeaf(this)\"";
	else if(item._type == "menu")
		sOnOut = " onmouseout=\"javascript:Menu_OnOutNode(this)\"";
	
	sItemBeginTag = sItemBeginTagOpen + sUniqueID + sClass + sWidth + sHeight + sHAlign + sVAlign + sOnClick + sOnOver + sOnOut + sItemBeginTagClose;
	
	var sSubImage = "";
	if (item._type == "menu" && item._aItems.length > 0)
		{
		var cxImg = Menu_GetParentSubMenuImageWidth(item);
		var cyImg = Menu_GetParentSubMenuImageHeight(item);
		sSubImage = "<div style=\"float: right; height: 100%;width: " + cyImg.toString() + "px;\"><img style=\"vertical-align:middle;\" src=\"" + Menu_GetParentSubMenuImageSrc(item) + "\" width=\"" + cxImg + "\" height=\"" + cyImg + "\"></div>";
		}
	
	return sItemBeginTag + sSubImage + item.displayHtml + sItemEndTag;
}

// These functions help build the "chrome" images around the menu
function Menu_GetChromeTop(item)
{
	var sTL = Menu_GetChildChromeTL(item);
	var sTM = Menu_GetChildChromeTM(item);
	var sTR = Menu_GetChildChromeTR(item);
	
	var cy = Menu_GetChildChromeHeightTop(item);
	var cxL = Menu_GetChildChromeWidthLeft(item);
	var cxR = Menu_GetChildChromeWidthRight(item);
	
	var sTop = "";
	if (sTL.length > 0 && sTM.length > 0 && sTR.length > 0 && cy > 0 && cxL > 0 && cxR > 0)
		{
		var sRowBegin = "<tr height=\"" + cy.toString() + "px\">";
		var sRowEnd = "</tr>";
		
		var sTDEnd = "</td>";
		var sTDTL = "<td width=\"" + cxL.toString() + "px\" height=\"" + cy.toString() + "px\">";
		var sImgTL = "<img src=\"" + sTL + "\" width=\"" + cxL.toString() + "px\" height=\"" + cy.toString() + "px\">";

		var cx = Menu_GetBodyWidth(item);
		var sTDWidth;
		var sImgWidth;
		if (cx > 0)
			{
			sTDWidth = " width=\"" + cx.toString() + "px\"";
			sImgWidth = sTDWidth;
			}
		else
			{
			sTDWidth = "";
			sImgWidth = " width=\"100%\"";
			}
		var cCols = Menu_GetColumnCount(item);
		var sTDTM = "<td" + sTDWidth + " colspan=\"" + cCols.toString() + "\">";
		var sImgTM = "<img src=\"" + sTM + "\"" + sImgWidth + " height=\"" + cy.toString() + "px\">";
		
		var sTDTR = "<td width=\"" + cxR.toString() + "px\" height=\"" + cy.toString() + "px\">";
		var sImgTR = "<img src=\"" + sTR + "\" width=\"" + cxR.toString() + "px\" height=\"" + cy.toString() + "px\">";
		
		sTop = sRowBegin + sTDTL + sImgTL + sTDEnd + sTDTM + sImgTM + sTDEnd + sTDTR + sImgTR + sTDEnd + sRowEnd;
		}
	return sTop;
}

function Menu_GetChromeBottom(item)
{
	var sBL = Menu_GetChildChromeBL(item);
	var sBM = Menu_GetChildChromeBM(item);
	var sBR = Menu_GetChildChromeBR(item);
	
	var cy = Menu_GetChildChromeHeightBottom(item);
	var cxL = Menu_GetChildChromeWidthLeft(item);
	var cxR = Menu_GetChildChromeWidthRight(item);
	
	var sBottom = "";
	if (sBL.length > 0 && sBM.length > 0 && sBR.length > 0 && cy > 0 && cxL > 0 && cxR > 0)
		{
		var sRowBegin = "<tr height=\"" + cy.toString() + "px\">";
		var sRowEnd = "</tr>";
		
		var sTDEnd = "</td>";
		var sTDBL = "<td width=\"" + cxL.toString() + "px\" height=\"" + cy.toString() + "px\">";
		var sImgBL = "<img src=\"" + sBL + "\" width=\"" + cxL.toString() + "px\" height=\"" + cy.toString() + "px\">";

		var cx = Menu_GetBodyWidth(item);
		var sTDWidth;
		var sImgWidth;
		if (cx > 0)
			{
			sTDWidth = " width=\"" + cx.toString() + "px\"";
			sImgWidth = sTDWidth;
			}
		else
			{
			sTDWidth = "";
			sImgWidth = " width=\"100%\"";
			}
		var cCols = Menu_GetColumnCount(item);
		var sTDBM = "<td" + sTDWidth + " colspan=\"" + cCols.toString() + "\">";
		var sImgBM = "<img src=\"" + sBM + "\"" + sImgWidth + " height=\"" + cy.toString() + "px\">";
		
		var sTDBR = "<td width=\"" + cxR.toString() + "px\" height=\"" + cy.toString() + "px\">";
		var sImgBR = "<img src=\"" + sBR + "\" width=\"" + cxR.toString() + "px\" height=\"" + cy.toString() + "px\">";
		
		sBottom = sRowBegin + sTDBL + sImgBL + sTDEnd + sTDBM + sImgBM + sTDEnd + sTDBR + sImgBR + sTDEnd + sRowEnd;
		}
	return sBottom;
}

function Menu_GetChromeLeft(item)
{
	var sLF = Menu_GetChildChromeLF(item);
	
	var cy = Menu_GetChildHeight(item);
	var cx = Menu_GetChildChromeWidthLeft(item);
	
	var sLeft = "";
	if (sLF.length > 0 && cx > 0)
		{
		var sTDEnd = "</td>";
		var sTDHeight;
		var sImgHeight;
		if (cy > 0)
			{
			sTDHeight = " height=\"" + cy.toString() + "px\"";
			sImgHeight = sTDHeight;
			}
		else
			{
			sTDHeight = " height=\"100%\"";
			sImgHeight = " height=\"100%\"";
			}
		var sTDLF = "<td width=\"" + cx.toString() + "px\"" + sTDHeight + ">";
		var sImgLF = "<img src=\"" + sLF + "\" width=\"" + cx.toString() + "px\"" + sImgHeight + ">";
		
		sLeft = sTDLF + sImgLF + sTDEnd;
		}
	return sLeft;
}

function Menu_GetChromeRight(item)
{
	var sRT = Menu_GetChildChromeRT(item);
	
	var cy = Menu_GetChildHeight(item);
	var cx = Menu_GetChildChromeWidthRight(item);
	
	var sRight = "";
	if (sRT.length > 0 && cx > 0)
		{
		var sTDEnd = "</td>";
		var sTDHeight;
		var sImgHeight;
		if (cy > 0)
			{
			sTDHeight = " height=\"" + cy.toString() + "px\"";
			sImgHeight = sTDHeight;
			}
		else
			{
			sTDHeight = " height=\"100%\"";
			sImgHeight = " height=\"100%\"";
			}
		var sTDRT = "<td width=\"" + cx.toString() + "px\"" + sTDHeight + ">";
		var sImgRT = "<img src=\"" + sRT + "\" width=\"" + cx.toString() + "px\"" + sImgHeight + ">";
		
		sRight = sTDRT + sImgRT + sTDEnd;
		}
	return sRight;
}

// These global variables and helper functions generate autoincrementing names
var _cMenu_StyleRuleCount = 0;
function Menu_GetNewRuleName()
{
	_cMenu_StyleRuleCount++;
	return "Menu_DynamicRule" + _cMenu_StyleRuleCount.toString();
}

var _cMenu_UniqueIDCount = 0;
function Menu_GetNewUniqueID()
{
	_cMenu_UniqueIDCount++;
	return "Menu_UniqueID_" + _cMenu_UniqueIDCount.toString();
}

// These helper functions are used by the HTML generator functions
function Menu_GetRowCount(parent)
{
	if (Menu_GetChildOrientation(parent) == "H")
		return 1;
	else
		return parent._aItems.length;
}

function Menu_GetColumnCount(parent)
{
	if (Menu_GetChildOrientation(parent) == "V")
		return 1;
	else
		return parent._aItems.length;
}

function Menu_GetBodyWidth(parent)
{
	var cx;
	if (Menu_GetChildOrientation(parent) == "H")
		cx = Menu_GetChildWidth(parent) * parent._aItems.length;
	else
		cx = Menu_GetChildWidth(parent);
	return cx;
}

function Menu_GetBodyHeight(parent)
{
	var cy;
	if (Menu_GetChildOrientation(parent) == "V")
		cy = Menu_GetChildHeight(parent) * parent._aItems.length;
	else
		cy = Menu_GetChildHeight(parent);
	return cy;
}

// these recursive functions allow children items to inherit properties from their parents
//
// Size
function Menu_GetHasSize(item)
{
	return (item._bHasSize != null ? item._bHasSize : false);
}

function Menu_GetSelfOrAncestorWithSize(item)
{
	return (Menu_GetHasSize(item) ? item : (item._parentItem != null ? Menu_GetSelfOrAncestorWithSize(item._parentItem) : null));
}

function Menu_GetAncestorWithSize(item)
{
	return item._parentItem != null ? Menu_GetSelfOrAncestorWithSize(item._parentItem) : null;
}

function Menu_GetChildWidth(item)
{
	var oItemWithSize = Menu_GetSelfOrAncestorWithSize(item);
	return (oItemWithSize != null ? oItemWithSize._cx : 0);
}

function Menu_GetChildHeight(item)
{
	var oItemWithSize = Menu_GetSelfOrAncestorWithSize(item);
	return (oItemWithSize != null ? oItemWithSize._cy : 0);
}

function Menu_GetParentWidth(item)
{
	var oItemWithSize = Menu_GetAncestorWithSize(item);
	return (oItemWithSize != null ? oItemWithSize._cx : 0);
}

function Menu_GetParentHeight(item)
{
	var oItemWithSize = Menu_GetAncestorWithSize(item);
	return (oItemWithSize != null ? oItemWithSize._cy : 0);
}

// StyleScheme
function Menu_GetHasStyleScheme(item)
{
	return (item._bHasStyleScheme != null ? item._bHasStyleScheme : false);
}

function Menu_GetSelfOrAncestorWithStyleScheme(item)
{
	return (Menu_GetHasStyleScheme(item) ? item : (item._parentItem != null ? Menu_GetSelfOrAncestorWithStyleScheme(item._parentItem) : null));
}

function Menu_GetChildNormalStyle(item)
{
	var oItemWithStyle = Menu_GetSelfOrAncestorWithStyleScheme(item);
	var sStyle = oItemWithStyle != null ? oItemWithStyle._sStyleNormal : item._parentMenu._sDefaultNormalStyle;
	return sStyle;
}

function Menu_GetChildHighlightStyle(item)
{
	var oItemWithStyle = Menu_GetSelfOrAncestorWithStyleScheme(item);
	var sStyle = oItemWithStyle != null ? oItemWithStyle._sStyleHighlight : item._parentMenu._sDefaultHighlightStyle;
	return sStyle;
}

function Menu_GetChildHoverStyle(item)
{
	var oItemWithStyle = Menu_GetSelfOrAncestorWithStyleScheme(item);
	var sStyle = oItemWithStyle != null ? oItemWithStyle._sStyleHover : item._parentMenu._sDefaultHoverStyle;
	return sStyle;
}

// MenuStyle
function Menu_GetChildMenuStyle(item, isSubMenu)
{	
	if (!isSubMenu && item._sStyleRootMenu != null)
		return item._sStyleRootMenu;
	else if (item._sStyleMenu != null)
		return item._sStyleMenu;
	else
		if (item._parentItem != null)			
			return Menu_GetChildMenuStyle(item._parentItem, true);
}

// Chrome
function Menu_GetHasChrome(item)
{
	return (item._bHasChrome != null ? item._bHasChrome : false);
}

function Menu_GetSelfOrAncestorWithChrome(item)
{
	return (Menu_GetHasChrome(item) ? item : (item._parentItem != null ? Menu_GetSelfOrAncestorWithChrome(item._parentItem) : null));
}

function Menu_GetChildChromeTL(item)
{
	var oItemWithChrome = Menu_GetSelfOrAncestorWithChrome(item);
	return (oItemWithChrome != null ? oItemWithChrome._sChromeTL : "");
}

function Menu_GetChildChromeTM(item)
{
	var oItemWithChrome = Menu_GetSelfOrAncestorWithChrome(item);
	return (oItemWithChrome != null ? oItemWithChrome._sChromeTM : "");
}

function Menu_GetChildChromeTR(item)
{
	var oItemWithChrome = Menu_GetSelfOrAncestorWithChrome(item);
	return (oItemWithChrome != null ? oItemWithChrome._sChromeTR : "");
}

function Menu_GetChildChromeLF(item)
{
	var oItemWithChrome = Menu_GetSelfOrAncestorWithChrome(item);
	return (oItemWithChrome != null ? oItemWithChrome._sChromeLF : "");
}

function Menu_GetChildChromeRT(item)
{
	var oItemWithChrome = Menu_GetSelfOrAncestorWithChrome(item);
	return (oItemWithChrome != null ? oItemWithChrome._sChromeRT : "");
}

function Menu_GetChildChromeBL(item)
{
	var oItemWithChrome = Menu_GetSelfOrAncestorWithChrome(item);
	return (oItemWithChrome != null ? oItemWithChrome._sChromeBL : "");
}

function Menu_GetChildChromeBM(item)
{
	var oItemWithChrome = Menu_GetSelfOrAncestorWithChrome(item);
	return (oItemWithChrome != null ? oItemWithChrome._sChromeBM : "");
}

function Menu_GetChildChromeBR(item)
{
	var oItemWithChrome = Menu_GetSelfOrAncestorWithChrome(item);
	return (oItemWithChrome != null ? oItemWithChrome._sChromeBR : "");
}

function Menu_GetChildChromeWidthLeft(item)
{
	var oItemWithChrome = Menu_GetSelfOrAncestorWithChrome(item);
	return (oItemWithChrome != null ? oItemWithChrome._cxChromeL : 0);
}

function Menu_GetChildChromeWidthRight(item)
{
	var oItemWithChrome = Menu_GetSelfOrAncestorWithChrome(item);
	return (oItemWithChrome != null ? oItemWithChrome._cxChromeR : 0);
;
}

function Menu_GetChildChromeHeightTop(item)
{
	var oItemWithChrome = Menu_GetSelfOrAncestorWithChrome(item);
	return (oItemWithChrome != null ? oItemWithChrome._cyChromeT : 0);
}

function Menu_GetChildChromeHeightBottom(item)
{
	var oItemWithChrome = Menu_GetSelfOrAncestorWithChrome(item);
	return (oItemWithChrome != null ? oItemWithChrome._cyChromeB : 0);
}

// Orientation
function Menu_GetHasOrientation(item)
{
	return (item._sOrientation != null);
}

function Menu_GetSelfOrAncestorWithOrientation(item)
{
	return (Menu_GetHasOrientation(item) ? item : (item._parentItem != null ? Menu_GetSelfOrAncestorWithOrientation(item._parentItem) : null));
}

function Menu_GetChildOrientation(item)
{
	var oItemWithOrientation = Menu_GetSelfOrAncestorWithOrientation(item);
	return (oItemWithOrientation != null ? oItemWithOrientation._sOrientation : "H");
}

// Sub-menu images
function Menu_GetHasSubMenuImage(item)
{
	return (item._sSubImage != null);
}

function Menu_GetSelfOrAncestorWithSubMenuImage(item)
{
	return (Menu_GetHasSubMenuImage(item) ? item : (item._parentItem != null ? Menu_GetSelfOrAncestorWithSubMenuImage(item._parentItem) : null));
}

function Menu_GetAncestorWithSubMenuImage(item)
{
	return item._parentItem != null ? Menu_GetSelfOrAncestorWithSubMenuImage(item._parentItem) : null;
}

function Menu_GetChildSubMenuImageSrc(item)
{
	var oItemWithSubMenuImage = Menu_GetSelfOrAncestorWithSubMenuImage(item);
	return (oItemWithSubMenuImage != null ? oItemWithSubMenuImage._sSubImage : null);
}

function Menu_GetChildSubMenuImageWidth(item)
{
	var oItemWithSubMenuImage = Menu_GetSelfOrAncestorWithSubMenuImage(item);
	return (oItemWithSubMenuImage != null ? oItemWithSubMenuImage._cxSubImage : null);
}

function Menu_GetChildSubMenuImageHeight(item)
{
	var oItemWithSubMenuImage = Menu_GetSelfOrAncestorWithSubMenuImage(item);
	return (oItemWithSubMenuImage != null ? oItemWithSubMenuImage._cySubImage : null);
}

function Menu_GetParentSubMenuImageSrc(item)
{
	var oItemWithSubMenuImage = Menu_GetAncestorWithSubMenuImage(item);
	return (oItemWithSubMenuImage != null ? oItemWithSubMenuImage._sSubImage : null);
}

function Menu_GetParentSubMenuImageWidth(item)
{
	var oItemWithSubMenuImage = Menu_GetAncestorWithSubMenuImage(item);
	return (oItemWithSubMenuImage != null ? oItemWithSubMenuImage._cxSubImage : null);
}

function Menu_GetParentSubMenuImageHeight(item)
{
	var oItemWithSubMenuImage = Menu_GetAncestorWithSubMenuImage(item);
	return (oItemWithSubMenuImage != null ? oItemWithSubMenuImage._cySubImage : null);
}

// Horizontal Alignment
function Menu_GetHasHorizontalAlignment(item)
{
	return (item._sHAlign != null);
}

function Menu_GetSelfOrAncestorWithHorizontalAlignment(item)
{
	return (Menu_GetHasHorizontalAlignment(item) ? item : (item._parentItem != null ? Menu_GetSelfOrAncestorWithHorizontalAlignment(item._parentItem) : null));
}

function Menu_GetChildHAlign(item)
{
	var oItemWithHAlign = Menu_GetSelfOrAncestorWithHorizontalAlignment(item);
	return (oItemWithHAlign != null ? oItemWithHAlign._sHAlign : "L");
}

// Vertical Alignment
function Menu_GetHasVerticalAlignment(item)
{
	return (item._sVAlign != null)
}

function Menu_GetSelfOrAncestorWithVerticalAlignment(item)
{
	return (Menu_GetHasVerticalAlignment(item) ? item : (item._parentItem != null ? Menu_GetSelfOrAncestorWithVerticalAlignment(item._parentItem) : null));
}

function Menu_GetChildVAlign(item)
{
	var oItemWithVAlign = Menu_GetSelfOrAncestorWithVerticalAlignment(item);
	return (oItemWithVAlign != null ? oItemWithVAlign._sVAlign : "M");
}
