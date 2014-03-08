function strip(html)
{
   var tmp = document.createElement("DIV");
   tmp.innerHTML = html;
   return tmp.textContent||tmp.innerText;
}
function genericConfirm()
{
var r=confirm("Are you sure?");
if (r==true)
  {
  return true;
  }
else
  {
  return false;
  }
}

function destroyWidgetSelectionOverlay()
        {

            $('.editWidgetButton ul').hide();

            $('#__msg_overlay').remove();
            //alert('hi');
        }
function destroyAddWidgetOverlay()
{
    $('.add li ul').hide();
    //$('#__msg_overlay').remove();
}
function createWidgetSelectionOverlay()
{
    if($('#__msg_overlay').length == 0)
        {
            $('<div id="__msg_overlay">').css({
                "width" : "100%"
                , "height" : "100%"
                , "background" : "#000"
                , "position" : "fixed"
                , "top" : "0"
                , "left" : "0"
                , "zIndex" : "50"
                , "MsFilter" : "progid:DXImageTransform.Microsoft.Alpha(Opacity=20)"
                , "filter" : "alpha(opacity=20)"
                , "MozOpacity" : 0.2
                , "KhtmlOpacity" : 0.2
                , "opacity" : 0.2

            }).appendTo(document.body);
        }


}

function toggleFeedShowHideLinkText(x)
{
    if(x.html()== 'show full content')
        {
            x.html('hide full content');
        }
    else
        {
            x.html('show full content');
        }
}

function copyToClipboard (text) {
  window.prompt ("Copy to clipboard: Ctrl+C, Enter", text);
}

function disableCursor()
{
    $("*").css("cursor", "wait");
    $('#pageMask').css('display','block');
    //$("*").bind('click.navprevention',function(){return false;});
}
function enableCursor()
{
    $("*").css("cursor", "");
    $('#pageMask').css('display','none');
    //$("*").unbind('click.navprevention');
}

function truncateText (text,limit)
{

    return text.substring(0,limit);

}

function escapeRegExp(str) {
  return str.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
}

function clearSelection() {
    if(document.selection && document.selection.empty) {
        document.selection.empty();
    } else if(window.getSelection) {
        var sel = window.getSelection();
        sel.removeAllRanges();
    }
}

function alertUserMax()
{
    alert('Max number of personal Pages reached');

}

function alertUserPubMax()
{
    alert('Max number of published Pages reached');

}

function alertUserSubMax()
{
    alert('Max number of subscribed Pages reached');

}


function array_filter (arr, func) {
  // http://kevin.vanzonneveld.net
  // +   original by: Brett Zamir (http://brett-zamir.me)
  // +   input by: max4ever
  // +   improved by: Brett Zamir (http://brett-zamir.me)
  // %        note 1: Takes a function as an argument, not a function's name
  // *     example 1: var odd = function (num) {return (num & 1);};
  // *     example 1: array_filter({"a": 1, "b": 2, "c": 3, "d": 4, "e": 5}, odd);
  // *     returns 1: {"a": 1, "c": 3, "e": 5}
  // *     example 2: var even = function (num) {return (!(num & 1));}
  // *     example 2: array_filter([6, 7, 8, 9, 10, 11, 12], even);
  // *     returns 2: {0: 6, 2: 8, 4: 10, 6: 12}
  // *     example 3: var arr = array_filter({"a": 1, "b": false, "c": -1, "d": 0, "e": null, "f":'', "g":undefined});
  // *     returns 3: {"a":1, "c":-1};

  var retObj = {},
    k;

  func = func || function (v) { return v; };

  // Fix: Issue #73
  if (Object.prototype.toString.call(arr) === '[object Array]') {
    retObj = [];
  }

  for (k in arr) {
    if (func(arr[k])) {
      retObj[k] = arr[k];
    }
  }

  return retObj;
}


function implode (glue, pieces) {
  // http://kevin.vanzonneveld.net
  // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // +   improved by: Waldo Malqui Silva
  // +   improved by: Itsacon (http://www.itsacon.net/)
  // +   bugfixed by: Brett Zamir (http://brett-zamir.me)
  // *     example 1: implode(' ', ['Kevin', 'van', 'Zonneveld']);
  // *     returns 1: 'Kevin van Zonneveld'
  // *     example 2: implode(' ', {first:'Kevin', last: 'van Zonneveld'});
  // *     returns 2: 'Kevin van Zonneveld'
  var i = '',
    retVal = '',
    tGlue = '';
  if (arguments.length === 1) {
    pieces = glue;
    glue = '';
  }
  if (typeof(pieces) === 'object') {
    if (Object.prototype.toString.call(pieces) === '[object Array]') {
      return pieces.join(glue);
    }
    var first = 0;
    for (i in pieces) {
/*
if(first == 0)
{
	retVal += pieces[i];
	first = 1;
}
else
{
*/
      retVal += tGlue + pieces[i];
/*
}
*/

      tGlue = glue;
    }
    return retVal;
  }
  return pieces;
}


function parseArrayFromInput(str)
{
    str = str.replace(/^\s+|\s+$/g,'');
    //str = str.replace(/\s/g, ',');
    str = str.replace(/;/g, ',');
    str = str.replace(/\'/g, ',');
    str = str.replace(/[,]+/g, ',');
    str = str.replace(/\s+,/g, ',');
    str = str.replace(/,\s+/g, ',');

    var arr = str.split(",");

    arr = arr.clean("");
    arr = arr.clean(undefined);

    return arr;


}






function parseSMARTSearchString(str, prefix)
{
    var arr = parseArrayFromInput(str);


    for(var x = 0; x < arr.length; x++)
    {
        arr[x] = prefix + ":" + arr[x];
    }

    var returnMe = implode(' ', arr);
    return returnMe;

}

function commaDelineateArray(arr)
{
    var str = implode(',', arr);
    return str;
}

function reverseParseSMARTSearchString(str,prefix)
{
if(str == ' * ')
{return '';}
    var reg1 = new RegExp("(?:^| )" + prefix + ":", "gi");
    var reg2 = new RegExp("(?:^| )[a-zA-Z0-9]*:", "gi");

    var arr = str.split(reg1);
    var arr2 = [];
    for(var x=0; x < arr.length; x++)
    {
        var temp = arr[x].split(reg2);

        arr2.push(temp[0].replace(/^\s+|\s+$/g,''));


    }
arr2.clean(undefined);
arr2.clean('');

/*
  var arr = str.split(/(?:^| ).*:/);
    var arr2 = [];
    for(var x=0; x < arr.length; x++)
    {
        var temp = arr[x].split(":");
        if(temp.length == 2 && temp[0].toLowerCase().trim() == prefix.toLowerCase().trim())
            {
                arr2.push(temp[1]);
            }

    }
  */
    return commaDelineateArray(arr2);
}


Array.prototype.clean = function(deleteValue) {
  for (var i = 0; i < this.length; i++) {
    if (this[i] == deleteValue) {
      this.splice(i, 1);
      i--;
    }
  }
  return this;
};


