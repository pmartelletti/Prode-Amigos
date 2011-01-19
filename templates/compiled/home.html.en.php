<script type="text/javascript">
	$(document).ready(function(){
		$("#realizaApuesta").button().click(function(){
			var datos = $("#apuestaForm").serializeArray();
			$.post("index.php?action=realizarApuesta", datos, function(response){
				$("body").append("<div id='res_apuesta'></div>");
				$("#res_apuesta").html(response.statusMsg).dialog({
					title: "Ingresar Apuesta",
					buttons: {
						Ok: function(){
							$(this).dialog("close").remove();
							setTimeout('window.location = "index.php"', 1000);
						}
					}
				});
			}, "json");
			
		});
	})
</script>
<h5>Hola, <?php echo htmlspecialchars($t->usuario);?>!</h5>

<h4>Torneo en curso: <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'getProperty'))) echo htmlspecialchars($t->getProperty($t->torneoActual,"to_nombre"));?></h4>

<h3>Próxima fecha / juego</h3>

<form id="apuestaForm" action="#">
	<table id="proxima_fecha">
		<thead>
			<tr>
				<td colspan="5" style="text-align:right;">Fecha Nº: <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'getProperty'))) echo htmlspecialchars($t->getProperty($t->fecha_actual,"fe_nombre"));?> - Del <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'getFechaArgentina'))) echo htmlspecialchars($t->getFechaArgentina($t->fecha_actual,"fe_fecha_inicio"));?> al <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'getFechaArgentina'))) echo htmlspecialchars($t->getFechaArgentina($t->fecha_actual,"fe_fecha_fin"));?></td>
			</tr>
			<tr>
				<th></th>
				<th>LOCAL</th>
				<th>EMPATE</th>
				<th>VISITANTE</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php if ($t->apuestaUsuario)  {?>
			<?php if ($this->options['strict'] || (is_array($t->listaPartidos)  || is_object($t->listaPartidos))) foreach($t->listaPartidos as $partido) {?><tr>
				<td style="width:20px; text-align:center;"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'esApuesta'))) if ($t->esApuesta($partido,"L")) { ?>X<?php }?></td>
				<td><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'getProperty'))) echo htmlspecialchars($t->getProperty($partido,"_ap_par_id._par_local_eq_id.eq_nombre"));?></td>
				<td style="width:20px; text-align:center;"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'esApuesta'))) if ($t->esApuesta($partido,"E")) { ?>X<?php }?></td>
				<td><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'getProperty'))) echo htmlspecialchars($t->getProperty($partido,"_ap_par_id._par_visitante_eq_id.eq_nombre"));?></td>
				<td style="width:20px; text-align:center;"><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'esApuesta'))) if ($t->esApuesta($partido,"V")) { ?>X<?php }?></td>
			</tr><?php }?>
			<?php } else {?>
			<?php if ($this->options['strict'] || (is_array($t->listaPartidos)  || is_object($t->listaPartidos))) foreach($t->listaPartidos as $partido) {?><tr>
				<td><input type="radio" name="ap_ganador[<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'getProperty'))) echo htmlspecialchars($t->getProperty($partido,"par_id"));?>]" value="L"></td>
				<td><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'getProperty'))) echo htmlspecialchars($t->getProperty($partido,"_par_local_eq_id.eq_nombre"));?></td>
				<td><input type="radio" name="ap_ganador[<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'getProperty'))) echo htmlspecialchars($t->getProperty($partido,"par_id"));?>]" value="E"></td>
				<td><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'getProperty'))) echo htmlspecialchars($t->getProperty($partido,"_par_visitante_eq_id.eq_nombre"));?></td>
				<td><input type="radio" name="ap_ganador[<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'getProperty'))) echo htmlspecialchars($t->getProperty($partido,"par_id"));?>]" value="V"></td>
			</tr><?php }?>
			<?php }?>
		</tbody>
	</table>
	
	<?php if ($t->apuestaUsuario)  {?>
	<p style="text-align:right; margin-top: 10px" class="success">Ya realizaste tu apuesta para esta fecha.</p>
	<?php } else {?>
	<p style="text-align:right; margin-top: 10px"><b>Fin de la apuesta: </b> <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'getFechaArgentina'))) echo htmlspecialchars($t->getFechaArgentina($t->fecha_actual,"fe_fecha_fin_apuesta"));?> </p>
	<p style="text-align:center;"><?php echo $this->elements['realizaApuesta']->toHtml();?></p>
	<?php }?>
</form>

<p class="nota"><b>Nota: </b>La tarjeta de resultados debe ser ingresada, al menos, 1 hora antes del inicio del primer partido de la fecha.
En caso de no ingresarla, la misma no será contabilizada y se le asignarán 0 puntos al usuario en la fecha correspondiente.</p>

<div id="fecha_pasada" class="success">
	<h3>Fecha Anterior: N° <?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'getProperty'))) echo htmlspecialchars($t->getProperty($t->fechaAnterior,"fe_nombre"));?></h3>
	<p><b>Puntos ganados: </b><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'getProperty'))) echo htmlspecialchars($t->getProperty($t->fechaAnterior,"puntosGanados"));?></p>
	<p><b>Posicion en la fecha: </b><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'getProperty'))) echo htmlspecialchars($t->getProperty($t->fechaAnterior,"posicionFecha"));?></p>
	<p><b>Posición actual en el torneo: </b><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'getProperty'))) echo htmlspecialchars($t->getProperty($t->torneoActual,"posicionTorneo"));?></p>
</div>