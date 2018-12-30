<?php
  
  //Template Last updated 3-24-2014
  
  /*

  ' For those in the class that are programming-savvy, here is the source code for the 
  ' PHP template that I use to port the Powerpoint slides over to the web. It can be 
  ' used for any course where the prof uses Powerpoint slides for the lectures.
  
  ' Why? Because you might need to see the lecture slides, but not have access to 
  ' Microsoft Powerpoint, or, a version of Powerpoint that'll read the file(s).
  ' But as a PHP, which becomes (d)html when it hits the client, the slideshow is  
  ' viewable on any device that has an embedded browser.
  
  ' Just download the Powerpoint file, save the slides as PNG graphics to a folder 
  ' somewhere on your PHP-enabled server, then make some global changes to this template.
  
  ' The first 3 globals are self-explanatory. 
  
  ' strPNGpath is the path to the folder where you saved the PNG graphics files.
  ' The naming convention for the graphics files is the default that Powerpoint uses 
  ' to name them when they are saved - Slide[x].PNG. The reason I like to use PNG 
  ' graphics is because PNG graphics can have transparent backgrounds by default.
  
  ' I have used the VBDQ and VBSQ server variables for years, as an easy way to 
  ' do ticks and double-ticks.
  
  ' intUpperBound is the number of slides in the presentation that you want to share.
  ' The array is the set of notes to yourself that will be shown with each slide.
  ' intUpperBound and the upperbound for the array MUST match. However this section 
  ' of the code is the only section where you need to make manual changes.
  
  ' This template uses client-side javascript, so the client browser will need to have 
  ' javascript enabled for proper functioning of the resulting web page. 
  
  */

  $strCourseNumber = "GCU 496";
  $strCourseSemester = "Fall 2014";
  $strLectureNumber = "GP";
  $strLectureTitle = "Group Project Poster";
  $strDate = "Week 16";
  $strTest = "Final";
  $strPNGpath = "Poster";
  $strPNGpattern = "Slide";
  $strPNGextension = ".png";
  
  $intImageWidth = 960;
  $intFrameHeight = 720;
  $intSlideIndexColumnWidth = 115;

  $vbdq = chr(34);
  $vbsq = chr(39);

  $intUpperBound = 2;
  
  $strMyNotes[0] = "This note will never show. Slide 1 begins with index 1. I'll fix this someday.";
    
  $strMyNotes[1] = " ";
  $strMyNotes[2] = " ";
?>

<!DOCTYPE html>

<html lang="en-US" xml:lang="en-US">

