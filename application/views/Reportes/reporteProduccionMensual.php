<!doctype html>
<html lang="en">
<head>
	<title>REPORTE</title>
	<style>
		.titulo-1 {
		    color: #000;   
		    font-family: 'Calibri';
		    font-size: 13px;
		    text-transform: uppercase;
		    font-weight: bold;
		    float: left;
		}
		table {
		    border-collapse: collapse;
		    width: 98%;
		    margin: 0 auto;
		    margin-bottom: 10px;
		}

		#tblProduccion th,td{
			font-family: 'Calibri';
			font-size: 10px;
		    text-align: center;
		    padding: 5px 5px;
		    border: 1px solid black;
		}
		.tabla-titulo tr td {			
			border: none;
			font-size: 12px;
			text-align: center;	
		}
		.image {
			width: 15%;
			height: auto;
			padding: 5px 5px;
		}
		.contenedor {
			width: 100%;
			height: 100%;
			margin: 0 auto;
			border-radius: 2px;
			padding: 2px 2px;
		}
		tr.a1{
			background-color:#80007f;
			height: 20px;
			
		}
		tr.a2{
			background-color: #ffdc5c;
		}
		tr.a3 {
			background-color: #ffe9fe;
		}
		tr.a4 {
			background-color: #446CB3;
			
		}
		tr.a4 td {
			color: white!important;
		}
		tr td.a5{
			background-color: #C0392B;
			color: white!important;		
		}
		tr.a6 {
			background-color: #d8bfd8;
		}
		tr td.a7{
			background-color: #fdc9da;
		}
		tr td.a8{
			background-color: #ffdc5c;
		}
		tr.a9{
			background-color: #049372;
		}

		tr.a9 td {
			color: white!important;
		}
		tr.a10{
			background-color: #6C7A89;
		}
		tr.a10 td {
			color: white!important;
		}
		tr td.til {
			color: white;
			font-family: 'Calibri';
			font-size: 9px;
			font-weight: bold;
		}
	</style>
