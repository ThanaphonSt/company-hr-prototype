$(document).ready(function(){
	$('.modal-trigger').leanModal();
		var id = $("#idResume").val();
	$('#export').on('click',function(){
		$.ajax({
	        url: '/resume/'+id+'/genPDF'
	    })
        var options = {
            height: "800px",
            pdfOpenParams: { view: 'FitV', page: '1' }
        };

        PDFObject.embed("/pdf/Resume_"+id+".pdf", "#pdf",options);
        console.log('bbb');
        $('#modal1').openModal();
	});

	$('#graphDetail').on('click',function(){
		var arrayJobType = [['JobType', 'อัตรา']];
		$.ajax({
		    url: '/resume/'+id+'/genChart', 
		    success: function(response) {
		    	if(response.chart.length > 0){
	    		$.each(response.chart, function(index, chart) {
		           	arrayJobType.push([''+chart.JobType, chart.counter]);
		        });

		        google.charts.load("current", {packages:["corechart"]});
			    google.charts.setOnLoadCallback(drawChart);
		        function drawChart() {
		            var data = google.visualization.arrayToDataTable(arrayJobType);
		            var view = new google.visualization.DataView(data);                     
		            var options = {
		                'title': 'จำนวนประเภทของตำแหน่งงานที่ Job seeker สมัครย้อนหลัง 15 วัน',
		                'width': '480',
		                'height': '400',
		            };

		            var chart = new google.visualization.BarChart(document.getElementById("chart"));
		                chart.draw(view, options);
		        };
		    }else 
		    {
		    	$('#chart').html('<h6 class="center" >-ไม่มีข้อมูล-</h6>');
            }
	    	}
	    });
	    
	});
});