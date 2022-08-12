const inp = document.getElementById("myInput");

function autocomplete() {
  var currentFocus;
  function changeCurrent(value){
    currentFocus = value;
  }

  const callbacks = {
    closeAllLists: () => closeAllLists(),
    changeCurrent: () => changeCurrent(-1)
  }

  const City = new Cities(inp, callbacks);
  
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
    City.fetchCities(inp.value);
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      const id = this.id + "autocomplete-list";
      var x = document.getElementById(id);
      if (x) x = x.getElementsByClassName("city-item");
      
      if (e.key == "ArrowDown") {
        /*If the countriesow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.key == "ArrowUp") { //up
        /*If the countriesow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.key == "Enter") {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  }); 
}

/*initiate the autocomplete function on the "myInput" element, and pass along the countries countriesay as possible autocomplete values:*/
autocomplete();