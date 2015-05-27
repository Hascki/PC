var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();

	if(dd<10) {
		dd='0'+dd
	} 

	if(mm<10) {
		mm='0'+mm
	}	 

	today = new Date(yyyy+'-'+mm+''+dd);
	errors = '';
	today=today.getTime();
var oneDay = 24*60*60*1000;

var date=new Date($('#fabricatie').val());
	date=date.getTime();

   // function convertToSlash(string){
      //var response = string.replace(/-/g,"/");
   //   return response;
  //  }

var diffDays = Math.round(Math.abs((today - date)/(oneDay)));
var age=0;
    if (diffDays == 0)
        age=1
    else if (diffDays <= 30 && diffDays > 0)
        age=2
    else if (diffDays <= 90 && diffDays > 30)
        age=3
    else if (diffDays <= 180 && diffDays > 90)
        age=4
    else if (diffDays <= 270 && diffDays > 180)
        age=5
    else if (diffDays <= 365 && diffDays > 270)
        age=6
    else if (diffDays <= 730 && diffDays > 365)
        age=7
    else if (diffDays <= 1095 && diffDays > 730)
        age=8
    else if (diffDays <= 1460 && diffDays > 1095)
        age=9
    else if (diffDays <= 1825 && diffDays > 1460)
        age=10
    else if (diffDays <= 2190 && diffDays > 1825)
        age=11
    else if (diffDays <= 2555 && diffDays > 2180)
        age=12
    else if (diffDays <= 2920 && diffDays > 2555)
        age=13
    else if (diffDays <= 3285 && diffDays > 2920)
        age=14
    else if (diffDays <= 3650 && diffDays > 3285)
        age=15
    else if (diffDays <= 4015 && diffDays > 3650)
        age=16
    else if (diffDays <= 4380 && diffDays > 4015)
        age=17
    else if (diffDays <= 4745 && diffDays > 4380)
        age=18
    else if (diffDays <= 5110 && diffDays >  4745)
        age=19
    else if (diffDays <= 5475 && diffDays >  5110)
        age=20
    else
        age=21
function calc1(){
	a = co2 = Number($('#emisii').val());
	b = 0;
	c = reducere_vechime[age][1];
	norme = norme_poluare[$('#clasaEuro').val()-1];
	cmc_val = Number($('#capacitate').val());
	if( $('#clasaEuro').val()-1 == norme_poluare.length-1 )
		b = norme.price_start[0];
	else
		b = norme.price_start[$('#combustibil').val()-1];
			console.log(b);
	for( var i in norme.between_co ){
		if( norme.between_co[i][0] <= co2 && norme.between_co[i][1] >= co2  ){
			b = Math.round(b*cote_co[i]*100)/100;
			console.log(cote_co[i]);
			continue;
		}
	}
	for( var i in norme.between_cmc ){
		if( norme.between_cmc[i][0] <= cmc_val && norme.between_cmc[i][1] >= cmc_val  ){
			b = Math.round(b*cote_cmc[i]*100)/100;
			console.log(cote_cmc[i]);
			continue;
		}
	}
	b = Math.round(b*100)/100;
	console.log(b);
	tax = (a*b*(100-c))/100;
	return tax = Math.round(tax*100)/100;
	//$('#timbruMediu').html(tax);
}
function calc2(){
	d = cmc_val = Number($('#capacitate').val());
	b = 0;
	c = reducere_vechime[age][1];
	e = 1;
	norme_vals = norme_poluare[$('#clasaEuro').val()-1].vals;
	console.log(d);
	for( var i in norme_vals ){
		if( norme_vals[i][0] <= cmc_val && norme_vals[i][1] >= cmc_val  ){
			b = norme_vals[i][2];
			e = timbru_tip_auto[$('#clasaEuro').val()-1][i][$('#combustibil').val()-1];
			console.log(e);
			continue;
		}
	}
	console.log(c);
	tax = (e*d*(100-c))/100;
	return tax = Math.round(tax*100)/100;
	//$('#timbruMediu').html(tax);
}
function calc(){
	
	if( isNaN($('#capacitate').val()) ){
		errors += 'Completeaza Capacitatea cilindrica cu un numar (fara . sau ,)!'+"\r\n";
	}
	if( isNaN($('#emisii').val()) ){
		errors += 'Completeaza Emisii CO2 cu un numar (fara . sau ,)!'+"\r\n";
	}
	if( $('#capacitate').val() <= 0 ){
		errors += 'Capacitatea cilindrica trebuie sa fie mai mare de 0!'+"\r\n";
	}
	if( errors != '' ){
		alert(errors);
		return false;
	}
	if( $('#clasaEuro').val()-1 > 2 ){
		return calc1();
	}else if(($('#clasaEuro').val()-1 >5)  || $('#combustibil').val()-1 >2 ) {
		return tax=0;
		//$('#timbruMediu').html(tax);
	}
	else{
		return calc2();
	}
}

