<?php
include(APPPATH."libraries\googchart\GoogChart.class.php");
	if ($porCump) {
		$cumplido=floatval(number_format($porCump[0]['Porcentaje_Real'],0));
		$falta=100-floatval(number_format($porCump[0]['Porcentaje_Real'],0)); 					
		
		$chart = new GoogChart();
		
		$dataMultiple = array(
			'Cumplido: '.$cumplido.'%' => $cumplido,
			'Restante: '.$falta.'%' => $falta,
		);

		$color = array(
					'#5090d0',
					'#EC644B',
					'#eb702c',
				);

		$chart->setChartAttrs( array(
			'type' => 'pie',
			'title' => 'Cumplimiento mensual %',
			'data' => $dataMultiple,
			'size' => array( '500', '300' ),
			'color' => $color,
			'legend' => true,
			'labelsXY' => true,			
			'fill' => array( '#eeeeee', '#aaaaaa' ),
			//'background' => '#ECF0F1',
			)
		);

		echo $chart;	
	}
?>
