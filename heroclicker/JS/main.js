

var coins = 0;
var her1s = 0;
var her2s = 0;
var her3s = 0;
var her4s = 0;
var her5s = 0;
var her6s = 0;

var her1cos = 10;
var her2cos = 250;
var her3cos = 8500;
var her4cos = 200000;
var her5cos = 30000000;
var her6cos = 100000000;

var her1dmg = 1;
var her2dmg = 5;
var her3dmg = 170;
var her4dmg = 4000;
var her5dmg = 30000;
var her6dmg = 600000;

var her1lvl = 0;
var her2lvl = 0;
var her3lvl = 0;
var her4lvl = 0;
var her5lvl = 0;
var her6lvl = 0;

var up1cos = 50000;
var up2cos = 50000;
var up3cos = 100000;
var up4cos = 1000000; 
var up5cos = 10000000; 
var up6cos = 100000000; 
var up7cos = 1000000000; 
var save = false;


var upgradeRatio = 1.10;

var snd = new Audio("sound/beep.mp3");
var dps = 0;


function cookieClick(number){
	coins = coins + number;
    var defg = coins;
	document.getElementById("coins").innerHTML = Math.floor(defg);
};

function checkBuy(){
    if(document.getElementById("her1Cost").innerHTML <= coins){
		document.getElementById("her1").style.color = "white";
		document.getElementById("her1").style.backgroundColor  = "#0e6597";
	} else {
		document.getElementById("her1").style.color = "#434343";
		document.getElementById("her1").style.backgroundColor  = "white";
	}
	
	if(document.getElementById("her2Cost").innerHTML <= coins){
		document.getElementById("her2").style.color = "white";
		document.getElementById("her2").style.backgroundColor  = "#0e6597";
	} else {
		document.getElementById("her2").style.color = "#434343";
		document.getElementById("her2").style.backgroundColor  = "white";
	}
	
	if(document.getElementById("her3Cost").innerHTML <= coins){
		document.getElementById("her3").style.color = "white";
		document.getElementById("her3").style.backgroundColor  = "#0e6597";
	} else {
		document.getElementById("her3").style.color = "#434343";
		document.getElementById("her3").style.backgroundColor  = "white";
	}
	
	if(document.getElementById("her4Cost").innerHTML <= coins){
		document.getElementById("her4").style.color = "white";
		document.getElementById("her4").style.backgroundColor  = "#0e6597";
	} else {
		document.getElementById("her4").style.color = "#434343";
		document.getElementById("her4").style.backgroundColor  = "white";
	}
	
	if(document.getElementById("her5Cost").innerHTML <= coins){
		document.getElementById("her5").style.color = "white";
		document.getElementById("her5").style.backgroundColor  = "#0e6597";
	} else {
		document.getElementById("her5").style.color = "#434343";
		document.getElementById("her5").style.backgroundColor  = "white";
	}
	
	if(document.getElementById("her6Cost").innerHTML <= coins){
		document.getElementById("her6").style.color = "white";
		document.getElementById("her6").style.backgroundColor  = "#0e6597";
	} else {
		document.getElementById("her6").style.color = "#434343";
		document.getElementById("her6").style.backgroundColor  = "white";
	}
	
	//upgrades
	if(document.getElementById("up2Cost").innerHTML <= coins){
		document.getElementById("up2b").style.color = "white";
		document.getElementById("up2b").style.backgroundColor  = "#0e6597";
	} else {
		document.getElementById("up2b").style.color = "#434343";
		document.getElementById("up2b").style.backgroundColor  = "white";
	}
	
	if(document.getElementById("up3Cost").innerHTML <= coins){
		document.getElementById("up3b").style.color = "white";
		document.getElementById("up3b").style.backgroundColor  = "#0e6597";
	} else {
		document.getElementById("up3b").style.color = "#434343";
		document.getElementById("up3b").style.backgroundColor  = "white";
	}
	
	if(document.getElementById("up4Cost").innerHTML <= coins){
		document.getElementById("up4b").style.color = "white";
		document.getElementById("up4b").style.backgroundColor  = "#0e6597";
	} else {
		document.getElementById("up4b").style.color = "#434343";
		document.getElementById("up4b").style.backgroundColor  = "white";
	}
	
	if(document.getElementById("up5Cost").innerHTML <= coins){
		document.getElementById("up5b").style.color = "white";
		document.getElementById("up5b").style.backgroundColor  = "#0e6597";
	} else {
		document.getElementById("up5b").style.color = "#434343";
		document.getElementById("up5b").style.backgroundColor  = "white";
	}
	
	if(document.getElementById("up6Cost").innerHTML <= coins){
		document.getElementById("up6b").style.color = "white";
		document.getElementById("up6b").style.backgroundColor  = "#0e6597";
	} else {
		document.getElementById("up6b").style.color = "#434343";
		document.getElementById("up6b").style.backgroundColor  = "white";
	}
	
	if(document.getElementById("up7Cost").innerHTML <= coins){
		document.getElementById("up7b").style.color = "white";
		document.getElementById("up7b").style.backgroundColor  = "#0e6597";
	} else {
		document.getElementById("up7b").style.color = "#434343";
		document.getElementById("up7b").style.backgroundColor  = "white";
	}
};

