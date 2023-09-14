var logoutUrl = 'logout.php';
var time = 900000;
var scode = localStorage.getItem("statusCode");  //0 - not visited yet; 1 - already visited
var scode0 = "0"; 
var scode1 = "1";

function logout()
{
	window.setTimeout(logoutAction, time)
}

function logoutAction()
{
	localStorage.setItem("statusCode", scode0);
	
	alert('The session is automatically logged off due to the expiry of 15 minutes');
	window.location = logoutUrl;
}

function setScode()
{
	localStorage.setItem("statusCode", scode0);
}

function onload()
{	
	//alert (scode);

	var d1 = new Date();
	var time1 = d1.getTime();

	if (scode == "1")
	{
		var timeCompare = localStorage.getItem("timeSaved");
		
		if ((time1 - timeCompare) > 900000)
		{
			//more time has passed 
			logoutAction();
		}
		else
		{
			//less time has passed 
			localStorage.setItem("timeSaved", time1);
		}
		
		logout();
	}
	else
	{
		localStorage.setItem("timeSaved", time1);
		
		localStorage.setItem("statusCode", scode1);
		
		logout();		
	}
}

function openForm() {
	type = document.getElementById("type").value;
	model = document.getElementsByName("model")[0].value;
	mac = document.getElementsByName("mac")[0].value;
	macPattern = document.getElementById("macInput");
	department = document.getElementById("location").value;

	macPatternVal = 0;	//1-ok ; 2-not ok

	if (!macPattern.checkValidity()){
		macPatternVal = 2;
	}else{
		macPatternVal = 1;
	}

	if (type == "" ||
		model == "" ||
		mac == "" ||
		macPatternVal == 2 ||
		department == "")
		{
			//one of inputs is empty (or MAC have incorrect pattern) so trigger submit onclick event so browser can highlight empty fields
			document.getElementById("submitButton").click();
	}else{
			document.getElementById("myForm").style.display = "block";
			document.getElementById("toHide1").style.display = "none";
			document.getElementById("toHide1").style.visibility = "hidden";
			document.getElementById("toHide2").style.display = "none";
			document.getElementById("toHide2").style.visibility = "hidden";
			document.getElementById("toHide3").style.display = "none";
			document.getElementById("toHide3").style.visibility = "hidden";
			document.getElementById("toHide4").style.display = "none";
			document.getElementById("toHide4").style.visibility = "hidden";
		}

	delete type;
	delete model;
	delete mac;
	delete department;
}
  
function closeForm() {
	document.getElementById("myForm").style.display = "none";
	document.getElementById("toHide1").style.display = "inline-block";
	document.getElementById("toHide1").style.visibility = "visible";
	document.getElementById("toHide2").style.display = "inline-block";
	document.getElementById("toHide2").style.visibility = "visible";
	document.getElementById("toHide3").style.display = "inline-block";
	document.getElementById("toHide3").style.visibility = "visible";
	document.getElementById("toHide4").removeAttribute("style");
  }
  
function scrollup()
{
	window.scrollTo({ top: 0, behavior: 'smooth' });
}

function updateSubmit()
{
	var id = document.getElementById('selDevId').value;
	var model = document.getElementById('modelInput').value;
	var myTitle = "Do you want to update details on device "+model+" (id="+id+")?";

	if (document.getElementById('modelInput').value == "") {
		Swal.fire('Error','Model field cannot be empty','error');
	}else if (document.getElementById('macInput').value == "") {
		Swal.fire('Error','MAC field cannot be empty','error');
	}else{
		Swal.fire({
			title: myTitle,
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#309c35',
			cancelButtonColor: '#d33',
			confirmButtonText: 'UPDATE'
		  }).then((result) => {
			if (result.isConfirmed) {
				document.updateForm.submit();
			}
		  })
	}
}

