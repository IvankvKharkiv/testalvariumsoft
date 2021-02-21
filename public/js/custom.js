// Created this file as asset to avoid compiling every time (npm run watch) when changing resources/app.js


function validateFormOnSubmit(theForm) {
    document.getElementById('waitspinner').style.display = "block";

    var files = document.getElementById('fileToUpload').files;
    var reader= new FileReader();
    reader.onload = function(e) {
        
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
          if (xhttp.readyState === XMLHttpRequest.DONE) {
            document.getElementById('waitspinner').style.display = "none";
            var respobj = JSON.parse(xhttp.response);
            if(respobj.error){
              alert('The file you are trying to upload contains next mistakes: \''+ respobj.error + '\' Please download new file fome our site, or correct current and try to upload again.' )
            }else{
              alert('Done!');
            }
          }
        }
        
        xhttp.open("POST", "/setxmlfile/0", true);
        xhttp.setRequestHeader('X-CSRF-TOKEN', document.querySelector("form[name='uploadxml'] input[name='_token']").value);      
        xhttp.send(e.target.result);
        
        
      };
    if(files[0]){
      reader.readAsText(files[0]);
    }else{
      document.getElementById('waitspinner').style.display = "none";
    }

    return false;
}


function validateFormOnSubmitasnew(theForm) {
  document.getElementById('waitspinner1').style.display = "block";

  var files = document.getElementById('fileToUpload1').files;
  var reader= new FileReader();
  reader.onload = function(e) {
      
      var xhttp = new XMLHttpRequest();

      xhttp.onreadystatechange = function() {
        if (xhttp.readyState === XMLHttpRequest.DONE) {
          document.getElementById('waitspinner1').style.display = "none";
          var respobj = JSON.parse(xhttp.response);
          if(respobj.error){
            alert('The file you are trying to upload contains next mistakes: \''+ respobj.error + '\' Please download new file fome our site, or correct current and try to upload again.' )
          }else{
            alert('Done!');
          }
        }
      }
      
      xhttp.open("POST", "/setxmlfile/1", true);
      xhttp.setRequestHeader('X-CSRF-TOKEN', document.querySelector("form[name='uploadxmlasnew'] input[name='_token']").value);      
      xhttp.send(e.target.result);
      
      
    };
  if(files[0]){
    reader.readAsText(files[0]);
  }else{
    document.getElementById('waitspinner1').style.display = "none";
  }

  return false;
}



function download(filename, text) {
  var element = document.createElement('a');
  element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
  element.setAttribute('download', filename);

  element.style.display = 'none';
  document.body.appendChild(element);

  element.click();

  document.body.removeChild(element);
  document.getElementById('waitspinner').style.display = "none";
  document.getElementById('waitspinner1').style.display = "none";
}

// Start file download.
if(document.getElementById("dwn-btn")){
  document.getElementById("dwn-btn").addEventListener("click", function(){
    document.getElementById('waitspinner').style.display = "block";
    const httpload = '{"pagination":false, "page":0, "perPage":0}';
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
      if (xhttp.readyState === XMLHttpRequest.DONE) {
        download(filename, xhttp.response);
      }
    }
    
    xhttp.open("GET", "/getImployeXmllite", true);
    xhttp.setRequestHeader('httpload', httpload);
    xhttp.send(httpload);
    var filename = "employelist.xml";
    
    
  }, false);
}


if(document.getElementById("dwn-btn-perpage")){
  document.getElementById("dwn-btn-perpage").addEventListener("click", function(){
    document.getElementById('waitspinner1').style.display = "block";
    var url_string = window.location.href;
    var url = new URL(url_string);
    var page = url.searchParams.get("page") ? url.searchParams.get("page") : 1;
    var perpage = url.searchParams.get('perPage') ? url.searchParams.get('perPage') : 10;
    var depid = document.querySelector("input[name='depid']").value ? document.querySelector("input[name='depid']").value : false;

    const httpload = '{"pagination":true, "page":' + page + ', "perPage":' + perpage + ', "depid":' + depid+ '}';
    console.log(httpload);


    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
      if (xhttp.readyState === XMLHttpRequest.DONE) {
        download(filename, xhttp.response);
      }
    }
    
    xhttp.open("GET", "/getImployeXmllite", true);
    xhttp.setRequestHeader('httpload', httpload);
    xhttp.send(httpload);
    var filename = "employelist.xml";
    
    
  }, false);
}