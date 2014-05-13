<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Muzznoid</title>
		<link rel="stylesheet" type="text/css" href="config/css/stylesheet.css" />

		<script src="/js/muzzley-client-0.3.5.min.js"></script>     
		<script type="text/javascript" src="/config/js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="/config/js/processing.min.js"></script>
		<script type="text/javascript" src="/config/js/processing.init.js"></script>
		<script type="text/javascript" src="/config/js/jquery-ui-1.7.1.custom.min.js"></script>
		
		<script>
			$('#barposx').change(function(event, ui) { 
				$('#barposx').val(ui.value);
			});
		</script>
	</head>
	<body>
		<div id="topdiv">
			<div id="playerstatus">
        			?
				<div id="avatar"></div>
				<div id="playername"></div>
			</div>
			<div id="qrcode">
				<div id="loadingqrcode"></div>
				<div id="qrcodeimage"></div>
				<div id="scanme">Scan Me!</div>
			</div>
		</div>

		<script src="config/js/muzznoid.js"></script>     
    
		<script type="application/processing">
			points = 0;
			record = 0;

			float x = 100;
			float y = 200;
			float xspeed = 10;
			float yspeed = 8;  


			void setup() {
				size(550,600);
				frameRate(35);
				smooth();
				noFill();
				background(0);
			}

			void draw() {    
				rectMode(CORNER);
				fill(0,0,0,120);
				rect(0,0,550,600); 

				x = x + xspeed;
				y = y + yspeed;

				if ((x > (width-10)) || (x < 10)) { xspeed = xspeed * -1; }
				if ((y > (height-10)) || (y < 10)) { yspeed = yspeed * -1; }

				fill(255);
				stroke(255)
				rectMode(CORNERS);
				rect(0, 582, 550, 580);

				float a = (float) $('#barposx').val();
				float barpos = (width*a)/100;

				fill(230,27,35);
				stroke(230,27,35);
				rectMode(CENTER);
				rect(barpos, 580, 120, 15);

				$('#points').html(points);

				if(y>=565){
					if((x >= (barpos-(120/2))) && (x <= (barpos+(120/2)))){
						yspeed = yspeed * -1;
						points += 1;
						if(points > record){
							record = points;
							$('#record').html("Record: "+record);
						}	 
					}else{
						points = 0;
						x = 275;
						y = 100;
					}
				}

				stroke(255);
				fill(255);
				ellipse(x, y, 20, 20);
			}
		</script>
		<input type="hidden" id="barposx" value="50">
		<canvas width="680px" height="300px"></canvas>  
       
		<div id="points">0</div>	
		<div id="record"></div>	
    
	  </body>
</html>
