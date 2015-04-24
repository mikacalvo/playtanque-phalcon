<div id="main" role="main" class="flex-item-fluid ptn">
    <div id="OAVgraph" ng-controller="ChartsController">
        <div style="width:350px; display:inline-block; vertical-align:top;">
            <label for="regime">Joueur</label>
            <select name="joueur" id="joueur" ng-model="joueur" ng-change="setJoueur()">
            	{% for joueur in joueurs %}
			        <option value="{{joueur.id}}">{{joueur.prenom}} {{joueur.nom}}</option>
			    {% endfor  %}
            </select>
        </div>
        <highchart id="chart1" config="highchartsNG" style="display:inline-block; width:500px;"></highchart>
    </div>
</div>