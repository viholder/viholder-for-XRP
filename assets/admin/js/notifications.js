 
var host = window.location.origin+"/vh";

function convertToPlain(html){
    
    // Create a new div element
    var tempDivElement = document.createElement("div");

    // Set the HTML content with the given value
    tempDivElement.innerHTML = html;

   
    // Retrieve the text property of the element 
    return tempDivElement.textContent || tempDivElement.innerText || "";
}
 
function update_notifications(data){   
    $.ajax({
       url: host+"/notifications/check_for_new_msg",
       type: "POST",
       cache: false,
       "data": data,  
       success: function(data){
                const myObj = JSON.parse(data);
 
           if (myObj['notify']){  
                var max=myObj['notify'].length;
            }else{
                return false;
            }
                if (max<1){ 
                  
                    return false;
                }

                $('#msgbell').empty();
                $('.notifymsg').text(myObj['notify'].length); 

                if (max>6){
                    max=6
                    $('.notifymsg').text("6+"); 
                }

                for (var i = 0; i < max; i++) {

                    imageProfile= myObj['notify'][i]["msg_from"]+"."+ myObj['notify'][i]["img_type"];
                    
                    aCell0  = ' <div style="padding:5px;border-bottom: 1px solid #efefef;"> <a href="'+host+'/notifications/view/'+myObj['notify'][i]['id']+'"  style="color:#000000">'
                    aCell1  = ' <div class="media">'
                    aCell2  = '  <img src="'+host+'/uploads/users/'+imageProfile+'" alt="" width="50" height="50" class="img-circle" style="margin-right:10px;">'
                    aCell3  = '   <div class="media-body">'
                    aCell4  = '    <h3 class="dropdown-item-title">'
                    aCell5  =  myObj['notify'][i]["name"]+"s"
                    aCell6  = '      <span class="float-right text-sm text-danger"><i class="fas fa-circle"></i> </span>'
                    aCell7  = '    </h3>'
                    aCell8  = '    <p class="text-sm">'+convertToPlain(myObj['notify'][i]["msg_subject"])+'.</p>'
                    aCell9  = '    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>'+ myObj['notify'][i]["since"]+'</p>'
                    aCell10  = '  </div>'
                    aCell11  = ' </div>'
                    aCell12  = ' </a> </div>'

                    datatable= aCell0+aCell1+aCell2+aCell3+aCell4+aCell5+aCell6+aCell7+aCell8+aCell9+aCell10+aCell11+aCell12
                    $('#msgbell').prepend(datatable);
                
                }
    
                if (max>=1){
                    
                    aCell13 =' <div class="dropdown-divider"></div>'
                    aCell14 ='  <a href="'+host+'/notifications/list" class="dropdown-item dropdown-footer">'+myObj['notify'][0]["see-all-messages"]+'</a>'
                    $('#msgbell').append(aCell13+aCell14);
                }
          
          
       },
       error: function(XMLHttpRequest, textStatus, errorThrown) {
           
            
       }
   });

}

 
 