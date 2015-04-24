
var RegimeModel = {} ;
RegimeModel.select = [
    {
        value: 'dentiste',
        label : 'Dentiste'
    },
    {
        value: 'avocat',
        label : 'Avocat'
    }
];
RegimeModel.conversion = {
    'dentiste' : {
        15 : 40,
        30 : 40,
        60 : 40,
        90 : 40,
        180 : 20,
        365 : 20,
        1095 : 10
    },
    'avocat' : {
        15 : 30,
        30 : 30,
        60 : 30,
        90 : 30,
        180 : 10,
        365 : 10,
        1095 : 0
    }
};

var colWidth = ($('#OAVgraph').width() / 6) + 1;

var myapp = angular.module('myapp', ["highcharts-ng"]);

myapp.controller('ChartsController', function ($scope) {

    $scope.addPoints = function () {
        var seriesArray = $scope.highchartsNG.series
        var rndIdx = Math.floor(Math.random() * seriesArray.length);
        seriesArray[rndIdx].data = seriesArray[rndIdx].data.concat([1, 10, 20])
    };

    $scope.highchartsNG = {
        options: {
            chart: {
                type: 'column',
                // marginBottom: 1,
                // marginLeft: 0,
                // marginRight: 0,
                // marginTop: 0,
                spacingBottom: 30,
                // spacingLeft: 0,
                // spacingRight: 0,
                spacingTop: 90,
                backgroundColor: '#f3f3f3',
                animation: {
                    duration: 200
                }
            },
            legend: {
                verticalAlign: 'top',
                x: -150,
                y: -70,
                floating: true,
                borderWidth: 0,
                shadow: false,
                layout: 'vertical'
            }
        },
        series: {
            'gagne' : {
                name: 'Partie gagnée',
                data: [4],
                color: '#a5d32d'
            },
            'perdu' : {
                name: 'Partie perdue',
                data: [8],
                color: '#7e187b'
            }
        },
        title: {
            text: 'Statistiques',
            style: {
                fontWeight: 'bold'
            }
        },
        tooltip: {
            enabled: false
        },
        xAxis: {
            title: {
                text: ''
            },
            labels: {
                x: 0,
                y: 0
            },
            lineColor: 'black',
            lineWidth: 2,
            tickPosition: 'inside',
            tickColor: 'black',
            tickLength: 6,
            tickWidth: 2
        },
        yAxis: {
            title: {
                text: '',
            },
            lineColor: 'black',
            lineWidth: 2
        },
        loading: false
    };
});