function checkDps(){
		document.getElementById("dps").innerHTML =  (her1s * her1dmg) + (her2s * her2dmg) + (her3s * her3dmg) + (her4s * her4dmg) + (her5s * her5dmg) + (her6s * her6dmg);
};

function roundToTwo(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}

function upgrade(upgrade){
	if(upgrade == 2 && her1lvl < 10 && up2cos <= coins){
		her1dmg = her1dmg * 2;
		coins = coins - up2cos;
		up2cos = up2cos * 2.5;
		her1lvl = her1lvl + 1;
		updateGui();
	}
	
	if(upgrade == 3 && her2lvl < 10 && up3cos <= coins){
		her2dmg = her2dmg * 2;
		coins = coins - up3cos;
		up3cos = up3cos * 2.5;
		her2lvl = her2lvl + 1;
		updateGui();
	}
	
	if(upgrade == 4 && her3lvl < 10 && up4cos <= coins){
		her3dmg = her3dmg * 2;
		coins = coins - up4cos;
		up4cos = up4cos * 2.5;
		her3lvl = her3lvl + 1;
		updateGui();
	}
	
	if(upgrade == 5 && her4lvl < 10 && up5cos <= coins){
		her4dmg = her4dmg * 2;
		coins = coins - up5cos;
		up5cos = up5cos * 2.5;
		her4lvl = her4lvl + 1;
		updateGui();
	}
	
	if(upgrade == 6 && her5lvl < 10 && up6cos <= coins){
		her5dmg = her5dmg * 2;
		coins = coins - up6cos;
		up6cos = up6cos * 2.5;
		her5lvl = her5lvl + 1;
		updateGui();
	}
	
	if(upgrade == 7 && her6lvl < 10 && up7cos <= coins){
		her6dmg = her6dmg * 2;
		coins = coins - up7cos;
		up7cos = up7cos * 2.5;
		her7lvl = her7lvl + 1;
		updateGui();
	}
}


function updateGui(){
		document.getElementById("coins").innerHTML = Math.floor(coins);
		
		//hero 1
		document.getElementById("her1s").innerHTML = her1s; 
		document.getElementById("her1dmg").innerHTML = her1dmg; 
		document.getElementById("her1dps").innerHTML = roundToTwo(her1s * her1dmg);
		document.getElementById("up2lvl").innerHTML = her1lvl;
		document.getElementById("up2Cost").innerHTML = up2cos;
		document.getElementById("her1Cost").innerHTML = her1cos; 
		
		//hero 2
		document.getElementById("her2s").innerHTML = her2s; 
		document.getElementById("her2dmg").innerHTML = her2dmg; 
		document.getElementById("her2dps").innerHTML = roundToTwo(her2s * her2dmg);
		document.getElementById("up3lvl").innerHTML = her2lvl;
		document.getElementById("up3Cost").innerHTML = up3cos;
		document.getElementById("her2Cost").innerHTML = her2cos; 
		
		//hero 3
		document.getElementById("her3s").innerHTML = her3s; 
		document.getElementById("her3dmg").innerHTML = her3dmg; 
		document.getElementById("her3dps").innerHTML = roundToTwo(her3s * her3dmg);
		document.getElementById("up4lvl").innerHTML = her3lvl;
		document.getElementById("up4Cost").innerHTML = up4cos;
		document.getElementById("her3Cost").innerHTML = her3cos; 
		
		//hero 4
		document.getElementById("her4s").innerHTML = her4s;
		document.getElementById("her4dmg").innerHTML = her4dmg; 		
		document.getElementById("her4dps").innerHTML = roundToTwo(her4s * her4dmg);
		document.getElementById("up5lvl").innerHTML = her4lvl;
		document.getElementById("up5Cost").innerHTML = up5cos;
		document.getElementById("her4Cost").innerHTML = her4cos; 
		
		//hero 5
		document.getElementById("her5s").innerHTML = her5s;
		document.getElementById("her5dmg").innerHTML = her5dmg; 		
		document.getElementById("her5dps").innerHTML = roundToTwo(her5s * her5dmg);
		document.getElementById("up6lvl").innerHTML = her5lvl;
		document.getElementById("up6Cost").innerHTML = up6cos;
		document.getElementById("her5Cost").innerHTML = her5cos; 
		
		//hero 5
		document.getElementById("her6s").innerHTML = her6s;
		document.getElementById("her6dmg").innerHTML = her6dmg; 		
		document.getElementById("her6dps").innerHTML = roundToTwo(her6s * her6dps);
		document.getElementById("up7lvl").innerHTML = her6lvl;
		document.getElementById("up7Cost").innerHTML = up7cos;
		document.getElementById("her6Cost").innerHTML = her6cos; 
}