function rowClicker()
{
	const myUrl = window.location.search;
	const urlParams = new URLSearchParams(myUrl);

	if (urlParams.has('q') == true) {

		var table = document.getElementById("mainTable");
		var rows = table.getElementsByTagName("tr");
		for (i = 1; i < rows.length; i++) {
			var currentRow = table.rows[i];
			var createClickHandler = function(row) {
				return function() {
					var cell = row.getElementsByTagName("td")[1];
					var cell_2 = row.getElementsByTagName("td")[3];
					var id = cell.innerHTML;
					var model = cell_2.innerHTML;
					var title = "What you want to do with the device "+model+" (id="+id+")?";
					Swal.fire({
						icon: 'question',
						title: title,
						showDenyButton: true,
						showCancelButton: true,
						showCloseButton: true,
						allowEnterKey: false,
						confirmButtonText: 'Delete',
						denyButtonText: `Update`,
						cancelButtonText: `Duplicate`,
						cancelButtonColor: '#20ac20',
						confirmButtonColor: '#df2020',
						denyButtonColor: '#993df5',
					}).then((result) => {
						if (result.isConfirmed) {
						var titleDelete = "Do you really want to DELETE device "+model+" (id="+id+")?";

						Swal.fire({
							title: titleDelete,
							icon: 'warning',
							iconColor: 'red',
							showCancelButton: true,
							allowEnterKey: false,
							confirmButtonColor: '#ca2b2b',
							cancelButtonColor: 'gray',
							confirmButtonText: 'DELETE'
						}).then((result) => {
							if (result.isConfirmed) {
								window.location.href = 'removeDB.php?q='+id;
							}
						})
						} else if (result.isDenied) {
							window.location = "update.php?id="+id;
						} else if (result.dismiss === Swal.DismissReason.cancel) {
							var devType = (row.getElementsByTagName("td")[2]).innerHTML;
							var name = (row.getElementsByTagName("td")[4]).innerHTML;
							var sn = (row.getElementsByTagName("td")[5]).innerHTML;
							var mac = (row.getElementsByTagName("td")[6]).innerHTML;
							var location = (row.getElementsByTagName("td")[7]).innerHTML;
							var comment = (row.getElementsByTagName("td")[8]).innerHTML;
							
							window.location = "add.php?devtype="+devType+"&model="+model+"&name="+name+"&sn="+sn+"&mac="+mac+"&location="+location+"&comment="+comment;
						}
					})
				};
			};

			currentRow.onclick = createClickHandler(currentRow);
		}
	}
}

function fillingForDuplicate() {
	const myUrl = window.location.search;
	const urlParams = new URLSearchParams(myUrl);

	if (urlParams.has('devtype') == true) {
		const devtype = urlParams.get('devtype');
		const model = urlParams.get('model');
		const name = urlParams.get('name');
		const sn = urlParams.get('sn');
		const mac = urlParams.get('mac');
		const location = urlParams.get('location');
		const comment = urlParams.get('comment');

		document.getElementById("type").value = devtype;
		document.getElementById("idModel").value = model;
		document.getElementById("idName").value = name;
		document.getElementById("idSn").value = sn;
		document.getElementById("macInput").value = mac;
		document.getElementById("location").value = location;
		document.getElementById("idComment").value = comment;
	}
}

function fillingFromReport() {

	const myUrl = window.location.search;
	const urlParams = new URLSearchParams(myUrl);

	if (urlParams.has('id') == true) {
		
		const id = urlParams.get('id');

		document.getElementById("inputField").value = id;
		document.getElementById("findId").click();
	}
}

sortTh = document.getElementsByTagName('th');

for (let n=0; n < sortTh.length; n++) {
	sortTh[n].addEventListener('click',item(n));
}

function item(n) {
	return function() {
		sortTable(n);
		changeColor(n);
	}
}

function changeColor(n) {
	var table = document.getElementById("mainTable");
	var columns = table.rows[0].cells.length;
	
	for (i = 0; i < columns; i++) {
		sortTh[i].style.backgroundColor = "#7ebbe7";
	}
	
	sortTh[n].style.backgroundColor = "#7ee7e7";
}

