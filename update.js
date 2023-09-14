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

                document.getElementById('selDevId').value = document.getElementById('tdIdInvno').textContent;
                document.getElementById('type').value = document.getElementById('tdIdDevtype').textContent;
                document.getElementById('modelInput').value = document.getElementById('tdIdModel').textContent;
                document.getElementById('nameInput').value = document.getElementById('tdIdName').textContent;
                document.getElementById('snInput').value = document.getElementById('tdIdSn').textContent;
                document.getElementById('macInput').value = document.getElementById('tdIdMac').textContent;
                document.getElementById('location').value = document.getElementById('tdIdLocation').textContent;
                document.getElementById('comInput').value = document.getElementById('tdIdComment').textContent;

                document.getElementById("updateButton").disabled = false;

                document.getElementById("modelInput").disabled = false;
                document.getElementById("nameInput").disabled = false;
                document.getElementById("snInput").disabled = false;
                document.getElementById("macInput").disabled = false;
                document.getElementById("location").disabled = false;
                document.getElementById("comInput").disabled = false;
            }else{

                document.getElementById('selDevId').value = "";
                document.getElementById('type').value = "";
                document.getElementById('modelInput').value = "";
                document.getElementById('nameInput').value = "";
                document.getElementById('snInput').value = "";
                document.getElementById('macInput').value = "";
                document.getElementById('location').value = "";
                document.getElementById('comInput').value = "";

                document.getElementById("updateButton").disabled = true;

                document.getElementById("modelInput").disabled = true;
                document.getElementById("modelInput").disabled = true;
                document.getElementById("nameInput").disabled = true;
                document.getElementById("snInput").disabled = true;
                document.getElementById("macInput").disabled = true;
                document.getElementById("location").disabled = true;
                document.getElementById("comInput").disabled = true;
            }
        };
        xmlhttp.open("GET", "getid.php?q=" + receivedId, true);
        xmlhttp.send();
    }
}

function checkData(id, sn, mac) {
    var tmpResponse;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function() {

        tmpResponse = this.responseText;
        var checkTmpResponse = tmpResponse.includes("ok");

        if (checkTmpResponse == true) {
            updateSubmit();
        }else{
            var text = "The entered MAC or SN is already assigned in the database to a device with an ID:\n"+tmpResponse;
            Swal.fire('Error',text,'error');
        }
    };
    xmlhttp.open("GET", "updateDB_checkDB.php?id=" + id + "&sn=" + sn + "&mac=" +mac, true);
    xmlhttp.send();
}