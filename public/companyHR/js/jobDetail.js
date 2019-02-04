$( document ).ready(function() {
    var id = $("#jobId").val();

    var arrayData = [['อายุ', 'ชาย', 'หญิง']];
    $.ajax({
        url: '/job/'+id+'/genChart', 
        success: function(response) {
            $('#dual_y_div').removeClass('valign-wrapper');
            if(response.data.length > 0) {
                var chart = new CanvasJS.Chart("dual_y_div",
                {
                    animationEnabled: true, 
                    animationDuration: 2000,
                    title: {
                        text: "กราฟเปรียบเทียบเพศของผู้สมัครตามช่วงอายุ",
                        fontSize: 14,                 
                    },
                    animationEnabled: true,
                    legend: {
                        fontSize: 12,
                        cursor:"pointer",
                        itemclick : function(e) {
                            if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                                e.dataSeries.visible = false;
                            }else {
                                e.dataSeries.visible = true;
                            }
                            chart.render();
                        },
                    },
                    axisY: {
                        title: "จำนวน(คน)",
                        titleFontSize: 12,
                        labelFontSize: 10
                    },
                    axisX: {
                        title: "ช่วงอายุ(ปี)",
                        labelFontSize: 10,
                        titleFontSize: 12,
                        fontSize: 10
                    },
                    toolTip: {
                        shared: true,  
                        content: function(e){
                            var str = '';
                            var total = 0 ;
                            var str3;
                            var str2 ;
                            for (var i = 0; i < e.entries.length; i++){
                                var  str1 = "<span style= 'color:"+e.entries[i].dataSeries.color + "'> " + e.entries[i].dataSeries.name + " </span>: <strong>"+  e.entries[i].dataPoint.y + " คน</strong> <br/>" ; 
                                total = e.entries[i].dataPoint.y + total;
                                str = str.concat(str1);
                            }
                            str2 = "<span style = 'color:DodgerBlue; '><strong> ช่วงอายุ "+e.entries[0].dataPoint.label + " ปี</strong></span><br/>";
                            str3 = "<span style = 'color:Tomato '>Total: </span><strong>" + total + " คน</strong><br/>";

                            return (str2.concat(str)).concat(str3);
                        }
                    },
                    data:response.data
                });
                chart.render();
            }else {
                $('#dual_y_div').html('<h6 class="center" >-ไม่มีข้อมูลจำนวนผู้สมัครงาน-</h6>');
            }
        }
    });

    var arrayData2 = [['ประเภทงาน', 'จำนวน']];
    $.ajax({
        url: '/job/'+id+'/amountChart', 
        success: function(response) {
            if(!$.isEmptyObject(response.total)) {
                $.each(response.total, function(index, result) {
                    arrayData2.push([index,result])
                });
                google.charts.load("current", {packages:["corechart"]});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var data = google.visualization.arrayToDataTable(arrayData2);
                    var options = {
                        height:450,
                        title: 'กราฟเปรียบเทียบประเภทงานตามความสนใจของผู้สมัคร',
                        is3D: true,
                        titleTextStyle:
                        {   
                            fontSize: 16, 
                            bold: false,
                            italic: false,
                        },
                    };
                    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                    chart.draw(data, options);
                }
            }else {
                $('#piechart_3d').html('<h6 class="center" >-ไม่มีข้อมูลจำนวนคนสมัครในแต่ละประเภท-</h6>');
            }
        }
    });

    $.ajax({
        url: '/job/'+id+'/JobtypeChart', 
        success: function(response) {
            $('#chart').removeClass('valign-wrapper');
            var chart = new CanvasJS.Chart("chart",
            {
                animationEnabled: true, 
                animationDuration: 1000,
                title:{
                    text: "กราฟเปรียบเทียบเงินเดือนสูงสุด - ต่ำสุดของงานกับประเภทงาน",
                },
                axisY: {
                    includeZero:false,
                    title: "เงินเดือน",  
                },
                axisX: {
                    interval: 10,
                },  
                data: response.data
            });
            chart.render();
        }
    });
    // $.ajax({
    //     url: '/job/'+id+'/normalDistribution',
    //     success: function(response2) {
    //         $('#normalDistribution').removeClass('valign-wrapper');
    //         function NormalDensityZx( x, Mean, StdDev ) {
    //             var a = x - Mean;
    //             return Math.exp( -( a * a ) / ( 2 * StdDev * StdDev ) ) / ( Math.sqrt( 2 * Math.PI ) * StdDev );
    //         }

    //         function StandardNormalQx( x ) {
    //             if ( x === 0 ) // no approximation necessary for 0
    //             return 0.50;

    //             var t1, t2, t3, t4, t5, qx;
    //             var negative = false;
    //             if ( x < 0 ) {
    //                 x = -x;
    //                 negative = true;
    //             }
    //             t1 = 1 / ( 1 + ( 0.2316419 * x ) );
    //             t2 = t1 * t1;
    //             t3 = t2 * t1;
    //             t4 = t3 * t1;
    //             t5 = t4 * t1;
    //             qx = NormalDensityZx( x, response2.salaryMean, response2.salarySD ) * ( ( 0.319381530 * t1 ) + ( -0.356563782 * t2 ) +
    //                 ( 1.781477937 * t3 ) + ( -1.821255978 * t4 ) + ( 1.330274429 * t5 ) );
    //             if ( negative == true )
    //                 qx = 1 - qx;
    //             return qx;
    //         }

    //         function StandardNormalPx( x ) {
    //             return 1 - StandardNormalQx( x );
    //         }

    //         function StandardNormalAx( x ) {
    //             return 1 - ( 2 * StandardNormalQx( Math.abs( x ) ) );
    //         }

    //         var verticals = response2.salaryApplyer;
    //         var amount = response2.numberOfApplyer;
    //         var chartData = [];
    //         for ( var i = 0; i < verticals[response2.lastIndex]; i += 100 ) {
    //             var dp = {
    //                 category: i,
    //                 value: NormalDensityZx( i, response2.salaryMean, response2.salarySD ),
    //                 people: 0
    //             };
    //             if ( verticals.indexOf( Math.round( i * 10 ) / 10 ) !== -1 ) {
    //                 dp.vertical = dp.value;
    //             }
    //             if ( amount[i] != undefined ) {
    //                 dp.people = amount[i];
    //             }
    //             chartData.push( dp );
    //         }

    //         var chart = AmCharts.makeChart( "normalDistribution", {
    //             "type": "serial",
    //             "theme": "light",
    //             "dataProvider": chartData,
    //             "precision": 2,
    //             "titles": [ {
    //                 "text": "กราฟกระจายแบบปกติของเงินเดือนที่ผู้สมัครสนใจ",            
    //                 "size": 15
    //             }],
    //             "valueAxes": [ {
    //                 "title": "ความน่าจะเป็น",
    //                 "gridAlpha": 0.2,
    //                 "dashLength": 0
    //             } ],
    //             "startDuration": 1,
    //             "graphs": [ {
    //                 "balloonText": "[[category]]",
    //                 "lineThickness": 1,
    //                 "valueField": "value"
    //             }, {
    //                 "balloonText": "",
    //                 "fillAlphas": 1,
    //                 "type": "column",
    //                 "valueField": "vertical",
    //                 "fixedColumnWidth": 1,
    //                 "labelText": " [[people]]",
    //                 "labelOffset": 10
    //             } ],
    //             "chartCursor": {
    //                 "categoryBalloonEnabled": false,
    //                 "cursorAlpha": 5,
    //                 "zoomable": false
    //             },
    //             "categoryField": "category",
    //             "categoryAxis": {
    //                 "title": "เงินเดือน",
    //                 "gridAlpha": 0.05,
    //                 "startOnAxis": true,
    //                 "tickLength": 5,
    //                 "labelFunction": function( label, item ) {
    //                     return '' + Math.round( item.dataContext.category * 10 ) / 10;
    //                 }
    //             }
    //         });
    //     }
    // });
    $.ajax({
        url: '/job/'+id+'/sequential',
        success: function(response3) {
            $('#chartSequential').removeClass('valign-wrapper');
            var chart = new CanvasJS.Chart("chartSequential",
            {      
                title:{
                    text: "กราฟแสดงจำนวนผู้ที่สนใจประเภทงานนี้แบ่งตามช่วงเงินเดือน",
                    fontSize: 14,
                },
                animationEnabled: true,
                axisY :{
                    includeZero: false,
                    labelFontSize: 14,
                    titleFontSize: 14,
                    title: 'จำนวนผู้สนใจประเภทงาน(คน)',
                    maximum: response3.maxY,
                },
                axisX :{
                    includeZero: false,
                    labelFontSize: 10,
                    titleFontSize: 14,
                    title: 'ช่วงเงินเดือน(บาท)'
                },
                toolTip: {
                    content: "ผู้ที่สมัครงานนี้ในช่วงเงินเดือน {label} : {indexLabel}"
                },
                data: response3.data
            });
            chart.render();
        }
    });
});