var timbru_tip_auto = [
	[[2.8,4.9],[3.2,5.6],[3.7,6.48],[4,7],[4.2,7.35],[4.3,7.53]],
	[[2.9,5.08],[3.3,5.78],[3.8,6.65],[4.2,7.35],[4.4,7.7],[4.5,7.88]],
	[[3,5.25],[3.5,6.13],[4,7],[4.3,7.53],[4.6,8.05],[4.9,8.58]]
];
var cote_cmc = [1,1.2,1.5,1.7,2,2.7,3.3];
var cote_co = [1,1.4,1.8,2.2,2.6,3.2,4.2,4.8,5.4];
var norme_poluare = [
		{
			name:'Non-Euro',
			vals:[[0,1200,2],[1201,1400,2.6],[1401,1600,3.3],[1601,2000,4.2],[2001,3000,4.5],[3001,999999,5.2]]
		},
		{
			name:'Euro 1',
			vals:[[0,1200,1.7],[1201,1400,2.5],[1401,1600,3.1],[1601,2000,4.0],[2001,3000,4.9],[3001,999999,5.1]]
		},
		{
			name:'Euro 2',
			vals:[[0,1200,1.5],[1201,1400,24],[1401,1600,2.9],[1601,2000,3.3],[2001,3000,3.9],[3001,999999,4.4]]
		},
		{
			name: 'Euro 3',
			price_start: [5.4,9.45],
			between_co: [[0,110],[111,125],[126,140],[141,155],[156,170],[171,185],[186,200],[201,215],[216,999999]],
			between_cmc: [[0,1000],[1001,1200],[1201,1400],[1401,1600],[1601,2000],[2001,3000],[3001,999999]]
		},
		{
			name: 'Euro 4',
			price_start: [1.8,3.15],
			between_co: [[0,110],[111,125],[126,140],[141,155],[156,170],[171,185],[186,200],[201,215],[216,999999]],
			between_cmc: [[0,1000],[1001,1200],[1201,1400],[1401,1600],[1601,2000],[2001,3000],[3001,999999]]
		},
		{
			name: 'Euro 5',
			price_start: [0.3],
			between_co: [[0,110],[111,120],[121,130],[131,140],[141,150],[151,165],[166,180],[181,195],[196,210],[210,999999]],
			between_cmc: [[0,1000],[1001,1200],[1201,1400],[1401,1600],[1601,2000],[2001,3000],[3001,999999]]
		}
		/*,
		{
			name:'Euro 3',
			vals:[
				{
					between:[0,110],
					vals: [[0,1000,7.2],[1001,1200,8.64],[1201,1400,10.8],[1401,1600,12.24],[1601,2000,14.4],[2001,3000,19.44],[3001,999999,23.76]]
				},
				{
					between:[111,120],
					vals: [[0,1000,9],[1001,1200,10.8],[1201,1400,13.5],[1401,1600,15.3],[1601,2000,18],[2001,3000,24.3],[3001,999999,29.7]]
				},
				{
					between:[121,130],
					vals: [[0,1000,12],[1001,1200,14.4],[1201,1400,18],[1401,1600,20.4],[1601,2000,24],[2001,3000,32.4],[3001,999999,39.6]]
				},
				{
					between:[141,150],
					vals: [[0,1000,13.8],[1001,1200,16.56],[1201,1400,20.7],[1401,1600,23.46],[1601,2000,27.6],[2001,3000,37.26],[3001,999999,45.54]]
				},
				{
					between:[151,165],
					vals: [[0,1000,15.6],[1001,1200,18.72],[1201,1400,23.4],[1401,1600,26.52],[1601,2000,31.2],[2001,3000,42.12],[3001,999999,51.48]]
				},
				{
					between:[166,180],
					vals: [[0,1000,23.2],[1001,1200,27.84],[1201,1400,34.8],[1401,1600,39.44],[1601,2000,46.4],[2001,3000,62.64],[3001,999999,76.56]]
				},
				{
					between:[181,195],
					vals: [[0,1000,19.5],[1001,1200,23.4],[1201,1400,29.25],[1401,1600,33.15],[1601,2000,39],[2001,3000,52.65],[3001,999999,64.35]]
				},
				{
					between:[196,210],
					vals: [[0,1000,22.5],[1001,1200,27],[1201,1400,33.75],[1401,1600,38.25],[1601,2000,45],[2001,3000,60.75],[3001,999999,74.25]]
				},
				{
					between:[210,999999],
					vals: [[0,1000,24.3],[1001,1200,29.16],[1201,1400,36.45],[1401,1600,41.31],[1601,2000,48.6],[2001,3000,65.61],[3001,999999,80.19]]
				}
			]
		},
		{
			name:'Euro 4',
			vals:[
				{
					between:[0,110],
					vals: [[0,1000,1.8],[1001,1200,2.16],[1201,1400,2.7],[1401,1600,3.06],[1601,2000,3.6],[2001,3000,4.86],[3001,999999,5.94]]
				},
				{
					between:[111,120],
					vals: [[0,1000,2.52],[1001,1200,3.02],[1201,1400,3.78],[1401,1600,4.28],[1601,2000,5.04],[2001,3000,6.8],[3001,999999,8.32]]
				},
				{
					between:[121,130],
					vals: [[0,1000,3.24],[1001,1200,3.89],[1201,1400,4.86],[1401,1600,5.51],[1601,2000,6.48],[2001,3000,18.75],[3001,999999,10.69]]
				},
				{
					between:[141,150],
					vals: [[0,1000,3.96],[1001,1200,4.75],[1201,1400,5.94],[1401,1600,6.73],[1601,2000,9.2],[2001,3000,12.42],[3001,999999,15.18]]
				},
				{
					between:[151,165],
					vals: [[0,1000,5.2],[1001,1200,6.24],[1201,1400,7.8],[1401,1600,8.84],[1601,2000,10.4],[2001,3000,14.04],[3001,999999,17.16]]
				},
				{
					between:[166,180],
					vals: [[0,1000,5.8],[1001,1200,6.96],[1201,1400,8.7],[1401,1600,9.86],[1601,2000,11.6],[2001,3000,15.66],[3001,999999,19.14]]
				},
				{
					between:[181,195],
					vals: [[0,1000,6.5],[1001,1200,7.8],[1201,1400,9.75],[1401,1600,11.05],[1601,2000,13],[2001,3000,17.55],[3001,999999,21.45]]
				},
				{
					between:[196,210],
					vals: [[0,1000,7.5],[1001,1200,9],[1201,1400,11.25],[1401,1600,12.75],[1601,2000,15],[2001,3000,20.25],[3001,999999,24.75]]
				},
				{
					between:[210,999999],
					vals: [[0,1000,8.1],[1001,1200,9.72],[1201,1400,12.15],[1401,1600,13.77],[1601,2000,16.2],[2001,3000,21.87],[3001,999999,26.73]]
				}
			]
		},
		{
			name:'Euro 5',
			vals:[
				{
					between:[0,110],
					vals: [[0,1000,0.3],[1001,1200,0.36],[1201,1400,0.45],[1401,1600,0.51],[1601,2000,0.6],[2001,3000,0.81],[3001,999999,0.99]]
				},
				{
					between:[111,120],
					vals: [[0,1000,0.42],[1001,1200,0.504],[1201,1400,0.63],[1401,1600,0.714],[1601,2000,0.84],[2001,3000,1.134],[3001,999999,1.386]]
				},
				{
					between:[121,130],
					vals: [[0,1000,0.54],[1001,1200,0.648],[1201,1400,0.81],[1401,1600,0.918],[1601,2000,1.08],[2001,3000,1.458],[3001,999999,1.782]]
				},
				{
					between:[131,140],
					vals: [[0,1000,0.66],[1001,1200,0.792],[1201,1400,0.99],[1401,1600,1.122],[1601,2000,1.32],[2001,3000,1.782],[3001,999999,2.178]]
				},
				{
					between:[141,150],
					vals: [[0,1000,0.78],[1001,1200,0.936],[1201,1400,1.17],[1401,1600,1.326],[1601,2000,1.56],[2001,3000,2.106],[3001,999999,2.574]]
				},
				{
					between:[151,165],
					vals: [[0,1000,0.96],[1001,1200,1.152],[1201,1400,1.44],[1401,1600,1.632],[1601,2000,1.92],[2001,3000,2.592],[3001,999999,3.168]]
				},
				{
					between:[166,180],
					vals: [[0,1000,1.26],[1001,1200,1.512],[1201,1400,1.89],[1401,1600,2.142],[1601,2000,2.52],[2001,3000,3.402],[3001,999999,4.158]]
				},
				{
					between:[181,195],
					vals: [[0,1000,1.44],[1001,1200,1.728],[1201,1400,2.16],[1401,1600,2.448],[1601,2000,2.88],[2001,3000,3.888],[3001,999999,4.752]]
				},
				{
					between:[196,210],
					vals: [[0,1000,1.62],[1001,1200,1.944],[1201,1400,2.43],[1401,1600,2.754],[1601,2000,3.24],[2001,3000,4.374],[3001,999999,5.346]]
				},
				{
					between:[210,999999],
					vals: [[0,1000,2.04],[1001,1200,2.448],[1201,1400,3.06],[1401,1600,3.468],[1601,2000,4.08],[2001,3000,5.508],[3001,999999,6.732]]
				}
			]
		}*/
	];
var tip_auto = ['benzina','diesel'];
var reducere_vechime = [['nou',0],
	['<= 1 luna',3],
	['> 1 luna - 3 luni inclusiv',5],
	['> 3 luni - 6 luni inclusiv',8],
	['> 6 luni - 9 luni inclusiv',10],
	['> 9 luni - 1 an inclusiv',13],
	['> 1 an - 2 ani inclusiv',21],
	['> 2 ani - 3 ani inclusiv',28],
	['> 3 ani  - 4 ani inclusiv',33],
	['> 4 ani - 5 ani inclusiv',38],
	['> 5 ani - 6 ani inclusiv',43],
	['> 6 ani - 7 ani inclusiv',49],
	['> 7 ani - 8 ani inclusiv',55],
	['> 8 ani - 9 ani inclusiv',61],
	['> 9 ani - 10 ani inclusiv',66],
	['> 10 ani - 11 ani inclusiv',73],
	['> 11 ani - 12 ani inclusiv',79],
	['> 12 ani - 13 ani inclusiv',84],
	['> 13 ani - 14 ani inclusiv',89],
	['peste 14 ani',90]];
	