function sortTable(n) {
	var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
	table = document.getElementById("mainTable");
	switching = true;
	// Set the sorting direction to ascending:
	dir = "asc";
	/* Make a loop that will continue until
	no switching has been done: */
	while (switching) {
	  // Start by saying: no switching is done:
	  switching = false;
	  rows = table.rows;
	  /* Loop through all table rows (except the
	  first, which contains table headers): */
	  for (i = 1; i < (rows.length - 1); i++) {
		// Start by saying there should be no switching:
		shouldSwitch = false;
		/* Get the two elements you want to compare,
		one from current row and one from the next: */
		x = rows[i].getElementsByTagName("TD")[n];
		y = rows[i + 1].getElementsByTagName("TD")[n];
		/* Check if the two rows should switch place,
		based on the direction, asc or desc: */
		
		if (n == 0 || n ==1) {
			if (dir == "asc") {
				if (Number(x.innerHTML) > Number(y.innerHTML)) {
				  // If so, mark as a switch and break the loop:
				  shouldSwitch = true;
				  break;
				}
			  } else if (dir == "desc") {
				if (Number(x.innerHTML) < Number(y.innerHTML)) {
				  // If so, mark as a switch and break the loop:
				  shouldSwitch = true;
				  break;
				}
			  }
		}else{
			if (dir == "asc") {
				if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
				  // If so, mark as a switch and break the loop:
				  shouldSwitch = true;
				  break;
				}
			  } else if (dir == "desc") {
				if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
				  // If so, mark as a switch and break the loop:
				  shouldSwitch = true;
				  break;
				}
			  }
		}
		
	  }
	  if (shouldSwitch) {
		/* If a switch has been marked, make the switch
		and mark that a switch has been done: */
		rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
		switching = true;
		// Each time a switch is done, increase this count by 1:
		switchcount ++;
	  } else {
		/* If no switching has been done AND the direction is "asc",
		set the direction to "desc" and run the while loop again. */
		if (switchcount == 0 && dir == "asc") {
		  dir = "desc";
		  switching = true;
		}
	  }
	}
  }

  function search() {
	
	const myObjects = {
		id: document.getElementById('idId').value,
		type: document.getElementById('idType').value,
		model: document.getElementById('idModel').value,
		name: document.getElementById('idName').value,
		sn: document.getElementById('idSn').value,
		mac: document.getElementById('idMac').value,
		loc: document.getElementById('idLocation').value,
		com: document.getElementById('idComment').value,
	};

	var verify = 0;

	for (let x in myObjects) {
		if (myObjects[x] == "") {
			verify ++
		}
	}

	if (verify < 8) {
		let appendUrl = "?q=1&";
		for (let x in myObjects) {
			if (myObjects[x] != "") {
				appendUrl += x + "=" + myObjects[x] + "&";
			}
		}
		let url = appendUrl.slice(0, -1);    // removes last charaster from link - "&"

		window.location.href='report.php' + url;
	}else{
		Swal.fire('Error','Please fill out at least one field','error');
	}
  }

  function fillReport() {
	const myUrl = window.location.search;
	const urlParams = new URLSearchParams(myUrl);

	if (urlParams.has('q') == true) {
		
		const id = urlParams.get('id');
		const type = urlParams.get('type');
		const model = urlParams.get('model');
		const name = urlParams.get('name');
		const sn = urlParams.get('sn');
		const mac = urlParams.get('mac');
		const loc = urlParams.get('loc');
		const com = urlParams.get('com');

		document.getElementById("idId").value = id;
		document.getElementById("idType").value = type;
		document.getElementById("idModel").value = model;
		document.getElementById("idName").value = name;
		document.getElementById("idSn").value = sn;
		document.getElementById("idMac").value = mac;
		document.getElementById("idLocation").value = loc;
		document.getElementById("idComment").value = com;
	}
  }