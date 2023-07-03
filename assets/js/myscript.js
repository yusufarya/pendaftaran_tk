function isNumberKey(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
	// Added to allow decimal, period, or delete
	//if (charCode == 110 || charCode == 190 || charCode == 46)
	//	return true;
	
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	
	return true;
};
function isNumberAlphaKey(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
	
	if (charCode >= 48 && charCode <= 57 || charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122 || charCode == 32)
		return true;
			
	return false;
};

function isNumberAlphaDotKey(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode

	if (charCode >= 48 && charCode <= 57 || charCode >= 65 && charCode <= 90 || charCode >= 97 && charCode <= 122 || charCode == 46)
		return true;
			
	return false;
};

function isNumberWithDot(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode

	if (charCode == 46)
		return true;
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
				
	return true;
};

function isNumberPhone(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
	
	if (charCode == 40 || charCode == 41 || charCode == 45)
		return true;
	if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	
	return true;
};

function ctrlT(evt) {
	var charCode = (evt.which) ? evt.which : event.keyCode
	
	if(charCode == 17 && charCode == 84)
		return false;
	
	return true;
}

function ChangeUpper(elem) {
    elem.value = elem.value.toUpperCase();
}

function ChangeLower(elem) {
   	elem.value = elem.value.toLowerCase();
}

function addDays(startDate,numberOfDays) {
	var returnDate = new Date(
        startDate.getFullYear(),
        startDate.getMonth(),
        startDate.getDate()+numberOfDays,
        startDate.getHours(),
        startDate.getMinutes(),
        startDate.getSeconds()
        );
	return returnDate;
}

function exportTableToCSV($table, filename)
{
    var $rows = $table.find('tr:has(td), tr:has(th)'), 
        tmpColDelim = String.fromCharCode(20),
        tmpRowDelim = String.fromCharCode(0),
        colDelim    = '","',
        rowDelim    = '"\r\n"';

    var csv = '"' + $rows.map(function (i, row){
            var $row    = $(row), 
                $cols   = $row.find('td, th');

            return $cols.map(function(j, col) {
                var $col    = $(col), 
                    text    = $col.text();

                return text.replace(/"/g, '""');
                
            }).get().join(tmpColDelim);

        }).get().join(tmpRowDelim)
                    .split(tmpRowDelim).join(rowDelim)
                    .split(tmpColDelim).join(colDelim) + '"';

    var csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);

    console.log(csv);

    if (window.navigator.msSaveBlob) {

        window.navigator.msSaveOrOpenBlob( new Blob([csv], {type: "text/plain;charset=utf-8;"}), "csvname.csv");
    }
    else{
        $(this).attr({'download':filename, 'href':csvData, 'target':'_blank'});
    }
}


function convertToRupiah(angka){
	var rupiah = '';
	var angkarev = angka.toString().split('').reverse().join('');
	for(var i = 0; i<angkarev.length; i++) if(i%3 == 0) rupiah += angkarev.substr(i,3)+'.';
	return rupiah.split('',rupiah.length-1).reverse().join('');
}

function rupiah(){
	var nominal = document.getElementById("saldokas").value;
	var rupiah = convertToRupiah(nominal);
	document.getElementById("saldokas").value = rupiah;
}

function disablelink(linkID)
{
	var hlink = document.getElementById(linkID);
	if(!hlink)
	return;
	hlink.href = '#';
	hlink.className = "disableLink";
}

function pad(str, maxs)
{
	str = str.toString();
	return str.length < maxs ? pad("0" + str, maxs) : str;
}

$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();

	$('.baris').on('click', function(){
		var tr = $(this);
		var td  = tr[0].children;
		var email = td[0].innerText;
	})
});