function buy(item){

	if(item == 1){
		if(coins >= her1cos){                                   
			her1s = her1s + 1;                                   
			coins = coins - her1cos;
			snd.play();
			updateGui();
			her1cos = Math.floor(her1cos * upgradeRatio);     
			document.getElementById("her1Cost").innerHTML = her1cos; 
		};

	}else if(item == 2){
		if(coins >= her2cos){                                   
			her2s = her2s + 1;                                   
			coins = coins - her2cos;
			snd.play();
			updateGui();
			her2cos = Math.floor(her2cos * upgradeRatio);     
			document.getElementById("her2Cost").innerHTML = her2cos; 
		};
		
	}else if(item == 3){
		if(coins >= her3cos){                                   
			her3s = her3s + 1;                                   
			coins = coins - her3cos;
			snd.play();
			updateGui();
			her3cos = Math.floor(her3cos * upgradeRatio);     
			document.getElementById("her3Cost").innerHTML = her3cos; 
		};
	
	}else if(item == 4){
		
		if(coins >= her4cos){                                   
			her4s = her4s + 1;                                   
			coins = coins - her4cos;
			snd.play();
			updateGui();
			her4cos = Math.floor(her4cos * upgradeRatio);     
			document.getElementById("her4Cost").innerHTML = her4cos; 
		};
	}else if(item == 5){
		
		if(coins >= her5cos){                                   
			her5s = her5s + 1;                                   
			coins = coins - her5cos;
			snd.play();
			updateGui();
			her5cos = Math.floor(her5cos * upgradeRatio);     
			document.getElementById("her5Cost").innerHTML = her5cos; 
		};
	}else if(item == 6){
		
		if(coins >= her6cos){                                   
			her6s = her6s + 1;                                   
			coins = coins - her6cos;
			snd.play();
			updateGui();
			her6cos = Math.floor(her6cos * upgradeRatio);     
			document.getElementById("her6Cost").innerHTML = her6cos; 
		};
	}
	
	tick();
};


window.setInterval(function(){
	
	cookieClick((her1dmg * her1s)/40);
	cookieClick(her2dmg * her2s/40);
	cookieClick(her3dmg * her3s/40);
	cookieClick(her4dmg * her4s/40);
	cookieClick(her5dmg * her5s/40);
	cookieClick(her6dmg * her6s/40);
	tick();
	
}, 25);





function tick(){
	checkDps();
	checkBuy();
	
	
	if(coins >= her1cos){
		var elem = document.getElementById("hero1");
		elem.style.opacity  = '1';
		var elem = document.getElementById("up2");
		elem.style.opacity  = '1';
		var elem = document.getElementById("up1");
		elem.style.opacity  = '1';
	}
	
	if(coins >= her2cos || her2s > 0){
		var elem = document.getElementById("hero2");
		elem.style.opacity  = '1';
		var elem = document.getElementById("up3");
		elem.style.opacity  = '1';
	}else if(her1s >= 1 && her2s == 0){
		var elem = document.getElementById("hero2");
		elem.style.opacity  = '0.2';
		var elem = document.getElementById("up3");
		elem.style.opacity  = '0.2';
	}
	
	if(coins >= her3cos || her3s > 0){
		var elem = document.getElementById("hero3");
		elem.style.opacity  = '1';
		var elem = document.getElementById("up4");
		elem.style.opacity  = '1';
	}else if(her2s >= 1 && her3s == 0){
		var elem = document.getElementById("hero3");
		elem.style.opacity  = '0.2';
		var elem = document.getElementById("up4");
		elem.style.opacity  = '0.2';
	}
	
	if(coins >= her4cos || her4s > 0){
		var elem = document.getElementById("hero4");
		elem.style.opacity  = '1';
		var elem = document.getElementById("up5");
		elem.style.opacity  = '1';
	}else if(her3s >= 1 && her4s == 0){
		var elem = document.getElementById("hero4");
		elem.style.opacity  = '0.2';
		var elem = document.getElementById("up5");
		elem.style.opacity  = '0.2';
	}
	
	if(coins >= her5cos || her5s > 0){
		var elem = document.getElementById("hero5");
		elem.style.opacity  = '1';
		var elem = document.getElementById("up6");
		elem.style.opacity  = '1';
	}else if(her4s >= 1 && her5s == 0){
		var elem = document.getElementById("hero5");
		elem.style.opacity  = '0.2';
		var elem = document.getElementById("up6");
		elem.style.opacity  = '0.2';
	}
	
	if(coins >= her6cos || her6s > 0){
		var elem = document.getElementById("hero6");
		elem.style.opacity  = '1';
		var elem = document.getElementById("up7");
		elem.style.opacity  = '1';
	}else if(her5s >= 1 && her6s == 0){
		var elem = document.getElementById("hero6");
		elem.style.opacity  = '0.2';
		var elem = document.getElementById("up7");
		elem.style.opacity  = '0.2';
	}
};