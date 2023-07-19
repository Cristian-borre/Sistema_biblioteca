var monthNames = [
    'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
];

var dias = data.map(libro => libro.dia);
var meses = data.map(libro => monthNames[libro.mes - 1]);
var totalPrestamos = data.map(libro => libro.total_prestamos);

var ctx = document.getElementById('myChartLine').getContext('2d');

var chartData = {
    labels: dias.map((dia, index) => dia + ' ' + meses[index]),
    datasets: [{
        label: 'Prestamos',
        data: totalPrestamos,
        fill: false,
        borderColor: 'rgb(30, 26, 52)',
        tension: 0.1
    }]
};
// Configurar las opciones del gráfico
var options = {
    scales: {
        y: {
            beginAtZero: true
        }
    }
};
// Crear una nueva instancia de Chart
var myChart = new Chart(ctx, {
    type: 'line',
    data: chartData,
    options: options
});