<nav id="teamManagement" class="toolbar b-darker-gray light-gray top-border no-print">
    <a id="show" class="pas">
		<i class="fa fa-chevron-right fa-2x inbl"></i>
    </a>
	<div class="full">
        <div class="zero scroll-v">
		    <a id="hide" class="tiny-hidden row pals">
				<i class="fa fa-angle-double-left inbl"></i>
		    </a>
		    <div id="typeTournoi" class="col pals">
		      <div class="mod">
		        <span id="Consolante" data-div="consolante" class="navspan h5-like restart">
		          <i class="fa fa-sitemap mash"></i>
		          <strong class="small-hidden tiny-hidden">Consolante</strong>
		        </span>
		      </div>
		      <div class="mod">
		        <span id="Inter" data-div="inter" class="navspan h5-like dynamic">
		          <i class="fa fa-users mash"></i>
		          <strong class="small-hidden tiny-hidden">Mêlée</strong>
		        </span>
		      </div>
		      <div class="mod">
		        <span id="Point" data-div="inter" class="navspan h5-like">
		          <i class="fa fa-flag mash"></i>
		          <strong class="small-hidden tiny-hidden">Points</strong>
		        </span>
		      </div>
		    </div>
	        <div class="icon-input dark-gray mas" style="margin-bottom:0;">
	          <input type="text" id="teaminput" class="sharp inboxshadow b-dark-gray pas par" placeholder="Ajouter des joueurs" />
	          <i class="fa fa-plus fa-2x tiny-hidden" id="addteam"></i>
	          <i class="fa fa-plus fa-2x small-hidden medium-hidden large-hidden" id="addteam-mobile"></i>
	        </div>
	        <div class="row tiny-hidden">
	          <span id="nbEquipes" class="bold right">0 <span>équipes</span></span>
	        </div>
	        <div id="teams" class="pals">
	          <ul id="teamlist" class="unstyled pan datalist"></ul>
	        </div>
        </div>
    </div>
    <a id="startConcours" class="row">
      <i class="fa fa-random fa-2x inbl"></i>
      <label class="tiny-hidden man inbl">Tirage</label>
    </a>
</nav>
<article id="content-body">
	<?php echo $this->flashSession->output(); ?>
	<div id="consolante" class="full concours">
		<div class="zero scroll-v">
			<div id="tour0" class="tour w200p pam scroll-v left gray" data-id="0"></div>
			<p class="on-print bold"> | Tournoi A | </p>
			<div id="tournoiA" class="tournoi mid inbl" data-id="A"></div>
			<br/>
			<p class="on-print bold">| Tournoi B| </p>
			<div id="tournoiB" class="tournoi mid inbl" data-id="B" style="margin-top"></div>
		</div>
	</div>

	<div id="inter" class="full concours">
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
</article>