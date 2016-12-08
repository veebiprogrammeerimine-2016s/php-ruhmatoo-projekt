var counter = 1;
var limit = 20;
function addInput(divName){
     if (counter == limit)  {
          alert("You have reached the limit of adding " + counter + " inputs");
     }
     else {
		 
		 var parent = document.createElement('div');
		 parent.className = "single-item";
		 parent.id = "single-item-"+(counter + 1);
		 
		
		  document.getElementById(divName).innerHTML += "<br>";
          var newdiv = document.createElement('div');
          newdiv.innerHTML = "Toode " + (counter + 1) + " <br><input type='text' name='myInputs[]'>";
		 parent.appendChild(newdiv);
		  var newdiv = document.createElement('div');
		  newdiv.innerHTML = "Hind " + (counter + 1) + " <br><input type='text' name='myInputs[]'>";
		 parent.appendChild(newdiv);
		  var newdiv = document.createElement('div');
		  newdiv.innerHTML = "Kategooria " + (counter + 1) + " <br><input type='text' name='myInputs[]'>";
         parent.appendChild(newdiv);
		 
		  var linkbtn = document.createElement('a');
		  linkbtn.href="#";
		  linkbtn.innerHTML = "Kustuta";
		  
		 
		 parent.appendChild(linkbtn);
		 
		 console.log(parent);
		 
          document.getElementById(divName).appendChild(parent);
          counter++;
		  
		  document.getElementById("single-item-"+(counter + 1)).addEventListener("click", this.remove);
     }
}


function remove(e){
	
	console.log(e.target.parentElement);
	
	
	item.parentElement.removeChild(item);
}