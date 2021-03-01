<div
        x-data="{chart:null}"
        x-init="chart =
        new Chartisan({
            el: '#login-chart',
            url: '@chart('login_chart')',
            hooks: new ChartisanHooks()
                .datasets('line')
                .tooltip()
                .legend()
        });
    "
>

    <div>
        <button
                x-on:click="chart.update()"
                type="button" class="px-4 py-2 mr-6 rounded rounded-md bg-blue-700 text-white border-2 shadow-lg "><i
                    class="fas fa-sync"></i></button>
    </div>
    Current time: {{ now() }}
<!-- Login Chart's container -->
    <div id="login-chart" style="height: 300px;"></div>

</div>