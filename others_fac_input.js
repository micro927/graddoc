function ChangeOthersFacInput(){
  var x = document.getElementById("fac").value;
  if(x=='999'){
    document.getElementById("others_fac").readOnly = false;
    document.getElementById("others_fac").placeholder = "กรอกชื่อหน่วยงาน";
    if(oth!=null){
      document.getElementById("others_fac").value = oth;
    }
  }
  else{
    document.getElementById("others_fac").readOnly = true;
    document.getElementById("others_fac").placeholder = "-";
    document.getElementById("others_fac").value = null;
  }
}