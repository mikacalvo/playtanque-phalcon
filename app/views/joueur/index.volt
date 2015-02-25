<!DOCTYPE html>
<html lang="en">
  <head>
    <style>

  body {
   font: 24px Helvetica;
   background: #999999;
  }

  #main {
   min-height: 800px;
   margin: 0px;
   padding: 0px;
   display: -webkit-flex;
   display:         flex;
   -webkit-flex-flow: row;
           flex-flow: row;
   }
 
  #main > article {
   margin: 4px;
   padding: 5px;
   border: 1px solid #cccc33;
   border-radius: 7pt;
   background: #dddd88;
   -webkit-flex: 3 1 60%;
           flex: 3 1 60%;
   -webkit-order: 2;
           order: 2;
   }
  
  #main > nav {
   margin: 4px;
   padding: 5px;
   border: 1px solid #8888bb;
   border-radius: 7pt;
   background: #ccccff;
   -webkit-flex: 1 6 20%;
           flex: 1 6 20%;
   -webkit-order: 1;
           order: 1;
   }
  
  #main > aside {
   margin: 4px;
   padding: 5px;
   border: 1px solid #8888bb;
   border-radius: 7pt;
   background: #ccccff;
   -webkit-flex: 1 6 20%;
           flex: 1 6 20%;
   -webkit-order: 3;
           order: 3;
   }
 
  header, footer {
   display: block;
   margin: 4px;
   padding: 5px;
   min-height: 100px;
   border: 1px solid #eebb55;
   border-radius: 7pt;
   background: #ffeebb;
   }
 
  /* Too narrow to support three columns */
  @media all and (max-width: 640px) {
  
   #main, #page {
    -webkit-flex-flow: column;
            flex-flow: column;
            flex-direction: column;
   }

   #main > article, #main > nav, #main > aside {
    /* Return them to document order */
    -webkit-order: 0;
            order: 0;
   }
  
   #main > nav, #main > aside, header, footer {
    min-height: 50px;
    max-height: 50px;
   }
  }

 </style>
 <body>
 	<div class="container">
		<header class="b-dark-gray no-print mcenter">{{ elements.getHeader() }}</header>
 		<aside class="aside w100p">
			{{ link_to("concours", '<i class="fa fa-chevron-circle-left"></i> Retour', "class":"pure-button b-light-blue white mas") }}
		</aside>
		<article id="content" class="main">
			{{ form("concours/create", "method":"post", "style": "width:100%") }}

				{{ content() }}

				<div align="center">
				    <h1>Nouveau concours</h1>
				    
				    <label for="label" class="bold mas">Label</label>
				    {{ text_field("label", "size" : 30) }}
				    <br/><br/>
				    <label for="date" class="bold mas">Date</label>
				    {{ date_field("date") }}
				    <br/><br/>
				    {{ submit_button("OK", "class": "pure-button b-light-green white mas bold") }}
				</div>

			{{ end_form() }}
		</article>
 	</div>
 </body>
