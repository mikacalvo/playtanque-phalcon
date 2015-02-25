{{ elements.getHeader(1) }}

<div id="content">
	<div class="zero scroll-h">
		{{ flashSession.output() }}
		<div id="consolante" class="concours">
			<div id="tour0" class="tour w200p pam mas scroll-v" data-id="0"></div>
			<div id="tournoiA" class="tournoi mid up" data-id="A"></div>
			<div id="tournoiB" class="tournoi mid down" data-id="B"></div>
		</div>

		<div id="inter" class="concours">
			<input type="hidden" id="typeInter"/>
			<div class="inbl" style="height:100%;">
				<div id="repartition" class="pam mas scroll-v">
					<table id="tableauRepartition" class="striped" summary="Répartition des joueurs">
						<thead>
							<tr>
								<th scope="col" class="txtcenter">Tireurs</th>
								<th scope="col" class="txtcenter">Milieux</th>
								<th scope="col" class="txtcenter">Pointeurs</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>
									<ul id="tireurs" class="sortable unstyled man inbl">
									</ul>
								</td>
								<td>
									<ul id="milieux" class="sortable unstyled man inbl">
									</ul>
								</td>
								<td>
									<ul id="pointeurs" class="sortable unstyled man inbl">
									</ul>
								</td>
							</tr>
						</tbody>
					</table>
					<label for="nbTours" class="man inbl no-print">Nombre de parties</label>
					<select id="nbTours" class="inbl no-print">
						<option val="1">1</option>
						<option val="2">2</option>
						<option val="3" selected="selected">3</option>
						<option val="4">4</option>
						<option val="5">5</option>
					</select>
					<button class="inbl genere no-print">Générer</button>
					<div id="liste"></div>
				</div>
			</div>
			<div id="scores" class="w400p pam mas inbl scroll-v">
				<table id="classementIS" class="striped tablesorter" summary="Scores des joueurs" style="table-layout:auto;">
					<thead>
						<tr>
							<th colspan="6" class="txtcenter big">Points</th>
						</tr>
						<tr>
							<th scope="col" class="txtcenter" style="width: 30%">Joueurs</th>
							<th scope="col" class="txtcenter" style="width: 10%">P</th>
							<th scope="col" class="txtcenter" style="width: 10%">C</th>
							<th scope="col" class="txtcenter" style="width: 10%">Diff</th>
							<th scope="col" class="txtcenter" style="width: 10%">G</th>
							<th scope="col" class="txtcenter" style="width: 30%">Total</th>
						</tr>
					</thead>
					<tbody class="datas">
						<tr>
							<td>
							</td>
							<td>
							</td>
							<td>
							</td>
							<td>
							</td>
							<td>
							</td>
							<td>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>