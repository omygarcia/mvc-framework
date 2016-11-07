<?php
echo session_id();
?>
<h1>Bienvenido: <?=$session->miNombre;?></h1>

<h3>Cambiar mi password:</h3>
<!--<form action="<?=BASE_URL;?>cuentas/changeMyPassword" method="post">-->
<?=Form::open(["action"=>BASE_URL."cuentas/changeMyPassword","method"=>"POST"]);?>
<?=Form::csrf_field();?>
<label>Introduce tu password</label>
<input type="password" name="txt_pw" />
<label>Intrioduce tu nuevo password</label>
<input type="password" name="txt_new_pw" />
<input type="submit" />
</form>
    <script type="text/javascript" src="<?=BASE_URL;?>temas/js/googlechart/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Work',     11],
          ['Eat',      2],
          ['Commute',  2],
          ['Watch TV', 2],
          ['Sleep',    7]
        ]);

        var options = {
          title: 'My Daily Activities',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
    <div id="piechart_3d" style="width: 100%; min-height: 500px;"></div>
