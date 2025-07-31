import Chart from 'chart.js/auto';

document.addEventListener('DOMContentLoaded', () => {
    const ctx = document.getElementById('productsByCategoryChart');
    if (!ctx) return;

    const data = JSON.parse(ctx.dataset.chart);
    const colors = [
        '#FF6384', '#36A2EB', '#FFCD56', '#4BC0C0', '#9966FF', '#FF9F40', '#8A2BE2', '#7FFF00', '#D2691E', '#6495ED',
        '#DC143C', '#00FFFF', '#00008B', '#008B8B', '#B8860B', '#A9A9A9', '#006400', '#BDB76B', '#8B008B', '#556B2F',
        '#FF8C00', '#9932CC', '#8B0000', '#E9967A', '#8FBC8F', '#483D8B', '#2F4F4F', '#00CED1', '#9400D3', '#FF1493',
        '#7CFC00', '#ADD8E6', '#F08080', '#DDA0DD', '#FAEBD7'
    ];
    const chart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Total',
                data: data.counts,
                backgroundColor: colors,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            }
        }
    });
});
