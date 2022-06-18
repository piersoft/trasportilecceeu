<?php //printf($_GET['id'];
header('Content-Type: text/html; charset=utf-8');
function h($data,$encoding='UTF-8')
{
 return htmlspecialchars($data,ENT_QUOTES | ENT_HTML401,$encoding);

}
?>
<!DOCTYPE html>
<html>
<link href="https://fonts.googleapis.com/css?family=Titillium+Web" rel="stylesheet" type="text/css">

<head>
<style>
table, th, td {
    font-family: Titillium Web, Arial, Sans-Serif;
    border: 1px solid black;
}
</style>
</head>
<body>

<style>

    #loadImg{
      position:absolute;
      left:2%;
      top:20%;

    }
    .scrollable-element {
      scrollbar-color: red yellow;
    }
  </style>
  <script>
window.onload=function(){
var iframe=document.getElementById('mioIFRAME');
 if(iframe){
    var altezza = iframe.contentWindow.document.body.scrollHeight;
    iframe.height = altezza+10+"px";
 }
}
</script>
      <div id="loadImg" style="z-index: 2;"></br></br><div><img src="https://www.piersoft.it/gtfstutorial/ajax-loader3.gif" /></div></div>
         <iframe id="mioIFRAME" border=1 name=iframe src="fermata.php?name=<?php printf($_GET['sname'].'&id='.$_GET['id']); ?>" width="100%" scrolling="no" frameborder="0" onload="document.getElementById('loadImg').style.display='none';"></iframe>
     </body>
       </html>