<head>
  
  <meta charset="utf-8">
  <meta http-equiv="Expires" content="0">
  <meta http-equiv="Pragma" content="no-cache">
  <meta http-equiv="Cache-Control" content="no-cache">
  
  <title>
    <?php echo $strCourseNumber; ?>&nbsp;<?php echo $strCourseSemester; ?> Lecture <?php echo $strLectureNumber; ?>: <?php echo $strLectureTitle; ?>&nbsp;
    (<?php echo $strDate ?>)
  </title>
  
  <script language="javascript">
    var strSlide = "";
    var intLastSlide = 0;
    var strMyNotes = [
    <?php 
      
      for ($intLoop = 0; $intLoop <= $intUpperBound; $intLoop++)
      {
        if($intLoop <= $intUpperBound)
        {
          echo $vbdq . $strMyNotes[$intLoop] . $vbdq . ", ";
        }
        else
        {
          echo $vbdq . $strMyNotes[intLoop] . $vbdq;
        }
      }
    ?> ];
    function evtSlide(strCommand)
    {
      if(intLastSlide == 0)
      {
        intLastSlide = 1;
      }
      document.getElementById("row" + intLastSlide).style.border = "";
      document.getElementById("row" + strCommand).style.border="1px red solid";
      intLastSlide = strCommand;
      var thePath = "<?php echo $strPNGpath; ?>/<?php echo $strPNGpattern; ?>";
      document.getElementById("theImage").src=thePath + strCommand + "<?php echo $strPNGextension; ?>";
      document.getElementById("currentSlide").textContent = strCommand;
      document.getElementById("myNotes").textContent = strMyNotes[strCommand];
    }
    //Named Anchor handler for the study guides
    function locationHashSelected() 
    {
      evtSlide(location.hash.substring(1,location.hash.length));
      this.focus();
    }
    //keystroke processing
    function processKey(e)
    {
   var intUB = <?php echo $intUpperBound; ?>;
   
      if(e.keyCode == 33)
      {
        strSlide = intLastSlide - 1;
  if(strSlide < 1) strSlide = 1;
        evtSlide(strSlide);
      }
      else if(e.keyCode == 34)
      {
        strSlide = intLastSlide + 1;
  if(strSlide > intUB) strSlide = intUB;
        evtSlide(strSlide);
      }
      else if(e.keyCode == 37)
      {
        strSlide = intLastSlide - 1;
  if(strSlide < 1) strSlide = 1;
        evtSlide(strSlide);
      }
      else if(e.keyCode == 39)
      {
        strSlide = intLastSlide + 1;
  if(strSlide > intUB) strSlide = intUB;
        evtSlide(strSlide);
      }
      document.getElementById("spkeyCode").innerHTML = e.keyCode;
    }
  </script>
  
  <style>
    h1,h2,h3,h4,h5{page-break-after:avoid;}
    BODY, P, TD, TH {font-family:Arial;font-size:10pt;}
    LI {padding:3px;}
    CODE {font-family:courier;font-size:10pt;text-transform:uppercase;}
    PRE {font-size: 9pt;}
				NAV {font-size:10pt;}
    a{color:blue;}
    a:hover{color:red;}
    .important {font-family:verdana;font-weight:bold;color:red;}
    .snippet {font-weight:bold;font-style:italic;}
    .assignment{border:1px green solid;font-weight:bold;}
    .classDate{border:2px red solid;font-weight:bolder;text-decoration:underline;}
    .myAnswer{border:1px black solid;}
    .clsH1{font-size:14pt;font-weight:bolder;}
    .clsH2{font-size:12pt;font-weight:bold;}
    .clsH3{font-size:10pt;font-weight:normal;}
    .smallRed{line-height:18.0pt;font-size:7.5pt;color:#A81817;}
    .greyAddress{font-size:7.5pt;color:gray;}
    .Done{background-color:#C6C6C6;}
    .GroupProject{background-color:#AAFFAA;}
    .LimeLine{border-bottom: 2px solid #0bce7e;width:200px;}
    .underlineIt{text-decoration:underline;}
    .codeIt{font-family:courier;}
				.tiny{margin: 1px;font-size: 9px;}
    .dropshadow 
    {
      -moz-box-shadow: 3px 3px 4px #999; /* Firefox */
      -webkit-box-shadow: 3px 3px 4px #999; /* Safari/Chrome */
      box-shadow: 3px 3px 4px #999; /* Opera and other CSS3 supporting browsers */
      -ms-filter: "progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=135, Color='#999999')";/* IE 8 */
      :progid:DXImageTransform.Microsoft.Shadow(Strength=4, Direction=135, Color='#999999');/* IE 5.5 - 7 */ 
    } 
  </style>
  
</head>

<body onkeydown="processKey(event);">

<table id="container" name="container" width="1280">
<tr><td>

<table id="content" name="content" width="98%">
<tr>
  <td>

<table id="slideset" name="slideset" width="95%" height="330" border="1" style='border:1px blue solid;'>
  <tr>
    <td id="currentSlideBox" name="currentSlideBox" width="75" height="27">Slide: <span id="currentSlide" name="currentSlide" style='border:1px solid black;'>1</span></td>
    <td width="463" id="courseBox" name="courseBox"><h2 style="text-decoration:underline;"><?php echo $strCourseNumber; ?>&nbsp;<?php echo $strCourseSemester; ?></h2></td>
    <th id="examsContainer" name="examsContainer" align="center">
      <table width="85%" height="29" border="1">
        <tr>
          <td align="center" id="midterm1" name="midterm1">Midterm 1</td>
          <td align="center" id="midterm2" name="midterm2">Midterm 2</td>
          <td align="center" id="final" name="final">Final</td>
          </tr>
      </table>
    </th>
    <th width="100" rowspan="2">Slide Notes</th>
  </tr>
  <tr>
    <td height="27" align="left" valign="bottom"><span id="spkeyCode" name="spKeyCode" style="font-size:8px;">0</span></td>
    <td width="463" id="lectureBox" name="lectureBox">
      <h3>Lecture <?php echo $strLectureNumber; ?>: <?php echo $strLectureTitle; ?>&nbsp;(<?php echo $strDate; ?>)</h3></td>
    <th id="relatedLinksNav" name="relatedLinksNav" align="center">
      <span class="tiny">Related Links</span><br>
      <nav class="tiny"><a href="http://www.public.asu.edu/~aoblt/371/projections-key.htm" target="_blank">Map Projection Choice Guide</a>&nbsp;&nbsp;|&nbsp;&nbsp; 
        <a href="http://mapper.acme.com/" target="_blank">ACME Mapper</a>            
      </nav>
    </th>
  </tr>
  <tr>
    <td valign="top" width="75">
      <div style="overflow:scroll;height:<?php echo $intFrameHeight; ?>px;">
        <table id="slideMenu" name="slideMenu" style='border:1px black solid;'>
          
          <?php            
            $intFileCount = 1;
            if (is_dir($strPNGpath))            
            {                                                                                                                                               
              if ($dh = opendir($strPNGpath))                                                                                                                     
              {
                while (($file = readdir($dh)) !== false)                                                                                                
                {
                  if (strtolower(substr($file, -3)) == "png")
                  {
                    echo "<tr><td width=" . $vbdq . $intSlideIndexColumnWidth . $vbdq . "><span id=" . $vbdq . "row" . $intFileCount . $vbdq .
                    " onclick=" . $vbdq . "evtSlide('" . $intFileCount .
                    "');this.focus();" . $vbdq . " onKeyPress=" . $vbdq . $vbdq . ">S" . $intFileCount . "</span></td></tr>" . "\n";
                    $intFileCount++;
                  }
                }
                closedir($dh);
              }
            }
            
          ?>
        
        </table>
      </div>
    </td>
    <td id="canvas" name="canvas" colspan="2" align="center" valign="top">
      <div style="overflow:scroll;width:<?php echo $intImageWidth; ?>px;height:<?php echo $intFrameHeight; ?>px;">
        <img id="theImage" src="<?php echo $strPNGpath; ?>/<?php echo $strPNGpattern; ?>1<?php echo $strPNGextension; ?>" 
             width="<?php echo $intImageWidth; ?>" height="<?php echo $intFrameHeight; ?>"></div>
    </td>
    <td id="notesBox" name="notesBox" valign="top" width="100"><span id="myNotes">&nbsp;</span></td>
  </tr>
</table>

</td></tr></table>
</td></tr></table>

<script>
  var strTest = "<?php echo $strTest; ?>";
  switch(strTest)
  {
    case "Midterm1":
      document.getElementById("midterm1").style.backgroundColor   = "Yellow";
      document.getElementById("midterm2").style.backgroundColor   = "White";
      document.getElementById("final").style.backgroundColor   = "White";
    break;
    case "Midterm2":
      document.getElementById("midterm1").style.backgroundColor   = "White";
      document.getElementById("midterm2").style.backgroundColor   = "Yellow";
      document.getElementById("final").style.backgroundColor   = "White";
    break;
    case"Final":
      document.getElementById("midterm1").style.backgroundColor   = "White";
      document.getElementById("midterm2").style.backgroundColor   = "White";
      document.getElementById("final").style.backgroundColor   = "Yellow";
 break;
 default:
  }
  window.onhashchange = locationHashSelected();
</script>

</body>
</html>