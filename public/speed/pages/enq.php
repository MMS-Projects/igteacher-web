<h1>Enquête</h1>
<?php 
	echo text(2);
?>
<br />
<br />
<style>
	table{
		width:600px;
	}
	th{
		border:0;
	}
	td{
		border:0;
		border-bottom:1px solid #195724;
	}
</style>

<table>
	<th>
		<strong>Algemene gegevens</strong>
	</th>
	<th>
	</th>
	<tr>
		<td>
			E-mail
		</td>
		<td>
			<input type="text" name="email" />
		</td>
	</tr>
	<tr>
		<td>
			Spelersnaam
		</td>
		<td>
			<input type="text" name="username" />
		</td>
	</tr>
	<tr>
		<td>
			Skype
		</td>
		<td>
			<input type="text" name="skype" />
		</td>
	</tr>
	<th>
		<strong>Speedgegevens</strong>
	</th>
	<th>
	</th>
	<tr>
		<td>
			Dag
		</td>
		<td>
			<input type="checkbox" name="maandag" />Maandag<br />
			<input type="checkbox" name="dinsdag" />Dinsdag<br />
			<input type="checkbox" name="woensdag" />Woensdag <br />
			<input type="checkbox" name="donderdag" />Donderdag<br />
			<input type="checkbox" name="vrijdag" />Vrijdag <br />
			<input type="checkbox" name="zaterdag" />Zaterdag <br />
			<input type="checkbox" name="zondag" />Zondag <br />	
		</td>
	</tr>
	<tr>
		<td>
			Dagdeel
		</td>
		<td>
			<input type="checkbox" name="voormiddag" />Voormiddag<br />
			<input type="checkbox" name="namiddag" />Namiddag<br />
			<input type="checkbox" name="avond" />Avond<br />	
		</td>
	</tr>
</table>
<input type="submit" name="submit" value="Verzenden" />

<br />