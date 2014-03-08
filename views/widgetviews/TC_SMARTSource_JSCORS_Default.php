<?php



if(!isset($TC_SMARTSource_JSCORS_Default_widgetEntity_ID))
{
    
    throw new Exception("cannot load SMART widget.");
    
}
if(isset($TC_SMARTSource_JSCORS_Default_widget))
{
    $model = $TC_SMARTSource_JSCORS_Default_widget;
}
else
{
    $modelBuilder = new TC_SMARTSource_Builder($TC_SMARTSource_JSCORS_Default_widgetEntity_ID);
    $model = $modelBuilder->getModel();
    unset($modelBuilder);
    
}






?>

<script type="text/javascript">

$(document).ready(function () {
if(!$.browser.msie)
{
    //alert('test');

var soapTemplate = $('#soap-template-<?php echo $TC_SMARTSource_JSCORS_Default_widgetEntity_ID ;?>');
var soapBody = soapTemplate.html();

//.replace(
//new RegExp( "\\$\\{[^}]+\\}", "i" ),
//zip.val()
//);
 
soapBody = $.trim( soapBody );

                $.ajax({
                        type: 'POST',
                        url: 'http://repository.state.gov/_vti_bin/search.asmx',
                        contentType: "text/xml; charset=utf-8",
		        dataType: "xml",
                        data: soapBody,
                        processData: false,
                        xhrFields: {
			  withCredentials: true
                        },
beforeSend: function(req) {

//req.setRequestHeader(
//"SOAPAction",
//"urn:Microsoft.Search/Status"
//);

            //req.setRequestHeader("Method", "POST");
            //req.setRequestHeader("Content-Type", "text/xml" + "; charset=\"" + "UTF-8" + "\"");
         },
			  
                    //data: {        
                    //user_ID: '1234'
                    //},
                success: function(data2){


                    var content = document.getElementById('widget-<?php echo $TC_SMARTSource_JSCORS_Default_widgetEntity_ID ;?>');
                    var html = '';
			  html+='<ul class="mediafeed">';

                    var docElement = data2.documentElement;
                    var jqdocElement = $(docElement);
                    
                    x=jqdocElement.children().first().children().first().children().first().text().trim();
                    xml = $.parseXML(x);
                    xml = $(x);

                    if(!xml.find('Document').length)
                    {
                        html+='<div class="feedMessage">There were no results retrieved from this feed. Please try refreshing the page or <a href="mailto:edipcurrentadmin@state.gov">contact us</a> for assistance.</div>';
                    }
                        
                    xml.find('Document').each(function(){

					  var Path = '';
                                var MRN = '';
                                var DTGDT = '';
                                var Subject = '';

                        $(this).find('Property').each(function(){

                                

                                switch($(this).find('Name').text())
                                {
                                    case "Path":

                                        Path = $(this).find('Value').text();
						    break;
                                    case "MRN":
                                        MRN = $(this).find('Value').text();
						    break;
                                    case "DTGDT":
                                        DTGDT = $(this).find('Value').text();
		  				    break;
                                    case "Subject":
                                        Subject = $(this).find('Value').text();
						    break;
						default :
						    break;

                                }
                        });
                        
                        html+='<li class="rssRow">';
                        html+='<div style="overflow:auto;">';
                        html+='<input type="hidden" class="feedLinkInput" value="'+ Path +'" ></input>';
                        
                        var numberDate = Date.parse(DTGDT);
                        var d = new Date(numberDate);
                        var curr_date = d.getDate();
                        var curr_month = d.getMonth();
                        curr_month++;
                        var curr_year = d.getFullYear();
                        var newDate = curr_month + "/" + curr_date + "/" + curr_year;


                        html+='<strong class="date">' + newDate + '</strong>';
                        html+='<strong class="date">' + MRN + '</strong>';
                        html+='<a target="_blank" href="' + Path + '"  title="View this feed at '+Path+'"><span>'+Subject+'</span>';
                        html+='</a>';

                        html+='<div class="shareContainer">';
                        
                        html+='<a class="share tooltip" title="Send by email" href="mailto:?Subject=Shared From the Current - '+Subject+'&body='+strip(Path)+'" ><div class="shareIcon mailShare"></div><span class="tttext classic">Send by email</span></a>';

                        html+='</div>';

                        html+="</div></li>";
                        
                        


                    });
                    html += "</ul>";
//////////////////////////////////



                    
                    content.innerHTML = html;
                
                    var feedLink = $('#widget-<?php echo $TC_SMARTSource_JSCORS_Default_widgetEntity_ID ;?> .feedLinkInput').val();
                    feedLink= 'http://search.smart.state.gov/Smart/';
                    $('#widget-<?php echo $TC_SMARTSource_JSCORS_Default_widgetEntity_ID ;?>').parent().find('h1').first().html('<a target="_blank" href="'+feedLink+'" ><?php echo addslashes($model->get_title()); ?></a><div class="sourceExpandIcon opened"></div>') ;





                },
                error: function(xhr, ajaxOptions, thrownError) {
                            //console.log('Error ' + xhr.statusText + xhr.responseText);                                        
                        }

            });   

}
else
{
var content = document.getElementById('widget-<?php echo $TC_SMARTSource_JSCORS_Default_widgetEntity_ID ;?>');
var html='<div class="feedMessage">This source type relies on cutting-edge technology and is only available in modern browsers. View The Current in Google Chrome for best results.</div>';

                    content.innerHTML = html;
}

});