</head>
<body>
	<div class="contenedor">
			<div>
				<table class="tabla-titulo">
					<tr>
						<?php
							if ($fecha) {
							echo "
								<td width='20%'><img class='image' src='".base_url()."assets/img/logo/logoinnova.png'></td>
								<td width='60p%'><span class='titulo-1'>CONTROL DE PRODUCCIóN MENSUAL <br> PROCESO DE CONVERSIóN</span></td>
								<td width='20p%' style='text-transform: uppercase; font-weight: bold'>mes: ".$fecha."</td>";
							}
						?>
					</tr>
				</table>
			</div>
			<div style="margin: 0 auto; width: 100%; text-align: center;">
				<?php echo $grafica; ?>			
			</div><br><br>
			<table id='tblProduccion'>
				<tr class="a1">							
					<td class='til'><center><span></span></center></td>
					<td class='til'><center><span>ECO PLUS 24/1 (bols)</span></center></td>
					<td class='til'><center><span>ECO PLUS 6/4 (bol)</span></center></td>
					<td class='til'><center><span>CHOLIN 1000 8/6(bols)</span></center></td>
					<td class='til'><center><span>CHOLIN 900 (bols)</span></center></td>
					<td class='til'><center><span>GENERICO ECO 1000 (bol)</span></center></td>
					<td class='til'><center><span>GENERICO ECO 900 (bol)</span></center></td>
					<td class='til'><center><span>CHOLIN HD 32/1 (bol)</span></center></td>
					<td class='til'><center><span>Bolson  SERVILLETA</span></center></td>
					<td class='til'><center><span>CHOLIN HD Gen32/1 (bol)</span></center></td>
					<td class='til'><center><span>PAPEL FACIAL</span></center></td>
					<td class='til'><center><span>TOTAL BOLSONES DIARIO</span></center></td>
					<td class='til'><center><span>   TNS   </span></center></td>
					<td class='til'><center><span>Total bolsones x semana</span></center></td>
				</tr>
			<?php
				if ($pesos) {
					echo"<tr class='a6'>
							<td>Peso x Pres.</td>
							<td>".$pesos[0]['Peso']."</td>
							<td>".$pesos[1]['Peso']."</td>
							<td>".$pesos[2]['Peso']."</td>
							<td>".$pesos[3]['Peso']."</td>
							<td>".$pesos[4]['Peso']."</td>
							<td>".$pesos[5]['Peso']."</td>
							<td>".$pesos[6]['Peso']."</td>
							<td>".$pesos[7]['Peso']."</td>
							<td>".$pesos[8]['Peso']."</td>
							<td>".$pesos[9]['Peso']."</td>
							<td colspan='3'></td>
						</tr>";
				}
				if ($dataRpt) {
					$contRW=0; $contRW1=0; $contRW2=0; $pos=array(); $ts=array(); $vl=0; $band=true; $tdHtml=""; $tsm=0;
					$val1=0;$val2=0;$val3=0;$val4=0;$val5=0;$val6=0;$val7=0;$val8=0;$val9=0;$val10=0;
					$ttns=0;
					//USO UN FOREACH PARA CONTAR NUMERO DE ROWS(°_°)(>_<)
					foreach ($dataRpt as $vr) {
						if ($vr['v1'] == 'Total semana') {

							array_push($ts, $tsm);
							$tsm=0;

							array_push($pos, $contRW);
							$contRW=0;
						}else {
							$tsm=$tsm+$vr['v12'];
							$contRW++;
						}
					}
					
					foreach ($dataRpt as $key) {
						$ttns=$ttns+$key['v13'];						
						if ($key['v1']=='Total semana') {
							$val1=$val1+$key['v2'];
							$val2=$val2+$key['v3'];
							$val3=$val3+$key['v4'];
							$val4=$val4+$key['v5'];
							$val5=$val5+$key['v6'];
							$val6=$val6+$key['v7'];
							$val7=$val7+$key['v8'];
							$val8=$val8+$key['v9'];
							$val9=$val9+$key['v10'];
							$val10=$val10+$key['v11'];
							$val11=$val11+$key['v12'];
							$total = $val1+$val2+$val3+$val4+$val5+$val6+$val7+$val8+$val9+$val10+$val11;							
							$contRW1=0;
							$estilo='a2';
						}else {
							$contRW1++;
							$tsm=$tsm+$key['v12'];
							$estilo='a3';
						}

						if ($key['v1']=='Promedio') {
							$estilo='a2';
						}

						if ($band==true) {
							$cc=$pos[$vl]+2;
							$tdHtml="<td rowspan='".$cc."'>".number_format($ts[$contRW2], 0)."</td>";
							$band=false;
							$contRW1=$contRW1+2;
							$contRW2++;
						}elseif ($contRW1==2) {
							$vl++;
							$cc=$pos[$vl]+1;
							$tdHtml="<td rowspan='".$cc."'>".number_format($ts[$contRW2], 0)."</td>";
							$contRW2++;
						}else {
							$tdHtml="";
						}
						echo"<tr class='".$estilo."'>
								<td>".$key['v1']."</td>
								<td>".number_format($key['v2'],2)."</td>
								<td>".number_format($key['v3'],2)."</td>
								<td>".number_format($key['v4'],2)."</td>
								<td>".number_format($key['v5'],2)."</td>
								<td>".number_format($key['v6'],2)."</td>
								<td>".number_format($key['v7'],2)."</td>
								<td>".number_format($key['v8'],2)."</td>
								<td>".number_format($key['v9'],2)."</td>
								<td>".number_format($key['v10'],2)."</td>
								<td>".number_format($key['v11'],2)."</td>
								<td>".$key['v12']."</td>
								<td>".$key['v13']."</td>
								".$tdHtml."
							</tr>";
					}					
					echo "
					<tr style='border:none'>
						<td height='20'></td>
					</tr>
					<tr class='a4'>
						<td>Totales</td>
						<td>".number_format($val1, 0)."</td>
						<td>".number_format($val2, 0)."</td>
						<td>".number_format($val3, 0)."</td>
						<td>".number_format($val4, 0)."</td>
						<td>".number_format($val5, 0)."</td>
						<td>".number_format($val6, 0)."</td>
						<td>".number_format($val7, 0)."</td>
						<td>".number_format($val8, 0)."</td>
						<td>".number_format($val9, 0)."</td>
						<td>".number_format($val10, 0)."</td>
						<td>".number_format($total, 0)."</td>
						<td>".number_format($ttns, 0)."</td>
						<td>".array_sum($ts)."</td>
					</tr>";
					if ($metas) {
						$mtTotal=0;
						foreach ($metas as $key) {
							$mt1 = $key['Eco24/1'];
							$mt2 = $key['Eco6/4'];
							$mt3 = $key['Cholin_8/6'];
							$mt4 = $key['Cholin_900'];
							$mt5 = $key['Generico_Eco_1000'];
							$mt6 = $key['Generico_Eco_900'];
							$mt7 = $key['Cholin_HD_32/1'];
							$mt8 = $key['BolsonServilleta'];
							$mt9 = $key['Cholin_HD_Gen32/1'];
							$mt10 = $key['PapielFacial'];

							if ($val1!=0 && $mt1!=0) {
								$pr1 = ($val1/$mt1)*100;
							}else { $pr1 = 0; }
							if ($val2!=0 && $mt2!=0) {
								$pr2 = ($val2/$mt2)*100;
							}else { $pr2 = 0; }
							if ($val3!=0 && $mt3!=0) {
								$pr3 = ($val3/$mt3)*100;
							}else { $pr1 = 0; }
							if ($val4!=0 && $mt4!=0) {
								$pr4 = ($val4/$mt4)*100;
							}else { $pr4 = 0; }
							if ($val5!=0 && $mt5!=0) {
								$pr5 = ($val5/$mt5)*100;
							}else { $pr5 = 0; }
							if ($val6!=0 && $mt6!=0) {
								$pr6 = ($val6/$mt6)*100;
							}else { $pr6 = 0; }
							if ($val7!=0 && $mt7!=0) {
								$pr7 = ($val7/$mt7)*100;
							}else { $pr7 = 0; }
							if ($val8!=0 && $mt8!=0) {
								$pr8 = ($val8/$mt8)*100;
							}else { $pr8 = 0; }
							if ($val9!=0 && $mt9!=0) {
								$pr9 = ($val9/$mt9)*100;							
							}else { $pr9 = 0; }
							if ($val10!=0 && $mt10!=0) {
								$pr10 = ($val10/$mt10)*100;
							}else { $pr10 = 0; }


							$mtTotal = $mt1+$mt2+$mt3+$mt4+$mt5+$mt6+$mt7+$mt8+$mt9+$mt10;
							echo "
							<tr class='a9'>
								<td>Meta Prod.</td>
								<td>".number_format($mt1,2)."</td>
								<td>".number_format($mt2,2)."</td>
								<td>".number_format($mt3,2)."</td>
								<td>".number_format($mt4,2)."</td>
								<td>".number_format($mt5,2)."</td>
								<td>".number_format($mt6,2)."</td>
								<td>".number_format($mt7,2)."</td>
								<td>".number_format($mt8,2)."</td>
								<td>".number_format($mt9,2)."</td>
								<td>".number_format($mt10,2)."</td>
								<td></td>
								<td></td>
								<td>".number_format($mtTotal,2)."</td>							
							</tr>
							<tr class='a10'>
								<td>%</td>
								<td>".number_format($pr1,2)."</td>
								<td>".number_format($pr2,2)."</td>
								<td>".number_format($pr3,2)."</td>
								<td>".number_format($pr4,2)."</td>
								<td>".number_format($pr5,2)."</td>
								<td>".number_format($pr6,2)."</td>
								<td>".number_format($pr7,2)."</td>
								<td>".number_format($pr8,2)."</td>
								<td>".number_format($pr9,2)."</td>
								<td>".number_format($pr10,2)."</td>
								<td></td>
								<td></td>
								<td>".floatval(number_format((array_sum($ts)/$mtTotal)*(100), 0))."%</td>
							</tr>
							<tr class='a3'>
								<td class='a5'>Falta x pr.</td>
								<td class='a5'>".number_format(($mt1-$val1),0)."</td>
								<td class='a5'>".number_format(($mt2-$val2),0)."</td>
								<td class='a5'>".number_format(($mt3-$val3),0)."</td>
								<td class='a5'>".number_format(($mt4-$val4),0)."</td>
								<td class='a5'>".number_format(abs(($mt5-$val5)),0)."</td>
								<td class='a5'>".number_format(abs(($mt6-$val6)),0)."</td>
								<td class='a5'>".number_format(abs(($mt7-$val7)),0)."</td>
								<td class='a5'>".number_format(($mt8-$val8),0)."</td>
								<td class='a5'>".number_format(($mt9-$val9),0)."</td>
								<td class='a5'>".number_format(($mt10-$val10),0)."</td>
								<td></td>
								<td></td>
								<td></td>
							</tr>";

							if ($porCump) {
								echo "
							<tr class='a3' >
								<td colspan='10'></td>
								<td>Estimado</td>
								<td>".floatval(number_format($porCump[0]['Porcentaje_Estimado'],0))."%</td>
								<td>Cumplido</td>
								<td>".floatval(number_format($porCump[0]['Porcentaje_Real'],0))."%</td>
							</tr>
							</table>";
							}						
						}						
					}
				} ?>
				</tbody>
			</table><br><br>
		</div>
	</body>
</html>