!function(s) {
    "use strict";
    var o=function() {
        this.$body=s("body"),
        this.$realData=[]
    }
    ;
    o.prototype.createPlotGraph=function(o, t, e, a, r, i, l) {
        s.plot(s(o), [ {
            data: t, label: a[0], color: r[0]
        }
        , {
            data: e, label: a[1], color: r[1]
        }
        ], {
            series: {
                lines: {
                    show:!0, fill:!0, lineWidth:2, fillColor: {
                        colors:[ {
                            opacity: .4
                        }
                        , {
                            opacity: .4
                        }
                        ]
                    }
                }
                , points: {
                    show: !1
                }
                , shadowSize:0
            }
            , grid: {
                hoverable: !0, clickable: !0, borderColor: i, tickColor: "#f9f9f9", borderWidth: 1, labelMargin: 10, backgroundColor: l
            }
            , legend: {
                position:"ne", margin:[0, -24], noColumns:0, labelBoxBorderColor:null, labelFormatter:function(o, t) {
                    return o+"&nbsp;&nbsp;"
                }
                , width:30, height:2
            }
            , yaxis: {
                tickColor:"#f5f5f5", font: {
                    color: "#bdbdbd"
                }
            }
            , xaxis: {
                tickColor:"#f5f5f5", font: {
                    color: "#bdbdbd"
                }
            }
            , tooltip:!0, tooltipOpts: {
                content:"%s: مقدار %x، %y است", shifts: {
                    x: -60, y: 25
                }
                , defaultTheme:!1
            }
        }
        )
    }
    ,
    o.prototype.createPieGraph=function(o, t, e, a) {
        var r=[ {
            label: t[0], data: e[0]
        }
        ,
        {
            label: t[1], data: e[1]
        }
        ,
        {
            label: t[2], data: e[2]
        }
        ],
        i= {
            series: {
                pie: {
                    show: !0
                }
            }
            ,
            legend: {
                show: !0
            }
            ,
            grid: {
                hoverable: !0, clickable: !0
            }
            ,
            colors:a,
            tooltip:!0,
            tooltipOpts: {
                content: "%s, %p.0%"
            }
        }
        ;
        s.plot(s(o), r, i)
    }
    ,
    o.prototype.randomData=function() {
        for(0<this.$realData.length&&(this.$realData=this.$realData.slice(1));
        this.$realData.length<300;
        ) {
            var o=(0<this.$realData.length?this.$realData[this.$realData.length-1]: 50)+10*Math.random()-5;
            o<0?o=0: 100<o&&(o=100), this.$realData.push(o)
        }
        for(var t=[], e=0;
        e<this.$realData.length;
        ++e)t.push([e, this.$realData[e]]);
        return t
    }
    ,
    o.prototype.createRealTimeGraph=function(o, t, e) {
        return s.plot(o, [t], {
            colors:e, series: {
                grow: {
                    active: !1
                }
                , shadowSize:0, lines: {
                    show: !0, fill: !1, lineWidth: 2, steps: !1
                }
            }
            , grid: {
                show: !0, aboveData: !1, color: "#dcdcdc", labelMargin: 15, axisMargin: 0, borderWidth: 0, borderColor: null, minBorderMargin: 5, clickable: !0, hoverable: !0, autoHighlight: !1, mouseActiveRadius: 20
            }
            , tooltip:!0, tooltipOpts: {
                content:"مقدار %y.0% است", shifts: {
                    x: -30, y: -50
                }
            }
            , yaxis: {
                min: 0, max: 100, tickColor: "#f5f5f5", color: "rgba(0,0,0,0.1)"
            }
            , xaxis: {
                show: !1, tickColor: "#f5f5f5"
            }
        }
        )
    }
    ,
    o.prototype.createDonutGraph=function(o, t, e, a) {
        var r=[ {
            label: t[0], data: e[0]
        }
        ,
        {
            label: t[1], data: e[1]
        }
        ,
        {
            label: t[2], data: e[2]
        }
        ,
        {
            label: t[3], data: e[3]
        }
        ],
        i= {
            series: {
                pie: {
                    show: !0, innerRadius: .7
                }
            }
            ,
            legend: {
                show:!0,
                labelFormatter:function(o, t) {
                    return'<div style="font-size:14px;">&nbsp;'+o+"</div>"
                }
                ,
                labelBoxBorderColor:null,
                margin:50,
                width:20,
                padding:1
            }
            ,
            grid: {
                hoverable: !0, clickable: !0
            }
            ,
            colors:a,
            tooltip:!0,
            tooltipOpts: {
                content: "%s, %p.0%"
            }
        }
        ;
        s.plot(s(o), r, i)
    }
    ,
    o.prototype.createCombineGraph=function(o, t, e, a) {
        var r=[ {
            label:e[0],
            data:a[0],
            lines: {
                show: !0, fill: !0
            }
            ,
            points: {
                show: !0
            }
        }
        ,
        {
            label:e[1],
            data:a[1],
            lines: {
                show: !0
            }
            ,
            points: {
                show: !0
            }
        }
        ,
        {
            label:e[2],
            data:a[2],
            bars: {
                show: !0
            }
        }
        ],
        i= {
            series: {
                shadowSize: 0
            }
            ,
            grid: {
                hoverable: !0, clickable: !0, tickColor: "#f9f9f9", borderWidth: 1, borderColor: "#eeeeee"
            }
            ,
            colors:["#ff8acc",
            "#5b69bc",
            "#10c469"],
            tooltip:!0,
            tooltipOpts: {
                defaultTheme: !1
            }
            ,
            legend: {
                position:"ne",
                margin:[0,
                -24],
                noColumns:0,
                labelBoxBorderColor:null,
                labelFormatter:function(o, t) {
                    return o+"&nbsp;&nbsp;"
                }
                ,
                width:30,
                height:2
            }
            ,
            yaxis: {
                tickColor:"#f5f5f5",
                font: {
                    color: "#bdbdbd"
                }
            }
            ,
            xaxis: {
                ticks:t,
                tickColor:"#f5f5f5",
                font: {
                    color: "#bdbdbd"
                }
            }
        }
        ;
        s.plot(s(o), r, i)
    }
    ,
    o.prototype.init=function() {
        this.createPlotGraph("#website-stats", [[0, 9], [1, 8], [2, 5], [3, 8], [4, 5], [5, 14], [6, 10], [7, 8], [8, 5], [9, 14], [10, 10]], [[0, 5], [1, 12], [2, 4], [3, 3], [4, 12], [5, 11], [6, 14], [7, 12], [8, 8], [9, 4], [10, 8]], ["بازدید", "بازدید برگه"], ["#188ae2", "#10c469"], "#f5f5f5", "#fff");
        this.createPieGraph("#pie-chart #pie-chart-container", ["سری 1", "سری 2", "سری 3"], [20, 30, 15], ["#ff8acc", "#5b69bc", "#f9c851"]);
        var t=this.createRealTimeGraph("#flotRealTime", this.randomData(), ["#71b6f9"]);
        t.draw();
        var e=this;
        !function o() {
            t.setData([e.randomData()]),
            t.draw(),
            setTimeout(o, (s("html").hasClass("mobile-device"), 1e3))
        }
        ();
        this.createDonutGraph("#donut-chart #donut-chart-container", ["سری 1", "سری 2", "سری 3", "سری 4"], [35, 20, 10, 20], ["#188ae2", "#10c469", "#f9c851", "#ff8acc"]);
        var o=[[[0,
        201],
        [1,
        520],
        [2,
        337],
        [3,
        261],
        [4,
        157],
        [5,
        95],
        [6,
        200],
        [7,
        250],
        [8,
        320],
        [9,
        500],
        [10,
        152],
        [11,
        214],
        [12,
        364],
        [13,
        449],
        [14,
        558],
        [15,
        282],
        [16,
        379],
        [17,
        429],
        [18,
        518],
        [19,
        470],
        [20,
        330],
        [21,
        245],
        [22,
        358],
        [23,
        74]],
        [[0,
        311],
        [1,
        630],
        [2,
        447],
        [3,
        371],
        [4,
        267],
        [5,
        205],
        [6,
        310],
        [7,
        360],
        [8,
        430],
        [9,
        610],
        [10,
        262],
        [11,
        324],
        [12,
        474],
        [13,
        559],
        [14,
        668],
        [15,
        392],
        [16,
        489],
        [17,
        539],
        [18,
        628],
        [19,
        580],
        [20,
        440],
        [21,
        355],
        [22,
        468],
        [23,
        184]],
        [[23,
        727],
        [22,
        128],
        [21,
        110],
        [20,
        92],
        [19,
        172],
        [18,
        63],
        [17,
        150],
        [16,
        592],
        [15,
        12],
        [14,
        246],
        [13,
        52],
        [12,
        149],
        [11,
        123],
        [10,
        2],
        [9,
        325],
        [8,
        10],
        [7,
        15],
        [6,
        89],
        [5,
        65],
        [4,
        77],
        [3,
        600],
        [2,
        200],
        [1,
        385],
        [0,
        200]]];
        this.createCombineGraph("#combine-chart #combine-chart-container", [[0, "22h"], [1, ""], [2, "00h"], [3, ""], [4, "02h"], [5, ""], [6, "04h"], [7, ""], [8, "06h"], [9, ""], [10, "08h"], [11, ""], [12, "10h"], [13, ""], [14, "12h"], [15, ""], [16, "14h"], [17, ""], [18, "16h"], [19, ""], [20, "18h"], [21, ""], [22, "20h"], [23, ""]], ["24 ساعت گذشته", "48 ساعت گذشته", "تفاوت"], o)
    }
    ,
    s.FlotChart=new o,
    s.FlotChart.Constructor=o
}

