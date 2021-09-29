
var numberHighest,numberLess,percentage,priceActuality,
start_date_default, end_date_default,nameCripto;

$(document).ready(function(){
    endpoint = 'timeframe'
    access_key = '91be84e379936ae81d9d962a06567993';
    
    var keyCurrency = 'abe8a05e7319c694475c';

    nameCripto = $('#getCryptos').val()
    var end_date_default = ""
    var current_date = new Date()
    var current_day = current_date.getDate()
    var current_month = current_date.getMonth() + 1
    var current_year = current_date.getFullYear();



        
    
    
    start_date_default = new Date(new Date().getTime() - 168 * 60 * 60 * 1000 - new Date().getTimezoneOffset() * 60 * 1000).toISOString().substr(0,10);
    end_date_default = new Date().toISOString().slice(0, 10);


    $(".itemCtr1").click(() => {
        start_date_default = new Date(new Date().getTime() - 168 * 60 * 60 * 1000 - new Date().getTimezoneOffset() * 60 * 1000).toISOString().substr(0,10);
        valuesDefault();
        clearItem(".itemCtr1");
    });

    $(".itemCtr2").click(() => {
        start_date_default = new Date(new Date().getTime() - 720 * 60 * 60 * 1000 - new Date().getTimezoneOffset() * 60 * 1000).toISOString().substr(0,10);
        clearItem(".itemCtr2");
        valuesDefault();
    });

    $(".itemCtr3").click(() => {
        start_date_default = new Date(new Date().getTime() - 2160 * 60 * 60 * 1000 - new Date().getTimezoneOffset() * 60 * 1000).toISOString().substr(0,10);
        valuesDefault();
        clearItem(".itemCtr3");
    });

    $(".itemCtr4").click(() => {
        start_date_default = new Date(new Date().getTime() - 4320 * 60 * 60 * 1000 - new Date().getTimezoneOffset() * 60 * 1000).toISOString().substr(0,10);
        valuesDefault();
        clearItem(".itemCtr4");
    });

    $(document).on('change','#getCryptos',function(){
        nameCripto = $(this).find("option:selected").attr('value');
        cryptoIcon(nameCripto);
        valuesDefault();
    });



    function valuesDefault(){
      
      fetch(start_date_default, end_date_default);
    }

    function clearItem(isClass){
        $(".btn-primary-custom-gradient").removeClass('active');
    }


    function fetch(start_date, end_date){

        $.ajax({
            url: `https://api.coinlayer.com/api/${endpoint}?access_key=${access_key}&symbols=${nameCripto}&start_date=${start_date}&end_date=${end_date}`,   
            dataType: 'jsonp',
            success: function(data) {
                if(data.success == false){
                    switch(data.error.code){
                        case 505: $('#error').html('time frame too long')
                        case 202: $('#error').html('It cannot exceed the current date')
                        case 504: $('#error').html('The start date cannot exceed the end date')
                        case 502: $('#error').html('You have specified an invalid date')
                    }
                }else{
                    //console.log('edinson',data);
                    var arrayLabels = []
                    var arrayData = []
                    for(const prop in data.rates){
                        arrayLabels.push(prop)
                        arrayData.push(data.rates[prop][`${nameCripto}`])
                    }

                    chart(arrayLabels, arrayData);


                    numberHighest = max(arrayData);
                    numberLess = min(arrayData);
                    //var percentage = percentajeCrypto(arrayData);
                    percentage = relDiff(numberHighest, numberLess);
                    showChart(numberHighest, numberLess, percentage);
                    priceActuality = arrayData[(arrayData.length) - 1];
                    $("#currencyActuality").text(priceActuality.toFixed(2));
                    currencyAjax();


                    start_date = new Date(new Date().getTime() - 720 * 60 * 60 * 1000 - new Date().getTimezoneOffset() * 60 * 1000).toISOString().substr(0,10);
                    $.ajax({
                        url: `https://api.coinlayer.com/api/${endpoint}?access_key=${access_key}&symbols=${nameCripto}&start_date=${start_date}&end_date=${end_date}`,   
                        dataType: 'jsonp',
                        success: function(data) {

                            let arrayLabels = []
                            let arrayData = []
                            for(const prop in data.rates){
                                arrayLabels.push(prop)
                                arrayData.push(data.rates[prop][`${nameCripto}`])
                            }

                            let numberHighest = max(arrayData);
                            let numberLess = min(arrayData);
                            let percentage_month = relDiff(numberHighest, numberLess);
                            showMinimResult(arrayData, percentage, percentage_month);

                        }
                    });
                }
            }
        });

        $.ajax({
            url: `https://api.coinlayer.com/live?access_key=${access_key}&target=${currencyIS}`,   
            dataType: 'jsonp',
            success: function(data) {
                var domCrypto = $(".itemCrypto")
                var rates = data.rates;
                for(var i = 0; i < domCrypto.length; i++){
                    let nameCrypto = $(domCrypto[i]).data('crypto');
                    let upper_name = nameCrypto.toUpperCase();
                    //console.log(rates.upper_name, rates, upper_name);
                    if(domCrypto[i] && rates[upper_name]){
                            var wprice = $(domCrypto[i]).find('.price_widget');
                            $(wprice).html(rates[upper_name]);
                        
                    }
                    //console.log(rates[upper_name]);
                }
            }
        });

        function currencyAjax(){
      
            //
            $.ajax({
                url: `https://free.currconv.com/api/v7/convert?q=USD_${currencyIS}&compact=ultra&apiKey=${keyCurrency}`,   
                dataType: 'jsonp',
                success: function(data) {
                    var cfiat = Number(data['USD_'+currencyIS])
                    var currency_fiat = cfiat.toFixed(2) * numberHighest;
                    var currency_fiat_less = cfiat.toFixed(2) * numberLess;
                    var currency_fiat_actuality = cfiat.toFixed(2) * priceActuality;
                    var nHighest = currency_fiat;

                    console.log(priceActuality);
                    
                    var nLess = currency_fiat_less;
                    $("#currencyActuality").text(currency_fiat_actuality.toFixed(2));
                   //showChart()
                   showChart(nHighest, nLess, percentage);

                   console.log(data);
                }
            });

            preloader(1);

        }

    }

    valuesDefault();

 
    cryptoIcon($("#getCryptos").val());


    var quick_access = $('#quick-access').change(function(){
      var option = $(this).val();
      switch(option){
        
      }
    })

    var since = $('#since').change(function(){
        var start_date = $(this).val()
        var end_date = until.val()
        if(end_date === ""){
            $('#error').html('Please enter an end date')
        }else{
            fetch(start_date, end_date)
            $('#error').html('') 
        }
    }) 

    var until = $('#until').change(function(){
        var end_date = $(this).val()
        var start_date = since.val()

        if(start_date === ""){
            $('#error').html('Please enter a starting date')
        }else{
            fetch(start_date, end_date)
            $('#error').html('') 
        }
    }) 

    
})
var myChart = "";
var ctx;

