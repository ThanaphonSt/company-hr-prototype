$(document).ready(function(){
	var state =0;
	$('#search').on('click',function(){
		$.ajax({
			type: "POST",
			data: {"search" : name },
			url: "/companyhr",
			dataType: "json",
			success: function(response) {
				window.state = 0;
				$('#pagination-demo').empty().removeData("twbs-pagination");
				$('#pagination-demo').html('');
				var name = $('#name').val();
				$('#list').html('<div></div>');
				$('#total').html('');
				$('#total').append('<span>ผลการค้นหาทั้งหมด '+response.CompanyNames.total+' บริษัท</span>')
				if(!$.isEmptyObject(response.CompanyNames.data)){
					$.each(response.CompanyNames.data, function(index, company) {
				    	$('#list').append('<div class="row truncate layout-name-company"><a class="name-company" id="company'+company.RunningNumber+'"" href="/company/'+company.RunningNumber+'">'+company.CompanyName+'</a></div>'				    		
				    		+'<span class="truncate">'+company.Detail.replace(/<\/?[^>]+>/gi,'')+'</span>'	
				    		+'<span class="">ที่อยู่:'+company.Address+'</span>'
				    		+'<pre class="layout-detail text-detail">เบอร์โทร:'+company.Tel+'   Fax:'+company.Fax+'</pre>'
				    		+'<pre class="layout-detail text-detail">email: '+company.Email+'</pre>'
				    		+'<hr>'				    						    		
				    		)	
				    	var name = $('#name').val();	
				    });
					if(response.CompanyNames.last_page > 1){
			            $('#pagination-demo').twbsPagination({
			                totalPages: response.CompanyNames.last_page,
			                visiblePages: 7,
			                onPageClick: function (event, page) {			                	
			                    if(window.state >0){
			                        $('#list').html('<div></div>');
			                        var name = $('#name').val();
									$.ajax({
										type: "POST",
										data: {"search" : name },
										url: "/companyhr?page="+page,
										dataType: "json",
										success: function(response) {
											$('#list').html('<div></div>');
											$.each(response.CompanyNames.data, function(index, company) {
										    	$('#list').append('<div class="row truncate layout-name-company"><a class="name-company" id="company'+company.RunningNumber+'"" href="/company/'+company.RunningNumber+'">'+company.CompanyName+'</a></div>'				    		
										    		+'<span class="truncate">'+company.Detail.replace(/<\/?[^>]+>/gi,'')+'</span>'	
										    		+'<span class="">ที่อยู่:'+company.Address+'</span>'
										    		+'<pre class="layout-detail text-detail">เบอร์โทร:'+company.Tel+'   Fax:'+company.Fax+'</pre>'
										    		+'<pre class="layout-detail text-detail">email: '+company.Email+'</pre>'
										    		+'<hr>'				    		
										    		
										    		)
										    	 var name = $('#name').val();	
										    });
										}
									})
			                    }
			                   window.state = 1;
			                 }
			            });
					}
				}else {$('#list').html('<div class = "center">-ไม่พบข้อมูล-</div>')}
			}
		})
	});
	$('#form').submit(function(event){
       event.preventDefault()
       var name2 = $('#name').val();
		$.ajax({
			type: "POST",
			data: {"search" : name2 },
			url: "/companyhr",
			dataType: "json",
			success: function(response) {
				$('#pagination-demo').empty().removeData("twbs-pagination");
				$('#pagination-demo').html('');
				$('#list').html('<div></div>');
				$('#total').html('');
				$('#total').append('<span>ผลการค้นหาทั้งหมด '+response.CompanyNames.total+' บริษัท</span>')
				if(!$.isEmptyObject(response.CompanyNames.data)){
						$.each(response.CompanyNames.data, function(index, company) {
					    	$('#list').append('<div class="row truncate layout-name-company"><a class="name-company" id="company'+company.RunningNumber+'"" href="/company/'+company.RunningNumber+'">'+company.CompanyName+'</a></div>'				    		
				    		+'<span class="truncate">'+company.Detail.replace(/<\/?[^>]+>/gi,'')+'</span>'	
				    		+'<span class="">ที่อยู่:'+company.Address+'</span>'
				    		+'<pre class="layout-detail text-detail">เบอร์โทร:'+company.Tel+'   Fax:'+company.Fax+'</pre>'
				    		+'<pre class="layout-detail text-detail">email: '+company.Email+'</pre>'
				    		+'<hr>'				    		
				    		
				    		)
				    	 var name = $('#name2').val();	
					    });
					    var state = 0;			    
						if(response.CompanyNames.last_page > 1){
				            $('#pagination-demo').twbsPagination({
				                totalPages: response.CompanyNames.last_page,
				                visiblePages: 7,
				                onPageClick: function (event, page) {
				                    if(state >0){
				                    	 var name2 = $('#name').val();
				                        $('#list').html('<div></div>');
										$.ajax({
											type: "POST",
											data: {"search" : name2 },
											url: "/companyhr?page="+page,
											dataType: "json",
											success: function(response) {
												$('#list').html('<div></div>');
												$.each(response.CompanyNames.data, function(index, company) {
											    	$('#list').append('<div class="row truncate layout-name-company"><a class="name-company" id="company'+company.RunningNumber+'"" href="/company/'+company.RunningNumber+'">'+company.CompanyName+'</a></div>'				    		
												    		+'<span class="truncate">'+company.Detail.replace(/<\/?[^>]+>/gi,'')+'</span>'	
												    		+'<span class="">ที่อยู่:'+company.Address+'</span>'
												    		+'<pre class="layout-detail text-detail">เบอร์โทร:'+company.Tel+'   Fax:'+company.Fax+'</pre>'
												    		+'<pre class="layout-detail text-detail">email: '+company.Email+'</pre>'
												    		+'<hr>'				    		
												    		
												    		)
												    	 var name = $('#name2').val();	
											    });
											}
										})
				                    }
				                    state = 1;
				                 }
				            });
						}
				}else {$('#list').html('<div class = "center">-ไม่พบข้อมูล-</div>')}
			}
		})
	})

	$('#close').on('click',function(){
		document.getElementById('name').value ="";
	})

});

