<!DOCTYPE html>
<html lang="pt-BR"  ng-app="app">
  <head>
    <meta charset="UTF-8">
    <title>Cadastrar Consórcio | Solução e Cia</title>
    <!-- Import CSS Styles    -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

    <link href="lib/css/Template.css" rel="stylesheet">
    <link href="lib/css/consorcios.css" rel="stylesheet">
	<!-- Import JS    -->
	<script src="lib/js/jquery.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="lib/js/angular/angular.js"></script>
    <script src="lib/js/app.js"></script>
	<script src="lib/js/template.js"></script>
    <script src="lib/js/consorcios.js"></script>
	<script src="lib/js/bootstrap.js"></script>
	<script src="lib/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<!-- Styles In Line    -->
   <script>
    $( document ).ready(function() {
        var slider = document.getElementById("nav-slide");
        var slider2 = document.getElementById("log-header");
                    slider.style.marginLeft = "0px";
            slider2.style.marginLeft = "0px";
    });
  </script>
  </head>
  <body>
    <header class="nav-header">
        <div class="log-header" id="log-header">
            <img class="img-log-header" id="logo_top" src="#" alt="img_logo">
        </div><!-- Final LOGO HEADER -->
        <div class="nav-header-Top" >
            <ul>
                <li><a href="#" onclick="slidetoggle()"><span class="glyphicon glyphicon-align-justify"></span></a></li>
            </ul>
            <ul class="list-menu">
                <li><a href="#"><span class="glyphicon glyphicon-comment"></span></a></li>
                <li><a href="#"><span class="glyphicon glyphicon-bell"></span></a></li>
                <li><a href="#"><span class="glyphicon glyphicon-user"></span></a></li>
                <li><a href="#"><span class="glyphicon glyphicon-off"></span></a></li>
            </ul>
        </div><!-- Final Nav Top -->
    </header><!-- Final Header -->
    <section class="container_geral"   >
        <section class="menu-lateral" id="nav-slide">
            <div class="profile" id="profile">
                <div class="profile-foto"><img src="lib/profile/claudio.santos.jpg"></div>
                <div class="profile-dados" id="profileDados">
                    <span class="nome">Claudio Vinicius Oliveira</span><br>
                    <span class="perfil">Administrador Master</span>
                </div>
            </div> <!-- Final DIV Profile -->
            <div class="nav-lateral" >
				<ul>
 					<li class="active"><a href="home.php"><span class="glyphicon glyphicon-home"></span><span>Home</span></a></li>
					<li><a href="#"><span class="glyphicon glyphicon-dashboard"></span><span>DashBoard</span></a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-dashboard"></span><span>Consórcios</span></a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-dashboard"></span><span>Capital de Giro</span></a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-dashboard"></span><span>Títulos de Capitalização</span></a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-download-alt"></span><span>Relatórios</span></a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span><span>Usuários</span></a></li>
				</ul>
            </div>
        </section><!-- Final Menu-Lateral -->
        <section class="conteiner-body-geral"  ng-controller="consorciosCtrl">
            <section class="conteiner-body-color">

                <ol class="breadcrumb" style="font-size:8pt; background-color:none;">
                    <li><a href="#">Home</a></li>
                    <li class="active"><a href="#">Consórcios</a></li>
                <ol>
                <h2 class="tituloPagina">Consórcios</h2>
                <div class="cartoesResumo"> <!-- Cartões Resumo -->
                    <?php
                        include 'cmd/conn.php';

                        $cacheConsorcios = "Select Count(*) As Qtd, Sum(ValorBem) As Valor From consorcios";
                        $cacheConsorcios = mysql_query($cacheConsorcios) or die ("<script>console.log('Erro em Query cacheQtdConsorcios')</script>") ;
                        $cacheConsorcios = mysql_fetch_object($cacheConsorcios);

                        $cacheContemplados = "Select Count(*) As Qtd, Sum(ValorBem) As Valor From consorcios Where idStatusConsorcio = 2";
                        $cacheContemplados = mysql_query($cacheContemplados) or die ("<script>console.log('Erro em Query cacheContemplados')</script>") ;
                        $cacheContemplados = mysql_fetch_object($cacheContemplados);

                        $cacheNaoUtilizados = "Select Count(*) As Qtd, Sum(ValorBem) As Valor From consorcios Where idStatusConsorcio = 2 and bemAdiquirido = ''";
                        $cacheNaoUtilizados = mysql_query($cacheNaoUtilizados) or die ("<script>console.log('Erro em Query cacheNaoUtilizados')</script>") ;
                        $cacheNaoUtilizados = mysql_fetch_object($cacheNaoUtilizados);

                        $cacheUtilizados = "Select Count(*) As Qtd, Sum(ValorBem) As Valor From consorcios Where idStatusConsorcio = 2 and bemAdiquirido <> ''";
                        $cacheUtilizados = mysql_query($cacheUtilizados) or die ("<script>console.log('Erro em Query cacheNaoUtilizados')</script>") ;
                        $cacheUtilizados = mysql_fetch_object($cacheUtilizados);

                        $percContemplados = ($cacheContemplados->Qtd / $cacheConsorcios->Qtd) * 100;
                        $percUtilizados = ($cacheUtilizados->Qtd / $cacheContemplados->Qtd) * 100;

                    ?>
                    <ul class="ulCartoes">
                        <li class="liCartoes">
                            <div class="cartao" id="cartao-azul">
                                <div class="caixaIcon" id="icon-qtd-consorcios"><span class="glyphicon glyphicon-file"></span></div>
                                <div class="divValores">
                                    <ul>
                                        <li class="liTitulo">CONSÓRCIOS</li>
                                        <li class="liValor"><?php echo $cacheConsorcios->Qtd; ?></li>
                                        <li class="liSubValor"><?php echo "R$ ".number_format($cacheConsorcios->Valor,'0',',','.'); ?></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="liCartoes">
                            <div class="cartao" id="cartao-verde">
                                <div class="caixaIcon" id="icon-qtd-consorcios"><span class="glyphicon glyphicon-thumbs-up"></span></div>
                                <div class="divValores">
                                    <ul>
                                        <li class="liTitulo">CONTEMPLADOS</li>
                                        <li class="liValor"><?php echo $cacheContemplados->Qtd; ?><span class="percentual"><?php echo " (".number_format($percContemplados,0).'%)'; ?></span></li>
                                        <li class="liSubValor"><?php echo "R$ ".number_format($cacheContemplados->Valor,'0',',','.'); ?></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="liCartoes">
                            <div class="cartao" id="cartao-laranja">
                                <div class="caixaIcon" id="icon-qtd-consorcios"><span class="glyphicon glyphicon-usd"></span></div>
                                <div class="divValores">
                                    <ul>
                                        <li class="liTitulo">QTD. NÃO UTILIZADOS</li>
                                        <li class="liValor"><?php echo $cacheNaoUtilizados->Qtd; ?><span class="percentual"><?php echo " (".number_format((100-$percUtilizados),0).'%)'; ?></span></li>
                                        <li class="liSubValor"><?php echo "R$ ".number_format($cacheNaoUtilizados->Valor,'0',',','.'); ?></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <li class="liCartoes">
                            <div class="cartao" id="cartao-vermelho">
                                <div class="caixaIcon" id="icon-qtd-consorcios"><span class="glyphicon glyphicon-thumbs-down"></span></div>
                                <div class="divValores">
                                    <ul>
                                        <li class="liTitulo">QTD. UTILIZADOS</li>
                                        <li class="liValor"><?php echo $cacheUtilizados->Qtd; ?><span class="percentual"><?php echo " (".number_format(($percUtilizados),0).'%)'; ?></span></li>
                                        <li class="liSubValor"><?php echo "R$ ".number_format($cacheUtilizados->Valor,'0',',','.'); ?></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div> <!-- Final Cartões Resumo -->
                <div class="box-tabela-consorcios">

                    <div class="box-title">Consórcios
                        <div class="box-pesquisa"><label><span class="glyphicon glyphicon-search"></span></label><input type="text" ng-model="criteria2" class="inptPesquisa"></div>
                    </div>
                    <div class="box-tabela"  >
                        <table id="tabelac" class="table table-sm">
                            <thead>
                                <th></th>
                                <th>Tipo</th>
                                <th>Grupo/Cota</th>
                                <th>Titular</th>
                                <th style="text-align:center"># Parcela</th>
                                <th style="text-align:center">% Pago</th>
                                <th style="text-align:center">Vlr Quitação</th>
                                <th style="text-align:center">Vlr Bem</th>
                                <th style="text-align:center">Status</th>
                                <th style="text-align:center"></th>

                            </thead>
                            <tbody ng-repeat="consorcio in consorcios | filter:criteria |filter:criteria2" >
                                <tr class="lin-info" >
                                    <td><a href="#" class="setaExpandir" id="{{consorcio.grupo  + consorcio.cota}}" onclick="slideTable(this.id)"  ><span id="{{'span' + consorcio.grupo  + consorcio.cota}}" class="glyphicon glyphicon-chevron-down"></span></a></td>
                                    <td>{{consorcio.descricaoTipo}}</td>
                                    <td>{{consorcio.grupo + "/" + consorcio.cota}}</td>
                                    <td>{{consorcio.titular}}</td>
                                    <td style="text-align:center">{{consorcio.numParcela}}</td>
                                    <td style="text-align:center">{{consorcio.percPago}}</td>
                                    <td style="text-align:center">{{consorcio.vlrQuitacao}}</td>
                                    <td style="text-align:center">{{consorcio.vlrBem}}</td>
                                    <td style="text-align:center"><span class="{{consorcio.classe}}">{{consorcio.status}}</span> | <span class="{{consorcio.classeUso}}">{{consorcio.statusUso}}</span></td>
                                    <td></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>


        <div id="donutchart" style="width: 300px;height:300px;"></div>
        <?php
        include 'cmd/conn.php';
                    $qryCacheQtdImoveis = "Select Count(*) As Qtd From consorcios Where idTipoConsorcio = 2";
                    $qryCacheQtdImoveis = mysql_query($qryCacheQtdImoveis) or die ("<script>console.log('Erro em Query qryCacheQtdImoveis')</script>");
                    $qryCacheQtdImoveis = mysql_fetch_array($qryCacheQtdImoveis);
                    $qryCacheQtdAutomoveis = "Select Count(*) As Qtd From consorcios Where idTipoConsorcio = 1";
                    $qryCacheQtdAutomoveis = mysql_query($qryCacheQtdAutomoveis) or die ("<script>console.log('Erro em Query qryCacheQtdImoveis')</script>");
                    $qryCacheQtdAutomoveis = mysql_fetch_array($qryCacheQtdAutomoveis);
        echo "
        <script type='text/javascript'>

            google.charts.load('current', {packages:['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([

                ['Task', 'Hours per Day'],";
        echo    "['Imóvel',".$qryCacheQtdImoveis[0]."],";
        echo    "['Automóvel',".$qryCacheQtdAutomoveis[0]."]]);";

        echo "
                var options = {
                title: '% por Tipo',
                titleTextStyle: {color: '#898989',fontName: 'Segoe UI',fontSize: 10,bold: true,position: 'center'},
                pieHole: 0.65,
                pieSliceText: 'none',
                pieSliceTextStyle: {color: 'black',fontName:  'Segoe UI'},
                toltip:{textStyle: {color: '#FF0000'}, showColorCode: true},
                legend: {position: 'top', textStyle: {color: '#898989', fontSize: 8}},
                slices: {0: {color: '#00C0EF'}, 1: {color: '#00A65A'}}
                };

                var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                chart.draw(data, options);
            }
        </script>";
        ?>
            </section><!-- Final Body Color -->
            <section class="conteiner-body-white">

            </section><!-- Final Body White -->
        </section><!-- Final Body Geral -->
    </section><!-- Final Container Geral -->

  </body>
</html>
