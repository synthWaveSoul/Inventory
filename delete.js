function returnId(receivedId) {
    if (receivedId=="") {

        Swal.fire('Error','Input field is empty','error');
  
    }else{
        var tmpResponse;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onload = function() {
            document.getElementById('table').innerHTML = this.responseText;
            
            tmpResponse = this.responseText;
            var checkTmpResponse = tmpResponse.includes("allGood1");
            
            if (checkTmpResponse == true) {

                document.getElementById("deleteButton").disabled = false;
                document.getElementById('selDevId').value = document.getElementById('inputField').value;
                document.getElementById('idDivRem').style.backgroundColor = "#800000";
                document.getElementById('idDivRem').style.borderTopColor = "#800000";
                document.getElementById('idDivRem').style.borderRightColor = "#800000";
                document.getElementById('idDivRem').style.borderLeftColor = "#800000";

            }else{

                document.getElementById("deleteButton").disabled = true;
                document.getElementById('selDevId').value = "";
                document.getElementById('idDivRem').style.backgroundColor = "gray";
                document.getElementById('idDivRem').style.borderTopColor = "gray";
                document.getElementById('idDivRem').style.borderRightColor = "gray";
                document.getElementById('idDivRem').style.borderLeftColor = "gray";

            }
        };
        xmlhttp.open("GET", "getid.php?q=" + receivedId, true);
        xmlhttp.send();
    }
}

function deleteRecord() {

    var id = document.getElementById('selDevId').value;
	var model = document.getElementById('tdIdModel').textContent;
	var myTitle = "Do you really want to DELETE device "+model+" (id="+id+")?";

		Swal.fire({
			title: myTitle,
			icon: 'warning',
            iconColor: 'red',
            allowEnterKey: false,
			showCancelButton: true,
			confirmButtonColor: '#ca2b2b',
			cancelButtonColor: 'gray',
			confirmButtonText: 'DELETE'
		  }).then((result) => {
			if (result.isConfirmed) {
                window.location.href = 'removeDB.php?q='+id;
			}
		  })
}