function chart(labels, data){
    if(document.getElementById('chart-results') != null) {


        /*Chart.defaults.global.legend.display = false;
        Chart.defaults.global.defaultFontColor = "#fff";

        ctx = document.getElementById('chart-results').getContext('2d');

        if(myChart && myChart !== null){
          myChart.destroy();
        } 
        myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels,
                datasets: [{
                    backgroundColor: 'rgba(0, 178, 255, 0.2)',
                    borderColor: '#5080f7',
                    data,
                    label: 'crypto price',
                    fill: 'origin',
                    pointBackgroundColor: '#d0ebd8'
                }]
            },
            options: {
                responsive: true,
                 maintainAspectRatio: false,
                tooltips: {
                  enabled: true,
                  mode: 'index',
                  intersect: true
                },


                annotation: {
                  annotations: [{
                    type: 'line',
                    mode: 'horizontal',
                    scaleID: 'y-axis-0',
                    value: 5,
                    borderColor: 'rgb(75, 192, 192)',
                    borderWidth: 4,
                    label: {
                      enabled: false,
                      content: 'Test label'
                    }
                  }]
                }
              }
        });*/


         var chart  = document.getElementById('chart-results').getContext('2d'),
            gradient = chart.createLinearGradient(0, 0, 0, 300);
            gradientpoints = chart.createLinearGradient(0,0,0,300);
            gradienttoltip = chart.createLinearGradient(0,0,0,300);
            
            
            gradient.addColorStop(0, 'rgba(73, 132,255, 1)');
            gradient.addColorStop(0.7, 'rgba(133,255,255,0.5)');
            gradient.addColorStop(1, 'rgba(133, 255, 255, 0.1)');

            gradienttoltip.addColorStop(0.5, 'rgba(75,228,241,1)');
            gradienttoltip.addColorStop(1, 'rgba(75,228,241,0.9)');
        

            //CHART JS GLOBAL

            Chart.defaults.global.animationSteps = 160;
            Chart.defaults.global.defaultFontFamily = 'Roboto';
            Chart.defaults.global.elements.responsive = true;

            Chart.defaults.global.tooltips.xPadding = 13;
            Chart.defaults.global.tooltips.yPadding =8;
            Chart.defaults.global.tooltips.titleMarginBottom = 10;

            Chart.defaults.global.tooltips.backgroundColor = gradienttoltip;
            Chart.defaults.scale.ticks.fontColor = '#ffff';
            gridLinesColor ='#ffffff46';

            gradientpoints.addColorStop(0, 'rgba(215,238,223,1)');
            gradientpoints.addColorStop(1, 'rgba(35,209,96,1)');



            if(myChart && myChart !== null){
              myChart.destroy();
            } 
        

            var ctx = document.getElementById('chart-results').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels,
                    datasets: [{
                        label: '# of Votes',
                        data: data,
                        backgroundColor: gradient,
                        borderColor: [
                            '#4C84FF',
                        ],
                        borderWidth: 3,
                        pointRadius: 4,
                        pointHoverRadius: 8,
                        pointBackgroundColor: gradientpoints
                    }],

                },
                options: {

                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true,
                                maxTicksLimit: 5,
                                fontSize: 14,

                                // Include a dollar sign in the ticks
                                callback: function(value, index, values) {
                                    var num = Intl.NumberFormat("en-IN").format(value);
                                    if(num.length > 1){
                                        return '$' + num.toString().substring(0, num.length - 4) + ' k';
                                    }else{
                                        return '$' + num;
                                    }
                                    
                                }
                            },
                            gridLines: { 
                                color: gridLinesColor ,
                                zeroLineColor: gridLinesColor,
                                drawBorder: 5,
                                drawBorder: false,
                            }
                        }],

                        xAxes: [{
                            ticks:{
                                fontSize: 14
                            },
                            gridLines: {
                                drawOnChartArea: false,
                                color: gridLinesColor,
                                zeroLineColor: gridLinesColor
                            },
                        }]
                    },
                    
                    elements: {
                        line: {
                            tension: 0.13
                        }
                    },

                    maintainAspectRatio: false,

                    legend: {
                        display: false
                    },
                    tooltips: {
                        callbacks: {
                            label: function(tooltipItems, data) {
                                return "$ " + Intl.NumberFormat("en-IN").format( tooltipItems.yLabel.toString());
                            },
                            title: function (tooltipItem, data) { 
                                return 'Date: ' + tooltipItem[0].xLabel + ' GMT+2';
                                //return "Vier. 03/04/2020, 04:19";
                            },
                        },
                        
                        
                        displayColors: false,
                        titleAlign: 'center',
                        bodyAlign: 'center',
                        titleFontSize: 12,
                        bodyFontSize: 15,
                        bodyFontStyle: 'bold'
                    }
                    
                }
            });


    }
}   


