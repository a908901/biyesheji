<template>
    <div>
        <div class="echarts">
            <IEcharts :option="line" ></IEcharts>
        </div>
        <div class="echarts">
            <IEcharts :option="bar" ></IEcharts>
        </div>
        <div class="echarts">
            <IEcharts :option="pie" ></IEcharts>
        </div>
        <div class="echarts">
            <IEcharts :option="pie_radius" ></IEcharts>
        </div>
    </div>
</template>

<script type="text/jsx">
    import { XHRGet, XHRPost } from "../../api/ajax";
    import IEcharts from 'vue-echarts-v3';
    export default {

        components: {
            IEcharts
        },

        data: () => ({
            pageNum:1,
            line:{
                color:["#FF4949"],
                title: {
                    text: '季度盈利柱形图'
                },
                xAxis: {
                    data: ["春季", "夏季", "秋季", "冬季"]
                },
                yAxis:{},
                series: ""
            },
            bar: {
                color:["#20a0ff",],
                title: {
                    text: '季度盈利柱状图'
                },
                xAxis: {
                    data: ["春季", "夏季", "秋季", "冬季"]
                },
                yAxis:{},
                series: ""
            },
            pie: {
                color:["#20a0ff","#13CE66","#F7BA2A","#FF4949","#61a0a8","blue", "yellow" ,"pink" , "#ddd", "#aaa", "#ff00ff", "#ffaaff"],
                title : {
                    text: '年度盈利饼状图',
                    x:'center'
                },
                tooltip : {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    orient: 'vertical',
                    left: 'left',
                    data: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"]
                },
                series : ""
            },
            pie_radius:{
                color:["#20a0ff","#13CE66","#F7BA2A","#FF4949","#61a0a8","blue", "yellow" ,"pink" , "#ddd", "#aaa", "#ff00ff", "#ffaaff"],
                title : {
                    text: '年度盈利环形图',
                    x:'center'
                },
                tooltip : {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {
                    orient: 'vertical',
                    left: 'left',
                    data: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"]
                },
                series : ""
            }
        }),


        mounted: function(){
            const _this = this;
            let data = this.pageNum;
            console.log(data);
            XHRGet('./baseCharts.php',{pageNum:data}, function (response) {
                _this.tableData = response.data.data;
                _this.total = response.data.pageCount;
                console.log(_this.total);
            })



            this.line.series =  [
                {
                    name: "盈利",
                    type: "line",
                    data: [81 , 98 ,108 , 135]
                }
            ];//曲线图
            this.bar.series = [
                {
                    name: "盈利",
                    type: "bar",
                    data: [81 , 98 ,108 , 135]
                }
            ];//条形图
            this.pie.series = [
                {
                    name: '盈利',
                    type: 'pie',
                    radius : '55%',
                    center: ['50%', '50%'],
                    data:[
                        {value:15, name:'一月'},
                        {value:20, name:'二月'},
                        {value:46, name:'三月'},
                        {value:20, name:'四月'},
                        {value:35, name:'五月'},
                        {value:43, name:'六月'},
                        {value:36, name:'七月'},
                        {value:43, name:'八月'},
                        {value:29, name:'九月'},
                        {value:59, name:'十月'},
                        {value:50, name:'十一月'},
                        {value:26, name:'十二月'}
                    ],
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]//饼图
            this.pie_radius.series = [
                {
                    name: '盈利',
                    type: 'pie',
                    radius : ['40%','60%'],
                    data:[
                        {value:15, name:'一月'},
                        {value:20, name:'二月'},
                        {value:46, name:'三月'},
                        {value:20, name:'四月'},
                        {value:35, name:'五月'},
                        {value:43, name:'六月'},
                        {value:36, name:'七月'},
                        {value:43, name:'八月'},
                        {value:29, name:'九月'},
                        {value:59, name:'十月'},
                        {value:50, name:'十一月'},
                        {value:26, name:'十二月'}
                    ],
                    itemStyle: {
                        emphasis: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    }
                }
            ]//环形图
        },



    }
</script>

<style scoped>
    .echarts {
        float: left;
        width: 500px;
        height: 400px;
    }
</style>

