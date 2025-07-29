import ApexCharts from 'apexcharts';

//=======================
// MONTHLY SALES CHART
//=======================
const sales_chart_options = {
  series: [
    {
      name: 'Revenue',
      data: [28, 48, 40, 19, 86, 27, 90],
    },
    {
      name: 'Profit',
      data: [65, 59, 80, 81, 56, 55, 40],
    },
  ],
  chart: {
    height: 180,
    type: 'area',
    toolbar: {
      show: false,
    },
  },
  legend: {
    show: false,
  },
  colors: ['#0d6efd', '#20c997'],
  dataLabels: {
    enabled: false,
  },
  stroke: {
    curve: 'smooth',
  },
  xaxis: {
    type: 'datetime',
    categories: [
      '2023-01-01',
      '2023-02-01',
      '2023-03-01',
      '2023-04-01',
      '2023-05-01',
      '2023-06-01',
      '2023-07-01',
    ],
  },
  tooltip: {
    x: {
      format: 'MMMM yyyy',
    },
  },
};

const sales_chart = new ApexCharts(document.querySelector('#sales-chart'), sales_chart_options);
sales_chart.render();

//============================
// SPARKLINE CHART GENERATOR
//============================
function createSparklineChart(selector, data) {
  const options = {
    series: [{ data }],
    chart: {
      type: 'line',
      width: 150,
      height: 30,
      sparkline: {
        enabled: true,
      },
    },
    colors: ['var(--bs-primary)'],
    stroke: {
      width: 2,
    },
    tooltip: {
      fixed: { enabled: false },
      x: { show: false },
      y: { title: { formatter: () => '' } },
      marker: { show: false },
    },
  };

  const chart = new ApexCharts(document.querySelector(selector), options);
  chart.render();
}

const sparklineData = [
  [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54],
  [12, 56, 21, 39, 73, 45, 64, 52, 36, 59, 44],
  [15, 46, 21, 59, 33, 15, 34, 42, 56, 19, 64],
  [30, 56, 31, 69, 43, 35, 24, 32, 46, 29, 64],
  [20, 76, 51, 79, 53, 35, 54, 22, 36, 49, 64],
  [5, 36, 11, 69, 23, 15, 14, 42, 26, 19, 44],
  [12, 56, 21, 39, 73, 45, 64, 52, 36, 59, 74],
];

sparklineData.forEach((data, index) => {
  createSparklineChart(`#table-sparkline-${index + 1}`, data);
});

//===============
// PIE CHART
//===============
// const pie_chart_options = {
//   series: [700, 500, 400, 600, 300, 100],
//   chart: {
//     type: 'donut',
//   },
//   labels: ['Chrome', 'Edge', 'FireFox', 'Safari', 'Opera', 'IE'],
//   dataLabels: {
//     enabled: false,
//   },
//   colors: ['#0d6efd', '#20c997', '#ffc107', '#d63384', '#6f42c1', '#adb5bd'],
// };

// const pie_chart = new ApexCharts(document.querySelector('#pie-chart'), pie_chart_options);
// pie_chart.render();
