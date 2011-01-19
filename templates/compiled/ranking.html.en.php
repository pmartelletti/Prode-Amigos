<script type="text/javascript">
	$(document).ready(function(){
		$("#tabs").tabs();
	})
</script>
<div id="tabs">
	<ul>
		<li><a href="#fecha">Ranking de la Fecha</a></li>
		<li><a href="#general">Ranking General</a></li>
	</ul>
	
	<div id="fecha">
		
		<table id="tableFecha">
			<thead>
				<tr>
					<th>Posicion</th>
					<th>Usuario</th>
					<th>Puntos</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($this->options['strict'] || (is_array($t->equiposFechaActual)  || is_object($t->equiposFechaActual))) foreach($t->equiposFechaActual as $pos => $object) {?><tr>
					<td><?php echo htmlspecialchars($pos);?></td>
					<td><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'getProperty'))) echo htmlspecialchars($t->getProperty($object,"_ap_us_id.us_nombre"));?> (<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'getProperty'))) echo htmlspecialchars($t->getProperty($object,"_ap_us_id.us_login"));?>)</td>
					<td><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'getProperty'))) echo htmlspecialchars($t->getProperty($object,"ap_puntaje"));?></td>
				</tr><?php }?>
			</tbody>
		</table>

	</div>
	
	<div id="general">
		
		<table id="tableGeneral">
			<thead>
				<tr>
					<th>Posicion</th>
					<th>Usuario</th>
					<th>Puntos</th>
				</tr>
			</thead>
			<tbody>
				<?php if ($this->options['strict'] || (is_array($t->equiposTorneo)  || is_object($t->equiposTorneo))) foreach($t->equiposTorneo as $pos => $object) {?><tr>
					<td><?php echo htmlspecialchars($pos);?></td>
					<td><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'getProperty'))) echo htmlspecialchars($t->getProperty($object,"_ap_us_id.us_nombre"));?> (<?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'getProperty'))) echo htmlspecialchars($t->getProperty($object,"_ap_us_id.us_login"));?>)</td>
					<td><?php if ($this->options['strict'] || (isset($t) && method_exists($t, 'getProperty'))) echo htmlspecialchars($t->getProperty($object,"ap_puntaje"));?></td>
				</tr><?php }?>
			</tbody>
		</table>
		
	</div>
	
</div>