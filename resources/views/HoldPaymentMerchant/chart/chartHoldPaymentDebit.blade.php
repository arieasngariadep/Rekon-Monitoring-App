<style>
    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 310px;
        max-width: 800px;
        margin: 1em auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #ebebeb;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }
</style>

<?php
    $transWil = [];
    $opened = [];
    $closed = [];
    // for column that has index
    if(!empty($transaksiWilDeb)){
        foreach($transaksiWilDeb as $key) {
        $transWil[] = $key->nama_wilayah;
        $opened[] = $key->jumlah_open;
        $closed[] = $key->jumlah_closed;
    }; 
    }
    
?>
<script>
  Highcharts.chart('chartHoldPaymentDeb', {
        chart: {
            type: 'column',
            options3d: {
                enabled: true,
                alpha: 45
            }
        },
        title: {
            text: 'Data Transaksi Tolakan Perwilayah'
        },
        subtitle: {
            text: 'Debit'
        },
        xAxis: {
            title: {
                text:'Wilayah'
            },
            categories: 
            @json($transWil)
        },
        yAxis: {
            title: {
                text:'Transaksi'
            },
        },
        series: [{
            name: 'Open',
            data: 
            @json($opened)
        },{
            name:'Closed',
            data: 
            @json($closed)
        }]
    });
</script>