(window.jQuery),
function(o) {
    "use strict";
    window.jQuery.FlotChart.init()
}

(),
$(document).ready(function() {
    $(function() {
        for(var o=[], t=0;
        t<=10;
        t+=1)o.push([t, parseInt(30*Math.random())]);
        var e=[];
        for(t=0;
        t<=10;
        t+=1)e.push([t, parseInt(30*Math.random())]);
        var a=[];
        for(t=0;
        t<=10;
        t+=1)a.push([t, parseInt(30*Math.random())]);
        var r=new Array;
        r.push( {
            label:"سری یک", data:o, bars: {
                order: 3
            }
        }
        ), r.push( {
            label:"سری دو", data:e, bars: {
                order: 2
            }
        }
        ), r.push( {
            label:"سری سه", data:a, bars: {
                order: 1
            }
        }
        );
        var i= {
            bars: {
                show: !0, barWidth: .2, fill: 1
            }
            , grid: {
                show: !0, aboveData: !1, labelMargin: 5, axisMargin: 0, borderWidth: 1, minBorderMargin: 5, clickable: !0, hoverable: !0, autoHighlight: !1, mouseActiveRadius: 20, borderColor: "#f5f5f5"
            }
            , series: {
                stack: 0
            }
            , legend: {
                position:"ne", margin:[0, -24], noColumns:0, labelBoxBorderColor:null, labelFormatter:function(o, t) {
                    return o+"&nbsp;&nbsp;"
                }
                , width:30, height:2
            }
            , yaxis: {
                tickColor:"#f5f5f5", font: {
                    color: "#bdbdbd"
                }
            }
            , xaxis: {
                tickColor:"#f5f5f5", font: {
                    color: "#bdbdbd"
                }
            }
            , colors:["#188ae2", "#10c469", "#ebeff2"], tooltip:!0, tooltipOpts: {
                content:"%s : %y.0", shifts: {
                    x: -30, y: -50
                }
            }
        }
        ;
        $.plot($("#ordered-bars-chart"), r, i)
    }
    )
}

);