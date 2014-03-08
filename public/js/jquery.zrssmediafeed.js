(function(h){h.fn.mediafeed=function(q,f,r){f=h.extend({limit:10,header:!0,titletag:"h4",date:!0,content:!0,snippet:!0,media:!0,showerror:!0,errormsg:"",key:null,ssl:!1},f);return this.each(function(s,l){var p=h(l),d="";
f.ssl&&(d="s");
p.hasClass("mediafeed")||p.addClass("mediafeed");
if(null==q)return!1;
d="http"+d+"://ajax.googleapis.com/ajax/services/feed/load?v=1.0&callback=?&q="+encodeURIComponent(q);
null!=f.limit&&(d+="&num="+f.limit);
null!=f.key&&(d+="&key="+f.key);
h.getJSON(d+"&output=json_xml",
function(b){if(200==b.responseStatus){var e=b.responseData,b=f,g=e.feed;
        //if(typeof(b.responseData) == "undefined" ){a = '<div class="feedMessage">There were no results retrieved from this feed. Please try refreshing the page or <a href="mailto:edipcurrentadmin@state.gov">contact us</a> for assistance.</div>';}
if(g){var a="",d="odd";
if(b.media){var j=e.xmlString;
"Microsoft Internet Explorer"==navigator.appName?(e=new ActiveXObject("Microsoft.XMLDOM"),e.async="false",e.loadXML(j)):e=(new DOMParser).parseFromString(j,"text/xml");
j=e.getElementsByTagName("item")}b.header&&(a+='<div class="rssHeader"><a href="'+g.link+'" title="'+g.description+'">'+g.title+"</a></div>");
if(typeof(b.responseData) == "undefined" && g.entries.length == 0 ){a = '<div class="feedMessage">There were no results retrieved from this feed. Please try refreshing the page or <a href="mailto:edipcurrentadmin@state.gov">contact us</a> for assistance.</div>';}
for(e=0;e<g.entries.length;e++){
var c=g.entries[e],i;
c.publishedDate&&(i=new Date(c.publishedDate),i=i.toLocaleDateString());
a+='<li class="rssRow '+d+'">';
a+='<div style="overflow:auto;">';
a+='<input type="hidden" class="feedLinkInput" value="'+ g.link +'" ></input>';
var thumbnail = '';



if(c.hasOwnProperty('mediaGroups'))
    {
        if(c.mediaGroups[0].hasOwnProperty('contents'))
            {
                if(c.mediaGroups[0].contents[0].hasOwnProperty('url'))
                    {
                        thumbnail = c.mediaGroups[0].contents[0].url;
                    }
                if(c.mediaGroups[0].contents[0].hasOwnProperty('thumbnails'))
                    {
                        if(c.mediaGroups[0].contents[0].thumbnails[0].hasOwnProperty('url'))
                            {
                                thumbnail = c.mediaGroups[0].contents[0].thumbnails[0].url;
                            }
                        
                    }
                
            }
        
        
    }
 
    if(thumbnail != '')
        {
a+='<div style="padding-bottom:7px; float:left;">';            
a+='<a class="feedInnerLink" style="float:left; width:85px;" href="javascript:void(0);" title="View this feed at '+g.title+'"><img style="float:left;width:75px;height:75px;" src="'+thumbnail+'" />';
a+='</a>';
a+='</div>';
        }
b.date&&i&&(a+="<strong class='date'>"+i+"</strong>");
a+='<a class="feedInnerLink" href="javascript:void(0);" title="View this feed at '+g.title+'"><span>'+c.title+'</span>';
a+='</a>';
a+='<div class="feedContent"><div class="feedHiddenContent">';
a+='<a class="feedInnerLink" href="javascript:void(0);" title="View this feed at '+g.title+'">';
if(c.hasOwnProperty('contentSnippet'))
    {
        a += '<p class="date">';
        var snippet = c.contentSnippet.replace(/<!--[\s\S]*?-->/g, ""); 
        snippet = snippet.replace(/&lt;!--[\s\S]*?--&gt;/g, ""); 
        snippet = snippet.replace(/&lt;!--[\s\S]*?.../g, "");  
        //alert(snippet);
        a+=truncateText(snippet,150);
        a += '</p>';
    }
a+='</a>';
a+='</div>';
a+='<div class="feedFullContent" style="display:none;">';    

if(c.content != c.contentSnippet)
    {
        a+=c.content;
    }
else
    {
        a+='The feed provider did not include source content. <br /> <a target="_blank" href="'+c.link+'">Click here</a> to read the full article from the source.';
    }


a+='</div>';
a+='<div class="feedContentMeta">';
a+='<a target="_blank"  href="'+c.link+'">read full article</a>';
a+='</div>';
a+='</div>';

a+='<div class="shareContainer">';
a+='<a class="share tooltip" title="Share in Corridor" target="_blank" href="'+generateCorridorShare(c)+'"><div class="shareIcon corridorShare"></div><span class="tttext classic">Share in Corridor</span></a>';
a+='<a class="share tooltip" title="Send by email" href="mailto:?Subject=Shared From the Current - '+strip(c.title)+'&body='+strip(c.link)+'" ><div class="shareIcon mailShare"></div><span class="tttext classic">Send by email</span></a>';
//a+='<form class="currentDiscussionForm" action="discussion/?page_id=23">';
//a+='<a class="share tooltip" title="Discuss in The Current" href="javascript:void(0);"  ><div class="shareIcon discussShare"></div><span class="tttext classic">Discuss in The Current</span></a>';
//a+='</form>'
a+='</div>';

        /*
        else
            {
                b.date&&i&&(a+="<strong class='date'>"+i+"</strong>");
a+='<a href="'+c.link+'" target="_blank" title="View this feed at '+g.title+'"><strong>'+c.title+"</strong>";
a+='<p class="date"></p></a>';
a+='<div class="shareContainer">';
a+='<a class="share" target="_blank" href="'+generateCorridorShare(g)+'"><div class="shareIcon corridorShare"></div></a>';
a+='<a class="share" href="mailto:?Subject=Shared From the Current - '+strip(c.title)+'&body='+strip(c.link)+'"><div class="shareIcon mailShare"></div></a>';
a+='</div>';
b.content&&(a+="<p>"+(b.snippet&&""!=c.contentSnippet?c.contentSnippet:c.content)+"</p>");
            }
                */
if(b.media&&0<j.length)
{
    c=j[e].getElementsByTagName("enclosure");
    if(0<c.length)
    {
        //for(var a=a+'<div class="rssMedia"><div>Media files</div><ul>',
        //k=0;k<c.length;k++)var m=c[k].getAttribute("url"),n=c[k].getAttribute("type"),o=c[k].getAttribute("length"),m='<li><a href="'+m+'" title="Download this media">'+m.split("/").pop()+"</a> ("+n+", ",n=Math.floor(Math.log(o)/Math.log(1024)),o=(o/Math.pow(1024,Math.floor(n))).toFixed(2)+" "+"bytes,kb,MB,GB,TB,PB".split(",")[n],a=a+(m+o+")</div></li>");a+="</ul></div>"
    }
    
}
a+="</div></li>";

d="odd"==d?"even":"odd"}h(l).html(a+"");h("a",l).attr("target",b.linktarget)}h.isFunction(r)&&r.call(this,p)}else {f.showerror&&
(g=""!=f.errormsg?f.errormsg:b.responseDetails),h(l).html('<div class="rssError"><p>'+g+'<br/><br/><div class="feedMessage">There were no results retrieved from this feed. Please try refreshing the page or <a href="mailto:edipcurrentadmin@state.gov">contact us</a> for assistance.</div>'+"</p></div>");}})})}})(jQuery);
        
    /*
else if(c.hasOwnProperty('link'))
{
    if(c.link.indexOf("flickr.com") != -1)
        {
            
            if(c.link.indexOf("id=") != -1)
                {
                    var components = c.link.split('id=');
                    var tempend = components[1].indexOf("&");
                    var end = components[0].length + tempend;
                }
           // alert(c.link.substring(c.link.indexOf("id="), end));
            
            
            //thumbnail = c.link;
        }
    
}
    */
    
    
    
    
