<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://necolas.github.io/normalize.css/8.0.0/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/estilos.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/assets/css/fm.selectator.jquery.css') }}"/>

    <script src="{{ asset('dashboard/assets/js/Chart.js') }}"></script>
    <title>Portafolio</title>
</head>

<body>


    @include('includes.menu_dashboard')
    @include('includes.menu_dashboard_mobile')


    @yield('content')


    <section style="float:right;padding:10px; margin: 0 0 1em 0;">
      {!!Form::select('idioma2',config('idioma.'.App::getLocale()) ,App::getLocale(), [
      'id' => 'idioma2',
      'class' => 'form-control'
      ])!!}
    </section>


    <!-- CDN -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" ></script>
    <script src="{{ asset('/dashboard/assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('/dashboard/assets/js/fm.selectator.jquery.js') }}"></script>
    <!-- CDN -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script>

    $("#idioma2").change(function () {
      var lang = $(this).val();
      window.location='/lang/'+lang;
    });


     /** Select **/
    $('#select-comprar').selectator();

    var btnCompra = document.getElementById('button-Comprar');

    btnCompra.addEventListener('click', ()=>{
        document.getElementById('list-item').classList.toggle('active');
        btnCompra.classList.toggle('show');
    })


    //Navbar Móvil
    let menu_operar = document.getElementById('menu-operar');
    let btn_nav = document.getElementById('btn-nav');

    btn_nav.addEventListener('click', ()=>{
        btn_nav.classList.toggle('active');

        menu_operar.classList.toggle('show-menu-operar');

    });


    //NAVBAR
    let toggler_nav = document.getElementById('toggler-nav');
    let navbar_custom = document.getElementById('navbar-custom');
    let principal = document.getElementById('principal-section');
    let navHorizontal = document.getElementById('nav-horizontal');
    

    toggler_nav.addEventListener('click', ()=>{
        navbar_custom.classList.toggle('navbar-custom-small');
        principal.classList.toggle('principal-section-large');
        navHorizontal.classList.toggle('nav-horizontal-large');

        if(navbar_custom.classList.contains('navbar-custom-small')){
            localStorage.setItem('navSmall', 'true');
        }else{
            localStorage.setItem('navSmall', 'false');
        }

    });

    if(localStorage.getItem('navSmall') === 'true'){
        navbar_custom.classList.toggle('navbar-custom-small');
        principal.classList.toggle('principal-section-large');
        navHorizontal.classList.toggle('nav-horizontal-large');
    }

   
    //DARK MODE
    let modeDarkChart;

    const btnDarkMode = document.getElementById('btn-dark-mode');
    const navHeader = document.getElementById('nav-header');
    btnDarkMode.addEventListener('click', ()=>{
        btnDarkMode.classList.toggle('active'); 
        document.body.classList.toggle('dark-mode');
        if(document.body.classList.contains('dark-mode')){
            localStorage.setItem('dark-mode', 'true');
            ClearChart();
            modeDarkChart = 'true';
            showChart();
        }else{
            localStorage.setItem('dark-mode', 'false');
            ClearChart();
            modeDarkChart = 'false';
            showChart();
        }
    });

    if(localStorage.getItem('dark-mode')=== 'true'){
        btnDarkMode.classList.add('active'); 
        document.body.classList.add('dark-mode');
        modeDarkChart = 'true';
    }else{
        modeDarkChart = 'false';
    }
    </script>




    @if(isset($page))
        @if($page == 'portfolio')



            <script>
                //DESTROY CHARTJS
            function ClearChart(){
                document.getElementById('container-chart').removeChild(document.getElementById('myChart'));
                document.getElementById('container-chart').innerHTML = '<canvas id="myChart" ></canvas>';
            }

            function showChart(labels, data){

                console.log(labels);

                // CHART JS BACKGROUND GRADIENT
                var chart  = document.getElementById('myChart').getContext('2d'),
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

                if(modeDarkChart === 'true'){
                    Chart.defaults.global.tooltips.backgroundColor = gradienttoltip;
                    Chart.defaults.scale.ticks.fontColor = '#ffff';
                    gridLinesColor ='#ffffff46';

                    gradientpoints.addColorStop(0, 'rgba(215,238,223,1)');
                    gradientpoints.addColorStop(1, 'rgba(35,209,96,1)');
                }else{
                    Chart.defaults.global.tooltips.backgroundColor = '#23509D';
                    Chart.defaults.scale.ticks.fontColor = '#464646';
                    gridLinesColor ='#ced4da';

                    gradientpoints.addColorStop(0, 'rgba(73, 132,255, 1)');
                    gradientpoints.addColorStop(1, 'rgba(133,255,255,1)');

                }

               

                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
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
                                }
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
                                    var isSymbol = $("#getCurrencies").data('symbol');
                                    return isSymbol + ' ' + Intl.NumberFormat("en-IN").format( tooltipItems.yLabel.toString());
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



            //showChart();

                //Mini Chartjs
                function miniChart(){
                var chart  = document.getElementById('miniChart').getContext('2d'),
                gradient = chart.createLinearGradient(0, 0, 0, 300);
                    
                gradient.addColorStop(0, 'rgba(73, 132,255, 0.3)');
                gradient.addColorStop(0.1, 'rgba(133,255,255,0.2)');
                gradient.addColorStop(0.5, 'rgba(133, 255, 255, 0.1)');


                var ctx = document.getElementById('miniChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Feb-1', 'Feb-2', 'Feb-3', 'Feb-4', 'Feb-5', 'Feb-6','Feb-7','Feb-8','Feb-9','Feb-10','Feb-11'],
                        datasets: [{
                            label: '# of Votes',
                            data: [2200, 5000,7000,5500, 10000,10100.50,10300, 9500,18000 , 17000 , 20000],
                            backgroundColor: gradient,
                            borderColor: [
                                '#4C84FF',
                            ],
                            borderWidth: 1,
                            pointRadius: 1,
                            pointHoverRadius: 1,
                        }],

                    },
                    options: {

                        scales: {
                            yAxes: [{
                                display: false
                            }],

                            xAxes: [{
                                display: false
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
                            enabled: false
                        }
                        
                    }
                });

            }

            miniChart();
            </script>
        @endif

        @if($page == 'prices')
            <script>
                //DESTROY CHARTJS
            function ClearChart(){
                document.getElementById('container-chart').removeChild(document.getElementById('myChart'));
                document.getElementById('container-chart').innerHTML = '<canvas id="myChart" ></canvas>';
            }

            function showChart(labels, data){

                console.log(labels);

                // CHART JS BACKGROUND GRADIENT
                var chart  = document.getElementById('myChart').getContext('2d'),
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

                if(modeDarkChart === 'true'){
                    Chart.defaults.global.tooltips.backgroundColor = gradienttoltip;
                    Chart.defaults.scale.ticks.fontColor = '#ffff';
                    gridLinesColor ='#ffffff46';

                    gradientpoints.addColorStop(0, 'rgba(215,238,223,1)');
                    gradientpoints.addColorStop(1, 'rgba(35,209,96,1)');
                }else{
                    Chart.defaults.global.tooltips.backgroundColor = '#23509D';
                    Chart.defaults.scale.ticks.fontColor = '#464646';
                    gridLinesColor ='#ced4da';

                    gradientpoints.addColorStop(0, 'rgba(73, 132,255, 1)');
                    gradientpoints.addColorStop(1, 'rgba(133,255,255,1)');

                }

               

                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
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
                                }
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
                                    return "Vier. 03/04/2020, 04:19";
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


                //Mini Chartjs
                function miniChart(){
                var chart  = document.getElementById('miniChart').getContext('2d'),
                gradient = chart.createLinearGradient(0, 0, 0, 300);
                    
                gradient.addColorStop(0, 'rgba(73, 132,255, 0.3)');
                gradient.addColorStop(0.1, 'rgba(133,255,255,0.2)');
                gradient.addColorStop(0.5, 'rgba(133, 255, 255, 0.1)');


                var ctx = document.getElementById('miniChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Feb-1', 'Feb-2', 'Feb-3', 'Feb-4', 'Feb-5', 'Feb-6','Feb-7','Feb-8','Feb-9','Feb-10','Feb-11'],
                        datasets: [{
                            label: '# of Votes',
                            data: [2200, 5000,7000,5500, 10000,10100.50,10300, 9500,18000 , 17000 , 20000],
                            backgroundColor: gradient,
                            borderColor: [
                                '#4C84FF',
                            ],
                            borderWidth: 1,
                            pointRadius: 1,
                            pointHoverRadius: 1,
                        }],

                    },
                    options: {

                        scales: {
                            yAxes: [{
                                display: false
                            }],

                            xAxes: [{
                                display: false
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
                            enabled: false
                        }
                        
                    }
                });

            }

            miniChart();
            </script>
        @endif

   @endif

</script>
<h2>hola</h2>
<script type="text/javascript" src="/dashboard/assets/js/code.js"></script>
@if(isset($page))
    @if($page == 'portfolio')
    <script type="text/javascript">
         viewChart('BTC');
    </script>
    @endif


    @if($page == 'prices')
    <script type="text/javascript">
         viewChart('BTC');
    </script>
    @endif

@endif
</html>