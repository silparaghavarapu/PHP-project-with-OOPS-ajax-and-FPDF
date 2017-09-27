//image preview script starts
function showImage(event)
{
	 var reader = new FileReader();
	 
	var x = document.getElementById("image_upload").value;
    //document.getElementById("imageupload").src = x;
    document.getElementById("imageupload").src = URL.createObjectURL(event.target.files[0]);
    
   // alert(URL.createObjectURL(event.target.files[0]));
   //alert(x);
    //alert(document.getElementById("image_upload").files[0].name)
}
//image preview script ends


//document open
function runDoc(docFile)
{
	alert(docFile);
try {
var word=new ActiveXObject('Word.Application');
eword.Workbooks.Open(docFile);
word.visible=true;
} catch(e) {}
}
//docment open



//drop down select box script starts



var expanded = false;
function checksize(event)
{
	var x=document.getElementById('Contract_document').value;
	//var reader = new FileReader();
	var ext = x.substring(x.lastIndexOf('.') + 1);
	//alert(x);
	//alert(ext);
	
	if(!(ext == "docx" || ext=="doc" || ext=="pdf" || ext=="txt"))
	{
		alert("Please select a Document File");
	}
	
	if(document.getElementById('Contract_document').files[0].size>30000000)
	{
		alert("Document size id more than 30 MB! Please select a File with less size");
		
	}
	
	
		
}

function signup()
{
	window.location.href="signup"
}
function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}


function display_check(id,col_no)
{
	//alert(document.getElementById(id).checked);
	//alert(IDval);
	
	var rows = document.getElementById("showhidecolumns").rows;
	//alert(rows);
	//alert(col_no);
	var show="";
	if(document.getElementById(id).checked)
	{
		show="none";
	}
	else
	{
		show="";
	}
	
	for (var row = 0; row < rows.length; row++) {
		
        var cols = rows[row].cells;
        if (col_no >= 0 && col_no < cols.length) {
        	
            cols[col_no].style.display = show;
        }
    }
	
}
function updatevalue(val)
{
	//alert(val);
	//alert(document.getElementById("updatevalues").value);
	document.getElementById("updatevalues").value=val;
	//alert(document.getElementById("updatevalues").value);
	//document.show_list.submit();
	return true;
	}
function opendoc(id)
{
	
	window.open('http://localhost/SpecialityTradeUnion/views/Report_View.php?Reportid='+id,'','postwindow');
}
function showdata(str_type,str_data)
{
	var base64EncodedPDF = str_data;
    var dataURI = "data:"+str_type+";base64," + base64EncodedPDF1;
    window.open(dataURI, '_blank');
}
function submitdoc()
{
	document.show_list.submit();
	
}

function showInsurance(str) {
	if (str == "") {
        document.getElementById("load_insurance").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            	
                document.getElementById("load_insurance").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","views/LoadInsuranceLists.php?sid="+str,true);
        xmlhttp.send();
    }
}
// drop down select box script ends
