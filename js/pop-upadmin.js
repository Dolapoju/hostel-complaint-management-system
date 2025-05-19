 function showForm(id) {
    document.getElementById("complaintIdfield").value=id;
    document.getElementById("pop-up1").style.display = "block";
    document.querySelector(".overlay").style.display = "block";
  }
  function hideForm(){
    document.querySelector(".overlay").style.display = "none";
    document.getElementById("pop-up1").style.display = "none";
    document.getElementById("pop-up2").style.display = "none";

  }

  function showForm2(id) {
    document.getElementById("complaintIdfield2").value=id;
    document.getElementById("pop-up2").style.display = "block";
    document.querySelector(".overlay").style.display = "block";
  }
