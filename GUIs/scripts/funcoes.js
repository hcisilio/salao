function maskCEP(cep){
	var mcep = '';
	mcep = mcep + cep;
	if (mcep.length == 5) {
		mcep = mcep + '-';
		document.forms[0].cep.value = mcep;				
	}
}
function maskFone(fone){
	var mfone = '';
	mfone = mfone + fone;
	if (mfone.length == 1) {
		mfone = '(' + mfone;
		document.forms[0].fone.value = mfone;				
	}
	if (mfone.length == 3) {
		mfone = mfone + ')';
		document.forms[0].fone.value = mfone;
	}
	if (mfone.length == 8) {
		mfone = mfone + '-';
		document.forms[0].fone.value = mfone;
	}
}

function maskCPF(cpf){
	var mcpf = '';
	mcpf = mcpf + cpf;
	if ( (mcpf.length == 3)||(mcpf.length == 7) ){
		mcpf = mcpf + '.';
		document.forms[0].cpf.value = mcpf;
	}
	if (mcpf.length == 11){
		mcpf = mcpf + '-';
		document.forms[0].cpf.value = mcpf;
	}
}

function mascara_entrada(entrada){ 
	var myhora = ''; 
	myhora = myhora + entrada; 
	if (myhora.length == 2){ 
		myhora = myhora + ':'; 
		document.forms[0].entrada.value = myhora; 
	} 
} 

function mascara_saida(saida){ 
	var myhora = ''; 
	myhora = myhora + saida; 
	if (myhora.length == 2){ 
		myhora = myhora + ':'; 
		document.forms[0].saida.value = myhora; 
	} 
}

function maskMoney(preco){
	var myValor = '';
	myValor = myValor + preco;
	last = myValor.charAt(myValor.length-1);
	if ( last == "," ) {		
	}
	else if ( !isNaN(last) ) {		
	} 
	else {
		document.forms[0].preco.value = myValor.substring(0, myValor.length -1);
	}
}