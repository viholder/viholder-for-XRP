

 
$(function () {

    

})

var  no_internet_msg=0;

function update_portfolio(data,url){   

    
    $.ajax({
      // url: "./portfolio/list_positions",
       url:  url+"/list_positions",
       type: "POST",
       cache: false,
       "data": data,  
       success: function(data){
           const myObj = JSON.parse(data);
           if (myObj["user_positions"]["val"]!=null){  
             
                    var totalpositions= (myObj["user_positions"]["val"].length)
              // CHECK FOR NEW POSITIONS
              var rowCount = $('#portafolio_list tr').length-1
              i=rowCount;
             
              
             if (totalpositions>rowCount){  
  
   
               ides=myObj["user_positions"]["val"][i]['id'];
  
                          // Create a new table row
            
              idCell  = '<td width="5"><div id="id-' + ides+'">   </div></td></td>';
              tickerCell  = '<td> <div id="ticker-' + ides+'">  </div></td>';
              amountCell  = '<td style="text-align:right"><b> <div id="amount-' + ides+'">  </div> </b></td>';
              unitsCell   = '<td style="text-align:right"><div id="units-' + ides+'">  </div> </td>';
              price_openCell  = '<td><div id="price_open-' + ides+'">  </div></td>';
              priceCell  = '<td style="text-align:right"><div id="price-' + ides+'">  </div> ';
              stop_lossCell  = '<td><div id="stop_loss-' + ides+'">  </div></td>';
              take_profitCell  = '<td><div id="take_profit-' + ides+'">  </div></td>';
              leverageCell  = '<td style="text-align:center"><div id="leverage-' + ides+'"> </div></td>';
              glpCell  = '<td style="text-align:right"><div id="glp-' + ides+'">   </div> </td>';
              glCell  = '<td style="text-align:right"><div id="gl-' + ides+'">   </div></td>';
              buttonCell  = '<td><button  id="button-' + ides+'" class="btn btn-block btn-warning btn_manage_poistion" data-status="" data-contract="" data-id="'+ ides +'" > MANAGE </button></td>';


              datatable="<tr>"+idCell+tickerCell+amountCell+unitsCell+price_openCell+priceCell+stop_lossCell+take_profitCell+leverageCell+glpCell+glCell+buttonCell+"</tr>";
  
              $('#portafolio_list').append(datatable);
              
          } // END - ADD NEW ROW



             /// UPDATE TABLE 
                    for (var i = 0; i < totalpositions; i++) {
                        ides=myObj["user_positions"]["val"][i]['id'];
                    
                        //  $('#price-'+ides).html(myObj["user_positions"]["val"][i]['price'] )
                
                        document.getElementById('id-' + ides).innerHTML = myObj["user_positions"]["val"][i]['id'];
                        document.getElementById('ticker-' + ides).innerHTML = myObj["user_positions"]["val"][i]['ticker'];
                        document.getElementById('amount-' + ides).innerHTML = myObj["user_positions"]["val"][i]['amount'];
                        document.getElementById('units-' + ides).innerHTML = myObj["user_positions"]["val"][i]['units'];
                        document.getElementById('price_open-' + ides).innerHTML = myObj["user_positions"]["val"][i]['price_open'];
                        document.getElementById('price-' + ides).innerHTML = myObj["user_positions"]["val"][i]['price'];
                        document.getElementById('stop_loss-' + ides).innerHTML = myObj["user_positions"]["val"][i]['stop_loss'];
                        document.getElementById('take_profit-' + ides).innerHTML = myObj["user_positions"]["val"][i]['take_profit'];
                        document.getElementById('leverage-' + ides).innerHTML = myObj["user_positions"]["val"][i]['leverage'];
                        document.getElementById('glp-' + ides).innerHTML = myObj["user_positions"]["val"][i]['glp'];
                        document.getElementById('gl-' + ides).innerHTML = myObj["user_positions"]["val"][i]['gl'] ;

                        if (myObj["user_positions"]["val"][i]['active'] == "6") {
                            document.getElementById('button-' + ides).innerHTML = myObj["user_positions"]["val"][i]['button_text'];
                            document.getElementById('button-' + ides).classList.remove("btn-secondary");
                            document.getElementById('button-' + ides).classList.add("btn-warning");
                        } else {
                            document.getElementById('button-' + ides).innerHTML =  myObj["user_positions"]["val"][i]['button_text'];
                            document.getElementById('button-' + ides).classList.remove("btn-warning");
                            document.getElementById('button-' + ides).classList.add("btn-secondary");
                        }

                            /*	 
                        console.log( myObj["user_positions"]["val"][i]['price'])
                        console.log( myObj["user_positions"]["val"][i]['id'])
                        console.log( myObj["user_positions"]["val"][i]['ticker'])
                        console.log( myObj["user_positions"]["val"][i]['userID'])
                        console.log( myObj["user_positions"]["val"][i]['tickerID'])
                        console.log( myObj["user_positions"]["val"][i]['units'])
                        console.log( myObj["user_positions"]["val"][i]['amount'])
                        console.log( myObj["user_positions"]["val"][i]['type'])
                        console.log( myObj["user_positions"]["val"][i]['active'])
                        console.log( myObj["user_positions"]["val"][i]['price_open'])
                        console.log( myObj["user_positions"]["val"][i]['datetime_open'])
                        console.log( myObj["user_positions"]["val"][i]['stop_loss'])
                        console.log( myObj["user_positions"]["val"][i]['take_profit'])
                        console.log( myObj["user_positions"]["val"][i]['leverage'])
                        console.log( myObj["user_positions"]["val"][i]['glp'])
                        console.log( myObj["user_positions"]["val"][i]['gl'])
                        */
                    }
               // END UPDATE TABLE 
               
                    
            } // EN IF DATA   
        
            
       } 
   });
 }

 function portfolio_dashboard(data,url){  
    
     $.ajax({
        url: url+"/portfolio_dashboard",
        type: "POST",
        cache: false,
        "data": data,  
        success: function(data){
				 const myObj = JSON.parse(data);

                $('#balance_label').html(myObj["wallet_balance"]);

                $('#gain_Loss').html(myObj["gain_loss"]); 
                $('#gain_Loss').css("color",myObj["gain_loss_color"] )
                
              
                $('#gainloss_currency_sign').css("color",myObj["gain_loss_color"] )
                $('#portfolio_value_dashboard').css("background-color",myObj["gain_loss_color"] )

                $('#gainloss_icon').css("color",myObj["gain_loss_color"] )
                $('#gainloss_icon').addClass(myObj["class"])

                $('#portafolio_value').html(myObj["portafolio_value"]); 

                $('#total_invested').html(myObj["total_invested"]); 

               
           
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            if (no_internet_msg=0){  
              alert("No internet connection!!")
              no_internet_msg=1;
            }
             
        }
    });
  }


  function top_dashboard(data,url){  
    
    $.ajax({
       url: url+"/portfolio_dashboard",
       type: "POST",
       cache: false,
       "data": data,  
       success: function(data){
                const myObj = JSON.parse(data);

                $('.valuedashboard').html(myObj["portafolio_value"]); 
               // $('.valuedashboard').css("color",myObj["gain_loss_color"] )
              //  $('.valuedashboard').css("border-color",myObj["gain_loss_color"] )
              //   $('.valuedashboard').css("hover",myObj["gain_loss_color"] )

                  $('.valuedashboard').css("color", "#fff" )
                  $('.valuedashboard').css("background-color",myObj["gain_loss_color"] )
                  $('.valuedashboard').css("font-weight" ,"800");
                  $('.valuedashboard').css("border-color",myObj["gain_loss_color"] )
                 // $('.valuedashboard').addClass(myObj["class"])

                $('.valuedashboard').hover(function(){
                    $(this).css("background-color", myObj["gain_loss_color"] );
                    
                    $(this).css("color",  "#fff" );
                    }, function(){
                   // $(this).css("background-color", "#fff");
                  //  $('.valuedashboard').css("color",myObj["gain_loss_color"] )

                 });;

             },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                if (no_internet_msg=0){  
                  alert("No internet connection!!")
                  no_internet_msg=1;
                }
                 
            }
        });
      }
  

  