</script>

<script id="soap-template-<?php echo $TC_SMARTSource_JSCORS_Default_widgetEntity_ID ;?>" type="application/soap-template">
 
<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <Query xmlns="urn:Microsoft.Search">
      <queryXml>&lt;?xml version="1.0" encoding="utf-8" ?&gt;
            &lt;QueryPacket xmlns="urn:Microsoft.Search.Query" Revision="1000"&gt;
            &lt;Query domain="QDomain"&gt;
             &lt;SupportedFormats&gt;&lt;Format&gt;urn:Microsoft.Search.Response.Document.Document&lt;/Format&gt;
            &lt;/SupportedFormats&gt;
             &lt;Context&gt;
               &lt;QueryText language="en-US" type="STRING"&gt; <?php echo $model->get_terms(); ?> &lt;/QueryText&gt;
             &lt;/Context&gt;
             &lt;Range&gt;&lt;StartAt&gt;1&lt;/StartAt&gt;&lt;Count&gt;<?php echo GLOBAL_FEED_ITEM_CAP; ?>&lt;/Count&gt;&lt;/Range&gt;
             &lt;Properties&gt;
                &lt;Property name="Path"&gt;&lt;/Property&gt;
&lt;Property name="DTGDT"&gt;&lt;/Property&gt;
&lt;Property name="DTG"&gt;&lt;/Property&gt;
&lt;Property name="Releaser"&gt;&lt;/Property&gt;
&lt;Property name="Filename"&gt;&lt;/Property&gt;
&lt;Property name="TAGS"&gt;&lt;/Property&gt;
&lt;Property name="MessageId"&gt;&lt;/Property&gt;
&lt;Property name="Precedence"&gt;&lt;/Property&gt;
&lt;Property name="MRN"&gt;&lt;/Property&gt;
&lt;Property name="Subject"&gt;&lt;/Property&gt;
&lt;Property name="Originator"&gt;&lt;/Property&gt;
&lt;Property name="Captions"&gt;&lt;/Property&gt;
&lt;Property name="Clearer"&gt;&lt;/Property&gt;
&lt;Property name="Classification"&gt;&lt;/Property&gt;
&lt;Property name="Title"&gt;&lt;/Property&gt;
&lt;Property name="Description"&gt;&lt;/Property&gt;
&lt;Property name="Write"&gt;&lt;/Property&gt;
&lt;Property name="Rank"&gt;&lt;/Property&gt;
            &lt;/Properties&gt;
            &lt;SortByProperties&gt;
                &lt;SortByProperty name="DTGDT" direction="Descending" order="1" /&gt;                
            &lt;/SortByProperties&gt;
             &lt;EnableStemming&gt;true&lt;/EnableStemming&gt;
             &lt;TrimDuplicates&gt;true&lt;/TrimDuplicates&gt;
             &lt;IgnoreAllNoiseQuery&gt;true&lt;/IgnoreAllNoiseQuery&gt;
             &lt;ImplicitAndBehavior&gt;true&lt;/ImplicitAndBehavior&gt;
             &lt;IncludeRelevanceResults&gt;true&lt;/IncludeRelevanceResults&gt;
             &lt;IncludeSpecialTermResults&gt;false&lt;/IncludeSpecialTermResults&gt;
             &lt;IncludeHighConfidenceResults&gt;false&lt;/IncludeHighConfidenceResults&gt;
            &lt;/Query&gt;&lt;/QueryPacket&gt;

	</queryXml>
    </Query>
  </soap:Body>
</soap:Envelope>
 
</script>



<div class="widget" >
    <h1><a target="_blank" href="http://search.smart.state.gov/Smart/"><?php echo $model->get_title() ;?></a></h1>
              <ul id="widget-<?php echo $TC_SMARTSource_JSCORS_Default_widgetEntity_ID ;?>">
            <img src="/public/images/loading2.gif" />
              </ul>
</div>