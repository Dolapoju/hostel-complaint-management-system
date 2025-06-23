function showForm() {
    document.querySelector(".pop-up").style.display = "block";
    document.querySelector(".overlay").style.display = "block";
  }
  
  function hideForm() {
    document.querySelector(".pop-up").style.display = "none";
    document.querySelector(".pop-up2").style.display = "none";
    document.querySelector(".pop-up3").style.display = "none";
    document.querySelector(".overlay").style.display = "none";
  }
  function showForm2(comp,id) {
    document.getElementById("complaint-field").value=comp;
    document.getElementById("complaintIdfield").value=id;
    document.querySelector(".pop-up2").style.display = "block";
    document.querySelector(".overlay").style.display = "block";
  }
  function showForm3(id) {
    document.getElementById("complaintIdfield2").value=id;
    document.querySelector(".pop-up3").style.display = "block";
    document.querySelector(".overlay").style.display = "block";
  }
