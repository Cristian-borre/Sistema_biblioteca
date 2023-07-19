
var etiquetas = datos.map(item => item.libro);
var valores = datos.map(item => item.total_prestamos);

var ctx = document.getElementById('myChartPie').getContext('2d');

var chartData  = {
    labels: etiquetas,
    datasets: [{
        label: 'Colores',
        data: valores,
        backgroundColor: [
            'rgba(255, 99, 132, 0.7)',
            'rgba(54, 162, 235, 0.7)',
            'rgba(75, 192, 192, 0.7)',
            'rgba(255, 206, 86, 0.7)'
        ],
        borderColor: [
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(255, 206, 86, 1)'
        ],
        borderWidth: 1
    }]
};

var myChart = new Chart(ctx, {
    type: 'pie',
    data: chartData,
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Libros mas prestados'
            }
        }
    }
});