


<?php $__env->startPush('extra-links'); ?>
<?php $__env->stopPush(); ?>


<?php $__env->startPush('extra-scripts'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <header class="pb-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
                <span class="fs-4">Statistiques des conges du service</span>
            </a>
        </header>


        <div class="row align-items-md-stretch mb-4">
            <div class="col-md-4">
                <div class="h-100 p-5 text-white bg-dark rounded-3">
                    <h2>Change the background</h2>

                </div>
            </div>
            <div class="col-md-4">
                <div class="h-100 p-5 bg-light border rounded-3">
                    <h2>Add borders</h2>

                </div>
            </div>
            <div class="col-md-4">
                <div class="h-100 p-5 bg-light border rounded-3">
                    <h2>Add borders</h2>

                </div>
            </div>
        </div>


        <div class="p-0 p-lg-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-5">
                <div class="container-fluid">
                    <canvas id="stacked_month_chart" width="" height="">

                    </canvas>
                </div>
            </div>
        </div>

        <div class="row align-items-md-stretch">
            <div class="col-md-6">
                <div class="h-100 p-5 text-white bg-dark rounded-3">
                    <h2>Change the background</h2>
                    <p>Swap the background-color utility and add a `.text-*` color utility to mix up the jumbotron look.
                        Then, mix and match with additional component themes and more.</p>
                    <button class="btn btn-outline-light" type="button">Example button</button>
                </div>
            </div>
            <div class="col-md-6">
                <div class="h-100 p-5 bg-light border rounded-3">
                    <h2>Add borders</h2>
                    <p>Or, keep it light and add a border for some added definition to the boundaries of your content. Be
                        sure to look under the hood at the source HTML here as we've adjusted the alignment and sizing of
                        both column's content for equal-height.</p>
                    <button class="btn btn-outline-secondary" type="button">Example button</button>
                </div>
            </div>
        </div>

        <footer class="pt-3 mt-4 text-muted border-top">
            &copy; 2021
        </footer>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('extra-js'); ?>
    <script>
        const MONTHS = [
            'January',
            'February',
            'March',
            'April',
            'May',
            'June',
            'July',
            'August',
            'September',
            'October',
            'November',
            'December'
        ];


        const CHART_COLORS = {
            red: 'rgb(255, 99, 132)',
            orange: 'rgb(255, 159, 64)',
            yellow: 'rgb(255, 205, 86)',
            green: 'rgb(75, 192, 192)',
            blue: 'rgb(54, 162, 235)',
            purple: 'rgb(153, 102, 255)',
            grey: 'rgb(201, 203, 207)'
        };

        const NAMED_COLORS = [
            CHART_COLORS.red,
            CHART_COLORS.orange,
            CHART_COLORS.yellow,
            CHART_COLORS.green,
            CHART_COLORS.blue,
            CHART_COLORS.purple,
            CHART_COLORS.grey,
        ];

        const DATA_COUNT = 12;
        const NUMBER_CFG = {
            count: DATA_COUNT,
            min: 0,
            max: 24
        };

        const labels = MONTHS;
        const data = {
            labels: labels,
            datasets: [{
                    label: 'Dataset 1',
                    data: [12, 2, 5, 2.5, 1, 6, 15, 3, 3.5, 7, 1, 0],
                    backgroundColor: CHART_COLORS.red,
                },
                {
                    label: 'Dataset 2',
                    data: [2, 5, 2.5, 1, 6, 15, 3, 3.5, 7, 1, 0, 12],
                    backgroundColor: CHART_COLORS.blue,
                },
                {
                    label: 'Dataset 3',
                    data: [5, 2.5, 1, 6, 15, 3, 3.5, 7, 1, 0, 12, 2],
                    backgroundColor: CHART_COLORS.purple,
                },
            ]
        };




        const config = {
            type: 'bar',
            data: data,
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Chart.js Bar Chart - Stacked'
                    },
                },
                responsive: true,
                scales: {
                    x: {
                        stacked: true,
                    },
                    y: {
                        stacked: true
                    }
                }
            }
        };


        // const actions = [
        // {
        //     name: 'Randomize',
        //     handler(chart) {
        //     chart.data.datasets.forEach(dataset => {
        //         dataset.data = Utils.numbers({count: chart.data.labels.length, min: -100, max: 100});
        //     });
        //     chart.update();
        //     }
        // },
        // ];


        // display the chart
        const month_chart_element = $('#stacked_month_chart');
        const month_chart = new Chart(
            month_chart_element,
            config
        );
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\Stevy\Etudes\Projets\Stage_upskill\Laravel\conge\resources\views/manager/stats_conges_manager.blade.php ENDPATH**/ ?>