let getID = (id) => {
    return document.getElementById(id);
}

let txtID = (id, txt) => {
    return document.getElementById(id).innerText = (Number(txt) ? txt.toFixed(2) : txt);
}

let max = (input) => {
  if (toString.call(input) !== "[object Array]")  return false;
  return Math.max.apply(null, input);
}

let min = (array) => {
    return Math.min.apply( Math, array );
};

function cryptoIcon(name){
    let item = getID('imagenCrypto');
    item.setAttribute('class', 'mr-2');
    item.src = `https://raw.githubusercontent.com/spothq/cryptocurrency-icons/master/128/icon/${name.toLocaleLowerCase()}.png`;
}

function showChart(price, priceLess, percentage){
    txtID('priceCrypto', price);
    //txtID('priceLess', priceLess);
    txtID('percetanjeshow', percentage);
    //txtID('7Item', percentage);
}

function percentajeCrypto(arr){
    var arr= arr;
        //var arr=[96448, 35780];         
          var diff=[];
          for(var i=0;i<arr.length;i++)
      {
           //96448 - 35780 = 60668 / 96448 = 0,629 * 100 = 62,9%
           if(i==arr.length-1){
            diff.push('---');
            }else{
            var first=arr[i];
            var second=arr[i+1];
            var calc =(((first - second)/first)*100).toFixed(2)+'%';
            diff.push(calc);
            }
          }
          console.log(diff);
}

function relDiff(a, b) {
 return  100 * Math.abs( ( a - b ) / ( (a+b)/2 ) );
}


function preloader(type){
    if(type){
        $(".behaviorPreloader").hide();
    } else{
        $(".behaviorPreloader").show();
    }
}


var itemShows = 0;
function showMinimResult(data, percentage, month){

    if(itemShows == 0){

        var time_24_a = data[data.length - 1];
        var time_24_b = data[data.length - 2];
        var time_24_show = time_24_a / time_24_b;
        var time_24_fixed = time_24_show.toFixed(2);
        
        $("#24Item").html(time_24_fixed + '%');
        $("#7Item").html(percentage.toFixed(2));
        $("#30Item").html(month.toFixed(2));

        if(Math.sign(time_24_fixed) == 1){
            $("#24ItemIcon").attr('class', 'fa fa-arrow-up');
        } else {
            $("#24ItemIcon").attr('class', 'fa fa-arrow-down');
            var white = $("#24ItemIcon").parent();
            $(white).attr('class', 'text-white');
        }

        ///////////////////////////////////////////////////////////
        if(Math.sign(Number($("#7Item").text())) == 1){
            $("#7ItemIcon").attr('class', 'fa fa-arrow-up');
        } else {
            $("#7ItemIcon").attr('class', 'fa fa-arrow-down');
            var white = $("#7ItemIcon").parent();
            $(white).attr('class', 'text-white');
        }

        ///////////////////////////////////////////////////////////



        itemShows = 1;

    }



}




