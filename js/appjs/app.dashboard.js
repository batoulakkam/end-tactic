var $charts = $charts || {};

$charts = (function() {

    function initPageEvents() {

        AmCharts.addInitHandler(function(chart) {
            // check if there are graphs with autoColor: true set
            //console.log(chart);
            //console.log(chart.dataProvider.length);
            for (var i = 0; i < chart.graphs.length; i++) {
                var graph = chart.graphs[i];
                if (graph.autoColor !== true)
                    continue;
                var colorKey = "autoColor-" + i;
                graph.lineColorField = colorKey;
                graph.fillColorsField = colorKey;
                for (var x = 0; x < chart.dataProvider.length; x++) {
                    var color = chart.colors[x]
                    chart.dataProvider[x][colorKey] = color;
                }
            }

        }, ["serial"]);
    }

    function renderBarChart(containerId, dataProvider, chartTitle, x_title, y_title) {
        var chart = AmCharts.makeChart(containerId, {
            "type": "serial",
            "startEffect": "bounce",
            "hideCredits": true,
            "titles": [{
                "text": chartTitle,
                "size": 20,
                "color": "#31708f",
                bold: true,
                alpha: 0.8
            }],
            addClassNames: true,
            "colors": ["#FF6600", "#FCD202", "#B0DE09", "#0D8ECF", "#2A0CD0", "#CD0D74", "#CC0000", "#00CC00", "#0000CC", "#DDDDDD", "#999999", "#333333", "#990000", "#FF6600", "#FCD202", "#B0DE09", "#0D8ECF", "#2A0CD0", "#CD0D74", "#CC0000", "#00CC00", "#0000CC", "#DDDDDD", "#999999", "#333333", "#990000", "#FF6600", "#FCD202", "#B0DE09", "#0D8ECF", "#2A0CD0", "#CD0D74", "#CC0000", "#00CC00", "#0000CC", "#DDDDDD", "#999999", "#333333", "#990000"],

            "theme": "light",
            "dataProvider": dataProvider,
            "valueAxes": [{
                "gridColor": "#FFFFFF",
                "gridAlpha": 0.2,
                "dashLength": 0,
                "title": y_title
            }],
            "gridAboveGraphs": true,
            "startDuration": 1,
            "graphs": [{
                "balloonText": "[[category]]: <b>[[value]]</b>",
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "column",
                "fillAlphas": 0.8,
                "valueField": "y_val",
                "autoColor": true,

            }],
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "x_val",
            "categoryAxis": {
                "gridPosition": "start",
                "gridAlpha": 0.2,
                "axisAlpha": 0.5,
                "tickPosition": "start",
                "labelRotation": 45,
                "tickLength": 20,
                "title": x_title
            },
            "export": {
                "enabled": true
            }
        });

        chart.addListener("drawn", function() {
            $(".amcharts-title-main").css("font-family", "GESS_Light").css("font-size", "14px");
        });
    }

    function renderDotChart(containerId, dataProvider, chartTitle, x_title, y_title) {
        var chart = AmCharts.makeChart(containerId, {
            "type": "serial",
            "addClassNames": true,
            "startEffect": "bounce",
            "hideCredits": true,
            "titles": [{
                "text": chartTitle,
                "size": 20,
                "color": "#31708f",
                bold: true,
                alpha: 0.8
            }],
            "colors": ["#FF6600", "#FCD202", "#B0DE09", "#0D8ECF", "#2A0CD0", "#CD0D74", "#CC0000", "#00CC00", "#0000CC", "#DDDDDD", "#999999", "#333333", "#990000", "#FF6600", "#FCD202", "#B0DE09", "#0D8ECF", "#2A0CD0", "#CD0D74", "#CC0000", "#00CC00", "#0000CC", "#DDDDDD", "#999999", "#333333", "#990000", "#FF6600", "#FCD202", "#B0DE09", "#0D8ECF", "#2A0CD0", "#CD0D74", "#CC0000", "#00CC00", "#0000CC", "#DDDDDD", "#999999", "#333333", "#990000"],
            "theme": "light",
            "dataProvider": dataProvider,
            "valueAxes": [{
                "gridColor": "#FFFFFF",
                "gridAlpha": 0.2,
                "dashLength": 0,
                "title": y_title
            }],
            "gridAboveGraphs": true,
            "startDuration": 1,
            "graphs": [{
                "balloonText": "[[category]]: <b>[[value]]</b>",
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "line",
                "bullet": "round",
                "fillAlphas": 0,
                "lineColor": "#8d1cc6",
                "valueField": "y_val",
                "autoColor": true,
            }],
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "x_val",
            "categoryAxis": {
                "gridPosition": "start",
                "gridAlpha": 0.2,
                "axisAlpha": 0.5,
                "labelRotation": 45,
                "tickPosition": "start",
                "tickLength": 20,
                "title": x_title
            },
            "export": {
                "enabled": true
            }
        });
    }

    function renderPolygonChart(containerId, dataProvider, chartTitle, x_title, y_title) {
        var chart = AmCharts.makeChart(containerId, {
            "type": "serial",
            "startEffect": "bounce",
            "hideCredits": true,
            addClassNames: true,
            "titles": [{
                "text": chartTitle,
                "size": 20,
                "color": "#31708f",
                bold: true,
                alpha: 0.8
            }],
            "colors": ["#0D8ECF"],

            "theme": "light",
            "dataProvider": dataProvider,
            "valueAxes": [{
                "gridColor": "#FFFFFF",
                "gridAlpha": 0.2,
                "dashLength": 0,
                "title": y_title
            }],
            "gridAboveGraphs": true,
            "startDuration": 1,
            "graphs": [{
                "balloonText": "[[category]]: <b>[[value]]</b>",
                "fillAlphas": 0.8,
                "lineAlpha": 0.2,
                "type": "line",
                "fillAlphas": 0.5,
                "lineColor": "#8d1cc6",
                "valueField": "y_val",
                "autoColor": true,
            }],
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "x_val",
            "categoryAxis": {
                "gridPosition": "start",
                "gridAlpha": 0.2,
                "axisAlpha": 0.5,
                "tickPosition": "start",
                "labelRotation": 45,
                "tickLength": 20,
                "title": x_title
            },
            "export": {
                "enabled": true
            }
        });
    }

    function render3DBarChart(containerId, dataProvider, chartTitle, x_title, y_title) {
        var chart = AmCharts.makeChart(containerId, {
            "type": "serial",
            "startEffect": "bounce",
            "hideCredits": true,
            "titles": [{
                "text": chartTitle,
                "size": 20,
                "color": "#31708f",
                bold: true,
                alpha: 0.8
            }],
            addClassNames: true,
            "startDuration": 2,
            "colors": ["#FF6600", "#FCD202", "#B0DE09", "#0D8ECF", "#2A0CD0", "#CD0D74", "#CC0000", "#00CC00", "#0000CC", "#DDDDDD", "#999999", "#333333", "#990000", "#FF6600", "#FCD202", "#B0DE09", "#0D8ECF", "#2A0CD0", "#CD0D74", "#CC0000", "#00CC00", "#0000CC", "#DDDDDD", "#999999", "#333333", "#990000", "#FF6600", "#FCD202", "#B0DE09", "#0D8ECF", "#2A0CD0", "#CD0D74", "#CC0000", "#00CC00", "#0000CC", "#DDDDDD", "#999999", "#333333", "#990000"],

            "theme": "light",
            "dataProvider": dataProvider,
            "valueAxes": [{
                "position": "left",
                "axisAlpha": 0,
                "gridAlpha": 0,
                "title": y_title
            }],
            "gridAboveGraphs": true,
            "startDuration": 1,
            "graphs": [{
                "balloonText": "[[category]]: <b>[[value]]</b>",
                "colorField": "color",
                "fillAlphas": 0.85,
                "lineAlpha": 0.2,
                "type": "column",
                "topRadius": 1,
                "valueField": "y_val",
                "autoColor": true,
            }],
            "depth3D": 40,
            "angle": 30,
            "chartCursor": {
                "categoryBalloonEnabled": false,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "x_val",
            "categoryAxis": {
                "gridPosition": "start",
                "axisAlpha": 0,
                "gridAlpha": 0,
                "labelRotation": 45

            },
            "export": {
                "enabled": true
            },

        }, 0);
    }

    function renderPieChart(containerId, dataProvider, chartTitle) {
        var chart = AmCharts.makeChart(containerId, {
            "type": "pie",
            "startDuration": 0,
            "hideCredits": true,
            labelsEnabled: false,
            autoMargins: false,
            marginTop: 15,
            marginBottom: 15,
            marginLeft: 15,
            marginRight: 15,
            pullOutRadius: 15,
            "titles": [{
                "text": chartTitle,
                "size": 20,
                "color": "#31708f",
                bold: true,
                alpha: 0.8,

            }],
            "theme": "light",
            "addClassNames": true,
            "percentPrecision": 0,
            "labelText": "[[title]] : [[value]]",
            "precision": 0,
            "innerRadius": "50%",
            "legend": {
                "position": "right",
                "marginRight": 100,
                "autoMargins": false
            },
            "innerRadius": "30%",
            "defs": {
                "filter": [{
                    "id": "shadow",
                    "width": "200%",
                    "height": "200%",
                    "feOffset": {
                        "result": "offOut",
                        "in": "SourceAlpha",
                        "dx": 0,
                        "dy": 0
                    },
                    "feGaussianBlur": {
                        "result": "blurOut",
                        "in": "offOut",
                        "stdDeviation": 5
                    },
                    "feBlend": {
                        "in": "SourceGraphic",
                        "in2": "blurOut",
                        "mode": "normal"
                    }
                }]
            },
            "balloon": {
                "drop": false,
                "adjustBorderColor": false,
                "color": "#FFFFFF",
                "fontSize": 12
            },
            "dataProvider": dataProvider,
            "valueField": "y_val",
            "titleField": "x_val",
            "export": {
                "enabled": true
            }
        });

        chart.addListener("drawn", function() {

            //$(".amcharts-main-div").css("font-family", "GESS_Light").css("font-size", "14px");
        });
        chart.addListener("init", handleInit);

        chart.addListener("rollOverSlice", function(e) {
            handleRollOver(e);
        });
        //chart.legend.addListener("rollOverItem", handleRollOver);
    }

    function renderPieChart2(containerId, dataProvider, chartTitle) {
        var chart = AmCharts.makeChart(containerId, {
            "type": "pie",
            "hideCredits": true,
            "theme": "light",
            "innerRadius": "40%",
            "gradientRatio": [-0.4, -0.4, -0.4, -0.4, -0.4, -0.4, 0, 0.1, 0.2, 0.1, 0, -0.2, -0.5],
            "titles": [{
                "text": chartTitle,
                "size": 20,
                "color": "#31708f",
                bold: true,
                alpha: 0.8
            }],
            "addClassNames": true,
            "percentPrecision": 0,
            "labelText": "[[title]] : [[value]]",
            "precision": 0,
            "balloonText": "[[value]]",
            "balloon": {
                "drop": true,
                "adjustBorderColor": false,
                "color": "#FFFFFF",
                "fontSize": 16
            },
            "dataProvider": dataProvider,
            "valueField": "y_val",
            "titleField": "x_val",
            "export": {
                "enabled": true
            }
        });

        chart.addListener("drawn", function() {
            //$(".amcharts-main-div").css("font-family", "GESS_Light").css("font-size", "14px");
        });
        chart.addListener("init", handleInit);

        chart.addListener("rollOverSlice", function(e) {
            handleRollOver(e);
        });

    }

    function handleInit() {

    }

    function handleRollOver(e) {
        var wedge = e.dataItem.wedge.node;
        wedge.parentNode.appendChild(wedge);
    }

    function renderMap(containerId, dataProvider, chartTitle) {

        var map = AmCharts.makeChart(containerId, {
            "type": "map",
            "theme": "light",
            "colorSteps": 10,
            "hideCredits": true,
            "titles": [{
                "text": chartTitle,
                "size": 20,
                "color": "#31708f",
                bold: true,
                alpha: 0.8
            }],
            addClassNames: true,
            "zoomOnDoubleClick": false,
            "color": "green",
            "imagesSettings": {
                "labelPosition": "middle",
                "labelFontSize": 8
            },
            "balloon": {
                "textAlign": "left"
            },
            "dataProvider": {
                "map": "saudiArabiaLow",
                "areas": [{
                    id: "SA-01",
                    customData: "<div style='display:inline-block;vertical-align:top;'><img src='/plugins/amcharts/images/regions/SA-01.png' alt='img' width=110 height=100 /></div ><div style='display:inline-block;font-size:15px;color:#31708f;text-align:right;padding:5px;line-height: 25px;'><div><b>المنطقة :</b> Region </div><div><b>عدد المشاريع:</b> ProjCount </div><div><b>معدل الدخل:</b> INCOME </div></div>"
                }],
                "getAreasFromMap": true,
                "images": [{
                    "top": 200,
                    "left": 60,
                    "width": 80,
                    "height": 40,
                    "pixelMapperLogo": true,
                    "imageURL": "",
                    "url": ""
                }]
            },
            "balloon": {
                "horizontalPadding": 15,
                "borderAlpha": 0,
                "borderThickness": 1,
                "verticalPadding": 15
            },
            "imagesSettings": {
                "labelPosition": "middle",
                "labelFontSize": 16
            },
            "areasSettings": {
                "autoZoom": false,
                "color": "green",
                "accessibleLabel": "[[title]]",
                "balloonText": "[[customData]]",
                "alpha": 0.5,
                "selectedColor": "green",
                "fontSize": 16,
                "rollOverColor": "#30d433"
            },
            "export": {
                "enabled": true
            }
        });

        map.addListener("init", function() {
            setTimeout(function() {
                // iterate through areas and put a label over center of each
                map.dataProvider.images = [];
                for (x in map.dataProvider.areas) {
                    console.log(x)
                    var area = map.dataProvider.areas[x];
                    var image = new AmCharts.MapImage();
                    image.latitude = map.getAreaCenterLatitude(area);
                    image.longitude = map.getAreaCenterLongitude(area);
                    image.label = area.title;
                    image.title = area.title;
                    image.linkToObject = area;
                    map.dataProvider.images.push(image);

                }
                for (i = 1; i < 16; i++) {

                    var _newArea = new AmCharts.MapArea();
                    var area = map.dataProvider.areas[0];
                    //var _newId = area.id.replace("1", i);
                    //_newArea.Id = _newId;
                    // console.log();
                    //_newArea.customData = area.customData.replace("1", i).replace("Region", map.dataProvider.areas[0].title);
                    //console.log('_newArea');
                    // console.log(_newArea);
                    map.dataProvider.areas.push({
                        id: area.id.replace("1", i),
                        customData: area.customData.replace("1", i).replace("Region", map.dataProvider.areas[i - 1].title).replace("INCOME", (i + 1) * 3).replace("ProjCount", i + i * 2)
                    });
                }
                map.validateData();
                console.log(map.dataProvider);
                map.dataProvider.images.push({
                    "title": "جدة",
                    "longitude": 39.7091,
                    "latitude": 21.1713,
                    "svgPath": "M31.122,16.22C32.335,16.855,32.284,17.786,31.012,18.292C31.012,18.292,27.249,19.781,27.249,19.781C25.977,20.283,24.054,20.009,22.975,19.165C22.975,19.165,6.629,6.275,6.629,6.275C5.554,5.428,5.438,5.553,6.372,6.553C6.372,6.553,19.295,20.385,19.295,20.385C20.232,21.383,19.955,22.604,18.68,23.098C18.68,23.098,18.239,23.27,18.239,23.27C16.964,23.762,14.883,24.592,13.617,25.107C13.617,25.107,9.442,26.808,9.442,26.808C8.175,27.323,7.138,27.75,7.135,27.758C7.134,27.766,7.129,27.789,7.122,27.792C7.115,27.794,6.817,26.715,6.457,25.396C6.457,25.396,0.094,2.007,0.094,2.007C-0.265,0.687,0.432,0.127,1.644,0.762C1.644,0.762,31.122,16.22,31.122,16.22C31.122,16.22,31.122,16.22,31.122,16.22M20.791,31.529C20.866,31.752,18.217,27.693,18.217,27.693C17.469,26.55,17.893,25.186,19.159,24.669C19.159,24.669,22.047,23.486,22.047,23.486C23.314,22.968,23.92,23.575,23.395,24.842C23.395,24.843,20.715,31.301,20.791,31.529C20.791,31.529,20.791,31.529,20.791,31.529",
                    "color": "rgba(75,216,181,0.8)",
                    "scale": 1
                });
                console.log(map.dataProvider.images);
            }, 100)
        });
    }

    function renderSmoothedLineChart(containerId, dataProvider, chartTitle, x_title, y_title, z_title) {

        var chart = AmCharts.makeChart(containerId, {
            "type": "serial",
            "theme": "light",
            "marginTop": 0,
            "marginRight": 80,
            "startEffect": "bounce",
            "hideCredits": true,
            addClassNames: true,
            "titles": [{
                "text": chartTitle,
                "size": 20,
                "color": "#31708f",
                bold: true,
                alpha: 0.8
            }],
            "dataProvider": dataProvider,
            //"dataProvider": [{
            //    "x_val": "10-2015",
            //    "y_val": 13
            //}, {
            //        "x_val": "11-2015",
            //    "y_val": 11
            //}],
            "graphs": [{
                "id": "g1",
                "balloonText": "[[category]]<br><b><span style='font-size:14px;'>[[value]]</span></b>",
                "bullet": "round",
                "bulletSize": 8,
                "lineColor": "#d1655d",
                "lineThickness": 2,
                "negativeLineColor": "#637bb6",
                "type": "smoothedLine",
                "valueField": "y_val"
            }],
            "chartScrollbar": {
                "graph": "g1",
                "gridAlpha": 0,
                "color": "#888888",
                "scrollbarHeight": 55,
                "backgroundAlpha": 0,
                "selectedBackgroundAlpha": 0.1,
                "selectedBackgroundColor": "#888888",
                "graphFillAlpha": 0,
                "autoGridCount": true,
                "selectedGraphFillAlpha": 0,
                "graphLineAlpha": 0.2,
                "graphLineColor": "#c2c2c2",
                "selectedGraphLineColor": "#888888",
                "selectedGraphLineAlpha": 1

            },
            "chartCursor": {
                "categoryBalloonDateFormat": "MM-YYYY",
                "cursorAlpha": 0,
                "valueLineEnabled": true,
                "valueLineBalloonEnabled": true,
                "valueLineAlpha": 0.5,
                "fullWidth": true
            },
            "dataDateFormat": "M-YYYY",
            "categoryField": "x_val",
            "categoryAxis": {
                "minPeriod": "MM",
                //equalSpacing  : true,
                //"parseDates": true,
                "minorGridAlpha": 0.1,
                "minorGridEnabled": true
            },
            "export": {
                "enabled": true
            }
        });
    }

    function zoomChart(chart) {
        chart.zoomToIndexes(Math.round(chart.dataProvider.length * 0.4), Math.round(chart.dataProvider.length * 0.55));
    }

    function renderLineAndBarChart(containerId, dataProvider, chartTitle, x_title, y_title, z_title) {
        var chart = AmCharts.makeChart(containerId, {
            "type": "serial",
            "addClassNames": true,
            "hideCredits": true,
            "titles": [{
                "text": chartTitle,
                "size": 20,
                "color": "#31708f",
                bold: true,
                alpha: 0.8
            }],
            "colors": ["#FF6600", "#FCD202", "#B0DE09", "#0D8ECF", "#2A0CD0", "#CD0D74", "#CC0000", "#00CC00", "#0000CC", "#DDDDDD", "#999999", "#333333", "#990000", "#FF6600", "#FCD202", "#B0DE09", "#0D8ECF", "#2A0CD0", "#CD0D74", "#CC0000", "#00CC00", "#0000CC", "#DDDDDD", "#999999", "#333333", "#990000", "#FF6600", "#FCD202", "#B0DE09", "#0D8ECF", "#2A0CD0", "#CD0D74", "#CC0000", "#00CC00", "#0000CC", "#DDDDDD", "#999999", "#333333", "#990000"],
            "theme": "light",
            "autoMargins": false,
            "marginLeft": 30,
            "marginRight": 8,
            "marginTop": 10,
            "marginBottom": 26,
            "balloon": {
                "adjustBorderColor": false,
                "horizontalPadding": 10,
                "verticalPadding": 8,
                "color": "#ffffff"
            },
            "dataProvider": dataProvider,
            "valueAxes": [{
                "axisAlpha": 0,
                "title": y_title,
                "position": "left"
            }],
            "startDuration": 1,
            "graphs": [{
                "alphaField": "alpha",
                "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
                "fillAlphas": 1,
                "title": y_title,
                "lineAlpha": 0.2,
                "type": "column",
                "autoColor": true,
                "valueField": "y_val",
                "dashLengthField": "dashLengthColumn"
            }, {
                "id": "graph2",
                "balloonText": "<span style='font-size:12px;'>[[title]] in [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
                "bullet": "round",
                "lineThickness": 3,
                "bulletSize": 7,
                "bulletBorderAlpha": 1,
                "bulletColor": "#FFFFFF",
                "useLineColorForBulletBorder": true,
                "bulletBorderThickness": 3,
                "fillAlphas": 0,
                "lineAlpha": 1,
                "lineColor": "#8d1cc6",
                "title": z_title,
                "valueField": "z_val",
                "dashLengthField": "dashLengthLine"
            }],
            "categoryField": "x_val",
            "categoryAxis": {
                "gridPosition": "start",
                "axisAlpha": 0.5,
                "gridAlpha": 0.2,
                "title": x_title,
                "labelRotation": 45,
                "tickLength": 0
            },
            "export": {
                "enabled": true
            }
        });
    }

    function renderStackedBarChart(containerId, dataProvider, chartTitle, x_title, y_title, rotate = true) {

        var chart = AmCharts.makeChart(containerId, {
            "type": "serial",
            "theme": "light",
            "hideCredits": true,

            "titles": [{
                "text": chartTitle,
                "size": 20,
                "color": "#31708f",
                bold: true,
                alpha: 0.8,
                "marginBottom": 100,
            }],
            "rotate": rotate,
            "columnSpacing": 0,
            "columnWidth": 0.5,
            "percentPrecision": 0,
            "precision": 0,
            //"legend": {
            //    "position": "right",
            //    "marginRight": 100,
            //    "autoMargins": false
            //},
            "dataProvider": getDataProvider(dataProvider),
            "valueAxes": [{
                "stackType": "100%",
                "axisAlpha": 0,
                "gridAlpha": 0,
                "integersOnly": true,
                "labelsEnabled": false,
                "title": y_title,
                "position": "left"
            }],
            "graphs": getGraphs(dataProvider),
            "marginTop": 30,
            "marginRight": 0,
            "marginLeft": 0,
            "marginBottom": 40,
            "lineAlpha": 0.2,
            "autoMargins": false,
            "depth3D": 20,
            "angle": 30,
            "categoryField": "x_val",
            "categoryAxis": {
                "gridPosition": "start",
                "axisAlpha": 0,
                "gridAlpha": 0,
                "title": x_title
            },
            "export": {
                "enabled": true
            }
        });
    }

    //https://www.amcharts.com/demos/using-svg-filters/
    function renderSVGChart(containerId, dataProvider, chartTitle, x_title, y_title) {
        var chart = AmCharts.makeChart(containerId, {
            "type": "serial",
            "theme": "light",
            "fontFamily": "Lato",
            "autoMargins": true,
            "addClassNames": true,
            "hideCredits": true,
            "zoomOutText": "",
            "titles": [{
                "text": chartTitle,
                "size": 20,
                "color": "#31708f",
                bold: true,
                alpha: 0.8,
                "marginBottom": 100,
            }],
            "export": {
                "enabled": true
            },
            "defs": {
                "filter": [{
                        "x": "-50%",
                        "y": "-50%",
                        "width": "200%",
                        "height": "200%",
                        "id": "blur",
                        "feGaussianBlur": {
                            "in": "SourceGraphic",
                            "stdDeviation": "50"
                        }
                    },
                    {
                        "id": "shadow",
                        "width": "150%",
                        "height": "150%",
                        "feOffset": {
                            "result": "offOut",
                            "in": "SourceAlpha",
                            "dx": "2",
                            "dy": "2"
                        },
                        "feGaussianBlur": {
                            "result": "blurOut",
                            "in": "offOut",
                            "stdDeviation": "10"
                        },
                        "feColorMatrix": {
                            "result": "blurOut",
                            "type": "matrix",
                            "values": "0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 .2 0"
                        },
                        "feBlend": {
                            "in": "SourceGraphic",
                            "in2": "blurOut",
                            "mode": "normal"
                        }
                    }
                ]
            },
            "fontSize": 15,
            "pathToImages": "../amcharts/images/",
            "dataProvider": dataProvider,
            "dataDateFormat": "YYYY",
            "marginTop": 0,
            "marginRight": 1,
            "marginLeft": 0,
            "autoMarginOffset": 5,
            "categoryField": "x_val",
            "categoryAxis": {
                "gridAlpha": 0.07,
                "axisColor": "#DADADA",
                "startOnAxis": true,
                "tickLength": 0,
                "parseDates": true,
                "minPeriod": "YYYY"
            },
            "valueAxes": [{
                "ignoreAxisWidth": true,
                "stackType": "regular",
                "gridAlpha": 0.07,
                "axisAlpha": 0,

                "inside": true
            }],
            "graphs": [{
                    "id": "g1",
                    "type": "line",
                    "title": "Cars",
                    "valueField": "y_val",
                    "fillColors": [
                        "#0066e3",
                        "#802ea9"
                    ],
                    "lineAlpha": 0,
                    "fillAlphas": 0.8,
                    "showBalloon": false
                },
                {
                    "id": "g2",
                    "type": "line",
                    "title": "Motorcycles",
                    "valueField": "y_val",
                    "lineAlpha": 0,
                    "fillAlphas": 0.8,
                    "lineColor": "#5bb5ea",
                    "showBalloon": false
                },
                {
                    "id": "g3",
                    "title": "Bicycles",
                    "valueField": "y_val",
                    "lineAlpha": 0.5,
                    "lineColor": "#FFFFFF",
                    "bullet": "round",
                    "dashLength": 2,
                    "bulletBorderAlpha": 1,
                    "bulletAlpha": 1,
                    "bulletSize": 15,
                    "stackable": false,
                    "bulletColor": "#5d7ad9",
                    "bulletBorderColor": "#FFFFFF",
                    "bulletBorderThickness": 3,
                    "balloonText": "<div style='margin-bottom:30px;text-shadow: 2px 2px rgba(0, 0, 0, 0.1); font-weight:200;font-size:30px; color:#ffffff'>[[value]]</div>"
                }
            ],
            "chartCursor": {
                "cursorAlpha": 1,
                "zoomable": false,
                "cursorColor": "#FFFFFF",
                "categoryBalloonColor": "#8d83c8",
                "fullWidth": true,
                "categoryBalloonDateFormat": "YYYY",
                "balloonPointerOrientation": "vertical"
            },
            "balloon": {
                "borderAlpha": 0,
                "fillAlpha": 0,
                "shadowAlpha": 0,
                "offsetX": 40,
                "offsetY": -50
            }
        });

        // we zoom chart in order to have better blur (form side to side)
        //chart.addListener("dataUpdated", zoomChart);
    }

    //https://www.amcharts.com/demos/clustered-bar-chart/
    function renderClusteredBarChart(containerId, dataProvider, chartTitle, x_title, y_title, z_title, clickGraphItemHandeler) {
        var chart = AmCharts.makeChart(containerId, {
            "type": "serial",
            "theme": "light",
            "addClassNames": true,
            "hideCredits": true,
            "categoryField": "x_val",
            "titles": [{
                "text": chartTitle,
                "size": 20,
                "color": "#31708f",
                bold: true,
                alpha: 0.8
            }],
            "rotate": true,
            "startDuration": 1,
            "categoryAxis": {
                "gridPosition": "start",
                "position": "left"
            },
            "trendLines": [],
            "graphs": [{
                "balloonText": y_title + ":[[value]]",
                "fillAlphas": 0.8,
                "id": "AmGraph-1",
                "lineAlpha": 0.2,
                "title": y_title,
                "type": "column",
                "valueField": "y_val"
            }, {
                "balloonText": z_title + ":[[value]]",
                "fillAlphas": 0.8,
                "id": "AmGraph-2",
                "lineAlpha": 0.2,
                "title": z_title,
                "type": "column",
                "valueField": "z_val"
            }],

            "guides": [],
            "valueAxes": [{
                "id": "ValueAxis-1",
                "position": "top",
                "axisAlpha": 0
            }],
            "allLabels": [],
            "balloon": {},
            "titles": [],
            "dataProvider": dataProvider,
            "export": {
                "enabled": true
            }
        });
        // Genral Click Event handler
        if (clickGraphItemHandeler) {
            chart.addListener("clickGraphItem", clickGraphItemHandeler);
        }
    }

    function getGraphs(items) {
        var graphs = [];
        var uniqueStatusNames = $.unique(items.map(function(d) { return d.z_val; }));
        //console.log(uniqueStatusNames);
        uniqueStatusNames.forEach(function(name) {
            var graphs_item = {
                "balloonText": "[[title]], [[category]]<br><span style='font-size:14px;'><b>[[value]]</b> ([[percents]]%)</span>",
                "fillAlphas": 0.9,
                "fontSize": 11,
                "labelText": "[[percents]]%",
                "lineAlpha": 0.5,
                "title": name,
                "type": "column",
                "valueField": name
            };

            graphs.push(graphs_item);
        });

        return graphs;
    }

    function getDataProvider(items) {
        var datatProvider = [];
        var uniqueCategoryNames = $.unique(items.map(function(d) { return d.x_val; }));
        uniqueCategoryNames.forEach(function(name) {
            var datatProvider_item = {
                "x_val": name
            };
            items.forEach(function(row) {
                if (row.x_val == name)
                    datatProvider_item[row.z_val] = row.y_val;

            });
            datatProvider.push(datatProvider_item);

        });

        return datatProvider;
    }

    $(function() {
        initPageEvents();
    });

    var toReturn = {
        renderBarChart: renderBarChart,
        renderDotChart: renderDotChart,
        renderPolygonChart: renderPolygonChart,
        render3DBarChart: render3DBarChart,
        renderPieChart: renderPieChart,
        renderPieChart2: renderPieChart2,
        renderMap: renderMap,
        renderSmoothedLineChart: renderSmoothedLineChart,
        zoomChart: zoomChart,
        renderLineAndBarChart: renderLineAndBarChart,
        renderStackedBarChart: renderStackedBarChart,
        renderSVGChart: renderSVGChart,
        renderClusteredBarChart: renderClusteredBarChart
    };

    return toReturn;

}());