<script type="text/javascript">

$(document).ready(function(){

	$.fn.campaign = function(options) {
		
	    var defaults = {
	        duration: 10000,
	        frameRate: 8,
	        transition: 300,
	        images: 16,
	        delay: 150,
	        halfDistance: 20,
	        getNextBanner: 1000,
	        minFlashVersion: "9.0.0"
	    };
	    options = $.extend(defaults, options);        
	    return this.each(function() {
	        var campaign = $(this);            
	        var banners = $(this).children(".banner");
	        var currentBanner = 0;
	        var nextBanner = -1;
	        var wrapper;
	        var timeoutID = 0;
	        var timers;
	        var durations = new Array();
	        var stopBanner = function(banner) {
	            
	        };            
	        var playBanner = function(banner) {	           
	            timer(0, -1)
	        };
	        var drawTimer = function(index, ratio) {
	            if (ratio < 1) {
                    var ctx = timers.children("canvas:eq(" + index + ")")[0].getContext("2d");
                    ctx.clearRect(0, 0, 20, 20);
                    ctx.beginPath();
                    ctx.arc(10, 10, 9, -Math.PI / 2, -Math.PI / 2 + 2 * Math.PI * ratio, false);
                    ctx.lineTo(10, 10);
                    ctx.fillStyle = "#ff0000";
                    ctx.fill();
                    ctx.closePath()
	            }
	        };
	        var timer = function(count, index) {
	            var ratio = count / options.frameRate / (durations[currentBanner] / 1000);
	            drawTimer(currentBanner, ratio);
	            if (ratio >= 1 || index >= 0) {
	                (function(index) {
	                    setTimeout(function() {
	                        drawTimer(index, 0)
	                    }, options.delay)
	                })(currentBanner);
	                currentBanner = index >= 0 ? index : (currentBanner + 1) % banners.length;
	                if (currentBanner == 0 && index == -1) {
	                    banners.first().css("left", banners.last().position().left + banners.last().width())
	                }
	                wrapper.animate({
	                    left: -banners.eq(currentBanner).position().left
	                }, {
	                    duration: options.transition,
	                    complete: function() {
	                        if (currentBanner == 0) {
	                            banners.first().css("left", 0);
	                            wrapper.css("left", 0)
	                        }
	                        playBanner(banners.eq(currentBanner))
	                    }
	                })
	            } else {
	                count += 1;
	                timeoutID = setTimeout(function() {
	                    timer(count, -1)
	                }, 1000 / options.frameRate);
	                if (count / options.frameRate * 1000 == options.getNextBanner) {
	                    var nextIndex = (currentBanner + 1) % banners.length;
	                    var nextBanner = banners.eq(nextIndex);	                    
	                    loadImage(nextBanner)
	                }
	            }
	        };
	        var loadImage = function(nextBanner) {
	            if (!nextBanner.find("img").length && !nextBanner.find("a.requested").length) {
	                if (nextBanner.closest(".wide-content").length) {
	                    var width = 940;
	                    var height = 230
	                }
	            }
	        };
	        var timerClick = function(e) {
	            var index = $(this).index();
	            if (index != currentBanner) {	                
	                loadImage(banners.eq(index))
	                clearTimeout(timeoutID);
	                timer(durations[currentBanner] / 1000 * options.frameRate, index)
	            }
	        };
	        if (banners.length > 1) {
	            banners = $(this).children(".banner");
	            var w = 0;
	            var maxh = 0;
	            banners.each(function(i) {
	                $(this).css("left", w);
	                var _w = $(this).width();
	                w += _w;
	                maxh = Math.max(maxh, $(this).height());
	                durations[i] = options.duration;
	            });
	            wrapper = $('<div class="bannerWrapper"></div>');
	            banners.first().addClass("active").before(wrapper);
	            wrapper.append(banners).css({
	                width: w + banners.first().width(),
	                height: maxh
	            });
	            banners.removeClass("hidden");
	            timers = $('<div class="timers"></div>');
	            campaign.append(timers);
	            for (var i = 0; i < banners.length; i++) {
                    var canvas = $('<canvas width="20" height="20"></canvas>');
                    timers.append(canvas);
                    canvas.click(timerClick);
	                drawTimer(i, 0)
	            }
	            playBanner(banners.eq(currentBanner))
	        }
	    });
	};

      $('a[href="#"]').click(function(event){

       event.preventDefault();

    });
	
	
	/**
	*
	*  Click sulle famiglie 
	*
	*/
	
	 var famigliaSelected='';
	 var voltaggio ='';
     $("#products-pillar").click(function(){
     
        famigliaSelected = 'ProductsPillar';
     	
     	 $("#content_search_id").fadeOut();
     	
     	if($("#linear_actuators_acdcnm").is(":visible")){
     	   $("#linear_actuators_acdcnm").fadeOut({
     	       duration:500
     	   });
     	
     	}
     	
     	if($("#control_unit_acdc").is(":visible")){
     	   $("#control_unit_acdc").fadeOut({
     	       duration:500
     	   });
     	
     	}
     	
		$(".result").removeClass('fullwidth');
     	
     	$("#telescopic_pillar_acdcnm").fadeIn({
     	  duration:1000
     	});
     	
     });
     
     $("#products-control").click(function(){
     
     
        famigliaSelected = 'ProductsControl';
        
        $("#content_search_id").fadeOut();
        
     	if($("#telescopic_pillar_acdcnm").is(":visible")){
     	   $("#telescopic_pillar_acdcnm").fadeOut({
     	       duration:500
     	   });
     	
     	}
     	
     	if($("#linear_actuators_acdcnm").is(":visible")){
     	   $("#linear_actuators_acdcnm").fadeOut({
     	       duration:500
     	   });
     	
     	}
     	
     	$(".result").addClass('fullwidth');
		
     	$("#control_unit_acdc").fadeIn({
     	  duration:1000
     	});
     	
     });
     
     $("#products-linear").click(function(){
        
        famigliaSelected = 'ProductsLinear';
        	
        $("#content_search_id").fadeOut()
        
     	if($("#telescopic_pillar_acdcnm").is(":visible")){
     	   $("#telescopic_pillar_acdcnm").fadeOut({
     	       duration:500
     	   });
     	
     	}
     	
     	if($("#control_unit_acdc").is(":visible")){
     	   $("#control_unit_acdc").fadeOut({
     	       duration:500
     	   });
     	
     	}
     	
     	$(".result").removeClass('fullwidth');
		
     	$("#linear_actuators_acdcnm").fadeIn({
     	  duration:1000
     	});
     	
     });
     
     
      $("#products-accessory").click(function(){
        
        famigliaSelected = 'ProductsAccessory';
        	
        $("#content_search_id").fadeOut()
        
     	if($("#telescopic_pillar_acdcnm").is(":visible")){
     	   $("#telescopic_pillar_acdcnm").fadeOut({
     	       duration:500
     	   });
     	
     	}
     	
     	if($("#control_unit_acdc").is(":visible")){
     	   $("#control_unit_acdc").fadeOut({
     	       duration:500
     	   });
     	
     	}
     	
	     if($("#linear_actuators_acdcnm").is(":visible")){
		     	$("#linear_actuators_acdcnm").fadeOut({
		     	  duration:500
		     	});
	     	}
	  
	      $("#value_search").html('');
          $("#motor_shape_id").html('');
          $("#fieldset_search").fadeOut();
          $("#content_search_id").fadeIn();
		  $(".result").addClass('fullwidth');
          resultSearch(1,famigliaSelected,'');
	  
	  
	  });
	  
	  
	  $("#products-rotary").click(function(){
        
        famigliaSelected = 'ProductsRotary';
        $(".result").removeClass('fullwidth');
        $("#content_search_id").fadeOut()
        
     	if($("#telescopic_pillar_acdcnm").is(":visible")){
     	   $("#telescopic_pillar_acdcnm").fadeOut({
     	       duration:500
     	   });
     	
     	}
     	
     	if($("#control_unit_acdc").is(":visible")){
     	   $("#control_unit_acdc").fadeOut({
     	       duration:500
     	   });
     	
     	}
     	
	     if($("#linear_actuators_acdcnm").is(":visible")){
		     	$("#linear_actuators_acdcnm").fadeOut({
		     	  duration:500
		     	});
	     	}
	  
	      $("#value_search").html('');
          $("#motor_shape_id").html('');
          $("#fieldset_search").fadeOut();
          $("#content_search_id").fadeIn();
		  $(".result").addClass('fullwidth');
          resultSearch(1,famigliaSelected,'');
	  
	  
	  });

     $("#products-search").click(function(){
       	famigliaSelected = 'All';
        voltaggio = '';
        $("#motor_shape_id").html('');
        
       if($("#telescopic_pillar_acdcnm").is(":visible")){
     	   $("#telescopic_pillar_acdcnm").fadeOut({
     	       duration:500
     	   });
     	
     	}
     	
     	if($("#control_unit_acdc").is(":visible")){
     	   $("#control_unit_acdc").fadeOut({
     	       duration:500
     	   });
     	
     	}
     	
	     if($("#linear_actuators_acdcnm").is(":visible")){
		     	$("#linear_actuators_acdcnm").fadeOut({
		     	  duration:500
		     	});
	     	}
	     	
	     	$(".result").removeClass('fullwidth');
	     	$("#table_result").removeClass('bordered').html('');
	     	$("#free_search_text").fadeIn();
	     	$("#free_search_text").html("Insert Code or Designation");
	     	$("#content_search_id").fadeOut();
	     	$("#table_result").html('');
	        $("#motor_shape_combo").fadeOut();
            $("#motor_shape_txt").fadeOut();
            $("#medical_id").fadeOut();
            $("#paging_id").html("");	
     		$("#medical_combo_id").fadeOut();
            $("#fieldset_search").fadeIn();
            $("#content_search_id").fadeIn({duration:1000});
     		$("#fieldset_search").fadeIn();
     		$("#free_search").fadeIn();
     		
        
     
     });
     
     /********************************************************************************************/
     
     /**
     *
     * Click sul tipo di voltaggio
     *
     */
     $("#ac_dc_nom").bind('click',function(event) {
        $("#table_result").removeClass('bordered').html('');
        $("#free_search_text").fadeOut();
        $("#paging_id").html("");		
        $("#free_search").fadeOut();
        var currentID = $(event.target).attr('id');
        var arrayVoltaggio = []
        arrayVoltaggio=currentID.split('_');
        voltaggio= arrayVoltaggio[1];
        
        switch(currentID){
        
          case 'telescopic_ac_id':
          case 'telescopic_dc_id':
          case 'telescopic_nm_id':
          {
          
             /**
             * Filtro solo sul medical
             * 
             */
            $("#motor_shape_combo").fadeOut();
            $("#motor_shape_txt").fadeOut();
            $("#fieldset_search").fadeIn();
            $("#medical_combo_id").fadeIn();
            $("#content_search_id").fadeIn({duration:1000});
            $("#medical_id").fadeIn();
            $("#value_search").fadeIn();
            $("#medical_id").html("Medical");
            $("#value_search").html("<option value='1'>Yes</option><option value='0' selected='selected'>No</option>"); 
            $(".table_result tr:odd").addClass('td_odd');
            $(".table_result tr:even").addClass('td_even');
            
          
          }
          break;
         
         case 'linear_ac_id':
         case 'linear_dc_id':
         case 'linear_nm_id':
         {
         
             /**
             * Filtro sul medical e sul motor shape
             * 
             */
           $("#content_search_id").fadeIn({duration:1000});
            $("#fieldset_search").fadeIn();
            $("#medical_id").fadeIn();
            $("#value_search").fadeIn();
            $("#medical_combo_id").fadeIn();
            $("#medical_id").html("Medical");
            $("#value_search").html("<option value='1'>Yes</option><option value='0' selected='selected'>No</option>"); 
            $("#motor_shape_txt").html("Motor Shape");
            $("#motor_shape_id").html("<option value='I'>I</option><option value='L'>L</option><option value='U'>U</option>"); 
            $("#motor_shape_txt").fadeIn();
            $("#motor_shape_combo").fadeIn();
         
         
         
         }
         break;  
        
        case 'control_ac_id':
        case 'control_dc_id':
        {
        
           /**
             * Nessun Filtro visibile
             * 
             */
          $("#value_search").html('');
          $("#motor_shape_id").html('');
          $("#fieldset_search").fadeOut();
          $("#content_search_id").fadeIn();
          resultSearch(1,famigliaSelected,voltaggio);
        
        
        }
        break;
        
        }
        
    });
    
    
    
      $("#search_btn").click(function(){
           $("#paging_id").html("");
           resultSearch(1,famigliaSelected,voltaggio);
     });


  });        

 function resultSearch(page,famigliaSelected,voltaggio){
        if (famigliaSelected == 'All' && $("#input_searchfree").val().length<3){
          alert("Insert at least 3 characters");
          return false;
        }
			$('#spinner').show();
    	    $("#table_result").fadeIn();
               
               $.ajax({
				type: "POST",
				url: '/actselector/index.php/productssearch/ajaxCall',
				data: {
				   modelName:famigliaSelected,
				   voltaggio:voltaggio,
				   medical:$("#value_search").val(),
				   motor_shape:$("#motor_shape_id").val(),
				   freeSearch:$("#input_searchfree").val(),
				   page:page
				},
				success: function(o){
				  $('#spinner').hide();
				  buildResult(o,page,famigliaSelected,voltaggio);
				},
				dataType: 'json'
				});
               
    
    
 }
 
   
     function buildResult(o,page,famigliaSelected,voltaggio){
		$("#table_result").html('');
		if (o.count==0){
		  $("#table_result").html('<table class="table_result"><th width="400">No Record Found</th></table>');
		  $(".table_result").fadeIn();
		  return false;
		}
		var htmlTable = '<table class="table_result"><th class="design">Designation</th><th class="desc">Description</th>';
		for (var i=0;i<o.data.length;i++){
		   htmlTable =  htmlTable+'<tr><td class="design"><a href="#" onclick=openDetails("'+ o.data[i].code_id+'","'+o.data[i].modelName+'","'+o.data[i].path_image+'")>'+o.data[i].code_id+'</a></td><td class="desc">&nbsp;</td></tr>';
		}
		
		/**
		*  Costruzione dinamica della paginazione
		* 
		*/
		if (page==1){
	      npages = getNumberPages(o.count);
	      var paginatedtable = '';
	      if (npages>0){
	        paginatedtable += '<table id="paging_table"><tr>';
	        for (var j=0;j<npages;j++){
	        	paginatedtable+="<td><a id='paging_"+(j+1)+"' class='paging' href='#' onClick='return false;'>"+(j+1)+"</a></td>";
	        }
	        paginatedtable+= '</tr></table>';
	        $("#paging_id").html(paginatedtable);
	        $("#paging_1").addClass("a_visited");
	        
	        $("#paging_table").bind('click',function(event){
	        	var id =  $(event.target).attr('id');
	        	var page = id.split("_");
	        	$("a").removeClass("a_visited");
	        	$("#"+id).addClass("a_visited");
	        	resultSearch(page[1],famigliaSelected,voltaggio);
	        	
	       
	        });
	      }
	      
	    }
	    
	    
		htmlTable += '</table>';
		$("#table_result").addClass('bordered').html(htmlTable);
		$(".table_result").fadeIn();
		$(".table_result tr:odd").addClass('td_odd');
		$(".table_result tr:even").addClass('td_even');
    
    }
 
  function openDetails(codId,modelName,folderImage){
    
        $.ajax({
				type: "POST",
				url: '/actselector/index.php/productssearch/productDetails',
				data: {
				   modelName:modelName,
				   codId: codId,
				   folderImage:folderImage
				},
				success: function(o){
				 var result =  buildDetails(o);
				   $("#dialog").html(result); 
		           $("#dialog").dialog({
		            height: 600,
		            width: 800,
		            modal:true,
		            closeText:"",
		            title: "Details" 
		        });      
				 $("#table_result_details").addClass('bordered').html(result);
					$(".table_result_details").fadeIn();
					$(".table_result_details tr:odd").addClass('td_odd');
					$(".table_result_details tr:even").addClass('td_even');
				},
				dataType: 'json'
	      });
    
       
    
    
   
  }
 
  function buildDetails(result){
     var htmlTable;
     var obj;
     htmlTable = '<img width="250" height="250" src="/actselector/app/webroot/img/skf_products_image/'+result.data[0].path_image+'/'+result.data[0].image+'">';
     htmlTable = htmlTable+'<table class="table_result_details">';
     for (obj in result.data[0]){
     var field = obj;
	     var find = '_';
		 var re = new RegExp(find, 'g');
	 
	 obj = obj.replace(re, ' ');
		   htmlTable =  htmlTable+'<tr><td class="design">'+obj.toUpperCase()+'</td><td class="desc_details">'+result.data[0][field]+'</td></tr>';
      }
     htmlTable = htmlTable + "</table>";
     return htmlTable;
  }
  
 
 
 
  function getNumberPages(tot){
    var numberPages;
      if (tot>0){
        if (tot%10 > 0){
      	  numberPages =  Math.floor(tot/10) +1 ;
        }else{
          numberPages =  Math.floor(tot/10);
        }
      }
      else{
      	  numberPages = 0;
      }
      
     return numberPages;
    
    }   
</script>