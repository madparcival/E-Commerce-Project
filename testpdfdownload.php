<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    <div class="test" id="content">
        hello
    </div>
    <input type="button" value="dl" onclick="pddownload()">
</body>
<script>
    // import { jsPDF } from "jspdf";
    function pddownload(){
    window.jsPDF=window.jspdf.jsPDF;
    var doc = new jsPDF();

    var elementHTML=document.querySelector('#content');

    doc.html(elementHTML,{
        callback:function(doc){
            doc.save('sample-document.pdf');
        },
        x:15,
        y:15,
        width:170,
        windowWidth:650
    });

}
</script>
<!-- <script src="js/jsPDF/dist/js/jspdf.umd.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

</html>