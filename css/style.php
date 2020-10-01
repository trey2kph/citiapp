<?php 

	include("../config.php");
	
	//**************** USER MANAGEMENT - START ****************\\

	include(LIB."/login/chklog.php");
    //include(LIB."/init/settinginit.php");

	$logged = $logstat;
    $profile_full = $logfname;
	$profile_name = $lognick;
	$profile_pic = $logpic;
	$profile_id = $userid;
	$profile_idnum = $logname;
	$profile_email = $email;
	$profile_level = $level;
    $profile_hash = md5('2014'.$profile_idnum);

	$GLOBALS['level'] = $level;

    header('Content-Type: text/css'); 

?>
/*
 * HTML5 Boilerplate
 *
 * What follows is the result of much research on cross-browser styling.
 * Credit left inline and big thanks to Nicolas Gallagher, Jonathan Neal,
 * Kroc Camen, and the H5BP dev community and team.
 */

/* ==========================================================================
   Base styles: opinionated defaults
   ========================================================================== */

html,
button,
input,
select,
textarea {
    color: #222;
}

body {
    background: #2e3092;
    display: block;
    font-size: 1em;
    line-height: 1.4;
		margin: 0px;
		font: normal 11px Verdana, Geneva, sans-serif;
}

/*
 * Remove text-shadow in selection highlight: h5bp.com/i
 * These selection rule sets have to be separate.
 * Customize the background color to match your design.
 */

::-moz-selection {
    background: #b3d4fc;
    text-shadow: none;
}

::selection {
    background: #b3d4fc;
    text-shadow: none;
}

/*
 * A better looking default horizontal rule
 */

hr {
    display: block;
    height: 1px;
    border: 0;
    border-top: 1px solid #ccc;
    margin: 1em 0;
    padding: 0;
}

/*
 * Remove the gap between images and the bottom of their containers: h5bp.com/i/440
 */

img {
    vertical-align: middle;
	border: none;
}

/*
 * Remove default fieldset styles.
 */

fieldset {
    border: 0;
    margin: 0;
    padding: 0;
}

/*
 * Allow only vertical resizing of textareas.
 */

textarea {
    resize: vertical;
}

/* ==========================================================================
   Chrome Frame prompt
   ========================================================================== */

.chromeframe {
    margin: 0.2em 0;
    background: #ccc;
    color: #000;
    padding: 0.2em 0;
}

a { text-decoration: none; color: #333; }

/* ==========================================================================
   Author's custom styles
	 Author: JZI - Summit Digital Solutions
   ========================================================================== */


.bodycontainer {
    display: block;
    width: 100%;
    max-width: 1100px;
    min-height: 600px;
    margin: 0px auto;
    background: #FFF;
}

.floatmainbutton {
    display: block;
    position: fixed;
    width: 60px;
    height: 36px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
    background: #F0F;
    bottom: 9%;
    right: 5%;
    text-align: center;
    padding-top: 24px;    
}

.floatbtnanimation {
    -webkit-animation-name: reservenow; /* Chrome, Safari, Opera */
    -webkit-animation-duration: 6s; /* Chrome, Safari, Opera */    
    -webkit-animation-iteration-count: infinite; /* Chrome, Safari, Opera */ 
    animation-name: reservenow;
    animation-duration: 6s;
    animation-iteration-count: infinite;
}

@-webkit-keyframes reservenow {
    0%   {bottom: 9%; background: #F0F;}
    10%  {bottom: 11%; background: #F00;}
    12%  {bottom: 8%;}
    15%  {bottom: 9.5%;}
    16%  {bottom: 8.5%;}
    16.5%  {bottom: 9.25%;}
    16.75%  {bottom: 8.75%;}
    17%   {bottom: 9%; background: #F0F;}
    100%  {bottom: 9%;}
}

/* Standard syntax */
@keyframes reservenow {
    0%   {bottom: 9%; background: #F0F;}
    10%  {bottom: 11%; background: #F00;}
    12%  {bottom: 8%;}
    15%  {bottom: 9.5%;}
    16%  {bottom: 8.5%;}
    16.5%  {bottom: 9.25%;}
    16.75%  {bottom: 8.75%;}
    17%   {bottom: 9%; background: #F0F;}
    100%  {bottom: 9%;}
}

.floatmainbutton:hover {
    background: #F5F;
}


.main {
	display: table;
	width: 100%;
	height: auto;
}

.upper {
	display: block;
	margin: 0px auto;
	width: 100%;
	height: auto;
}


.middle {
	display: block;
	margin: 0px auto;
	width: 100%;
	height: auto;
}

.wrapper {
	display: block;
	width: 100%%;
	height: auto;
    min-height: 100%;
    min-height: 93vh;
	margin: 0px auto;
}

.maincontainer {
	display: block;
	margin: 0px auto;
	width: 94%;
	height: auto;
	padding: 20px 3%;
	position: relative;
	clear: both;
}

.maincontainer p {
    text-align: justify;
}

.divwording img {
    float: right;
    margin: 10px 0px 10px 20px;
}

.titlecontainer {
    display: block;
    width: 100%;
    max-width: 1100px;
    vertical-align: top;
}

.cmaincontainer {
    display: inline-block;
    width: 100%;
    min-height: 600px;
    max-width: 1100px;
    vertical-align: top;
    text-align: center;
}

.hmaincontainer {
    display: inline-block;
    width: 100%;
    height: auto;
    vertical-align: top;
    text-align: center;
}

.lmaincontainer {
    display: inline-block;
    width: 29%;
    min-height: 600px;
    max-width: 300px;
    vertical-align: top;
}

.rmaincontainer {
    display: inline-block;
    width: 70%;
    min-height: 600px;
    max-width: 730px;
    vertical-align: top;
}

.colmaincontainer {
    display: inline-block;
    width: 39%;
    min-height: 600px;
    max-width: 400px;
    vertical-align: top;
}

.cormaincontainer {
    display: inline-block;
    width: 60%;
    min-height: 600px;
    max-width: 630px;
    vertical-align: top;
}

.mainsplash {
	display: block;
	margin: 0px auto;
	width: 100%;
	min-height: 200px;
    height: auto;
	padding: 0px 0px 20px 0px;
	position: relative;
	clear: both;
}

.splashbg {
    background: url(../images/splash.jpg) #022E62 top right no-repeat;
    position: fixed;
    z-index: -1;
    width: 100%;
    height: 300%;
}

.mainmenu div {  
    width: 90%;
    padding: 5%;
    border-bottom: 1px dashed #666;
}

/* SLIDER */

#conslide { width: 100%; height: auto; margin-top: 0px; }

#slider {
    position: relative;
    max-width: 1100px; /* Change this to your images width */
    width: 100%; /* Change this to your images width */
    background: url(images/loading.gif) no-repeat 50% 50%;
}
#slider img {
    position:absolute;
    top:0px;
    left:0px;
    display:none; 
}
#slider a {
    border:0;
    display:block;
}

.headercon {
    height: 200px;
    width: 100%;
    -webkit-box-shadow: 0px 6px 72px -16px rgba(56,56,56,0.9);
    -moz-box-shadow: 0px 6px 72px -16px rgba(56,56,56,0.9);
    box-shadow: 0px 6px 72px -16px rgba(56,56,56,0.9);
}

.mheadertop {
    display: none;
}
    
.floatdiv2 {    
    display: none;
    position: fixed;
    width: 100%;
    height: 100vh;
    z-index: 100;
}

.floatmenu {
    display: none;
}

.headertop {
    height: 11px;
    width: 100%;
    padding: 12px 0px;
    text-align: right;
}

.headerbot {
    height: 17px;
    width: 100%;
    padding: 9px 0px;
    text-align: center;
}

.headertop ul, .headerbot ul {
    list-style: none;
    margin: 0px auto;
    width: 1100px;
}

.headertop li, .headerbot li {
    display: inline;
    cursor: pointer;
    padding-left: 0px; 
    width: 1100px;
    list-style-position: inside;
}

.headertop li {
    color: #FFF;
    margin: 0px 20px;
    font-size: 1em;
}

.headerbot li {
    color: #DDD;
    font-size: 1.3em;
    margin: 0px 50px;
}

.headerbot li a {
    color: #DDD;
}

.headerbot li a:hover {
    color: #FFF;
}

.header {
    display: block;
    width: 100%;
    height: 130px;
    max-width: 1100px;
    margin: 0px auto;
}

.header img {
	display: inline-block;
	margin: 5px 20px;
}

.yellowbubble {
    display: inline-block;
    border: 1px #ff9900 solid;
    background: #eda200;
    border-radius: 50%;
    width: 14px;
    height: 14px;
    padding: 1px;
    text-align: center;
    margin-top: -10px;
}

.loginheader {
	float: right;
	display: inline-block;
	margin: 0px;
	width: 420px;
	height: 82px;
	padding: 20px;
	text-align: right;
	background: url(../images/bghead.jpg) #FFF top right no-repeat;
}

.loggedheader {
	float: right;
    color: #FFF;
    font: normal 14px Verdana;
	display: inline-block;
	margin-top: 40px;
    margin-bottom: 10px;
	width: 46%;
	height: 6px;
	padding: 20px 0% 20px 4%;
	text-align: right;
}


.search {
	display: inline-block;
	margin-top: 20px;
	margin-left: 40px;
	width: 270px;
	height: 80px;
	padding: 0px;
	vertical-align: top;
	text-align: center;
}

.searchborder { 
	border: #e0e0e0 solid 1px;
	display: block;
	width: 260px;
	background-color: #FFF;
}

.searchtext { 
  padding: 5px; 
  font-size: 2em; 
  line-height: 30px;
	display: inline-block;
	border: none !important;
}

.searchtext:active { 
	border: none !important;
}

.searchsub { 
  text-indent: -99999px; 
  width: 30px; 
  height: 30px; 
  display: inline-block;
  background: gray url(../images/search.gif) 0px 0px no-repeat;
	border: none;
	vertical-align: top;
	margin-top: 3px;
}

.logo {
	display: inline-block;
	margin-top: 20px;
	margin-left: 70px;
	width: 210px;
	height: 130px;
	padding: 0px;
	vertical-align: top;
}

.social {
	display: inline-block;
	margin-top: 30px;
	margin-left: 90px;
	width: 220px;
	height: 90px;
	padding: 0px;
	vertical-align: top;
	text-align: center;
}

.tabheadleft, .tabheadright {
	display: none;
}

/* FILTERS */

.filter {
    display: block;
    background: #EFEFEF;
    border: 1px solid #EFEFEF;
    padding: 0px;
    border-radius: 5px;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    width: 90%;
    margin-bottom: 20px;
}

.filterhead {
    display: block;
    padding: 10px;
    text-align: center;
    font-size: 1.3em;
    font-weight: bold;
    background: #2e3092;
    color: #FFF;
    border-radius: 5px 5px 0px 0px;
    -moz-border-radius: 5px 5px 0px 0px;
    -webkit-border-radius: 5px 5px 0px 0px;
}

.filterbody {
    display: block;
    padding-bottom: 20px;
    height: 195px;
    overflow: hidden;
}

.filterbodym {
    display: block;
    padding-bottom: 20px;
    height: 215px;
    overflow: hidden;
}

.filterbody ul {
    list-style: none;
}

.filterbody ul li {
    margin: 10px 0px;
}

.cobody {
    display: block;
    height: auto;
    padding: 0px 10px 20px 10px;
}

.btnshow {
    margin: 20px auto 15px auto !important;
}

.prodcontainer, .promcontainer {
    min-height: 1000px;
}

.fitem {
    display: inline-block;
    width: 22%;
    text-align: center;
    margin: 0px 1% 10px 1%;
    padding: 20px 0px;
    height: 325px;
    vertical-align: top;
    border: 1px dotted #CCC;
}

.bitem {
    display: inline-block;
    width: 17%;
    text-align: center;
    margin: 0px 1% 10px 1%;
    padding: 20px 0px;
    height: 90px;
    vertical-align: top;
    border: 1px dotted #CCC;
}

.aitem {
    display: inline-block;
    width: 30%;
    text-align: center;
    margin: 0px 1% 10px 1%;
    padding: 20px 0px;
    height: 360px;
    vertical-align: top;
    border: 1px dotted #CCC;
}

.pitem {
    display: inline-block;
    width: 30%;
    text-align: center;
    margin: 0px 1% 40px 1%;
    padding: 0px;
    height: 228px;
    vertical-align: top;
    border: 1px dotted #CCC;
}

.jitem {
    display: inline-block;
    width: 30%;
    text-align: center;
    margin: 0px 1% 30px 1%;
    padding: 0px;
    height: 300px;
    vertical-align: top;
    border: 1px dotted #CCC;
}

.aitem .front, .aitem .back, .pitem .front, .pitem .back, .jitem .front, .jitem .back {
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    background: #FFF;
    height: 80% !important;
}

.pitem .front .front {
    width: 100%;
    background: #2e3092;
    color: #FFF;
    height: 67%;
    padding-top: 1px;
}

.jitem .front div {
    width: 92%;
    background: #2e3092;
    height: 20px;
    padding: 140px 4%;
    color: #FFF;
}

.pitem .back div, .jitem .back div {
    padding: 8px 10px;
    text-align: left;
    background: #FFF;
}

.jreq {
    height: auto;
    max-height: 172px;
    overflow: auto;
}

.fitem .back, .aitem .back {
    padding-top: 30%;
    background: #FFF;
}

.aproduct {
    display: inline-block;
    width: 92%;
    text-align: left;
    margin: 0px 1% 10px 1%;
    padding: 20px 3%;
    height: auto;
    vertical-align: top;
    border: 1px dotted #CCC;
} 

.apromo {
    display: inline-block;
    width: 98%;
    text-align: left;
    margin: 0px 1% 10px 1%;
    padding: 0px;
    height: auto;
    vertical-align: top;
} 

.aproduct .ainfo {
    width: 53%;
    display: inline-block;
    margin-left: 10px;
    vertical-align: top;
}

.apromo .ainfo, .acareer .ainfo {
    width: 95%;
    display: inline-block;
    margin-left: 10px;
    vertical-align: top;
}

.aproduct .ainfoadd {
    display: block;
    margin-left: 10px;
    width: 100%;
    vertical-align: top;
}

.amap {
    width: 65%;
    height: 70%;
    display: block;
    position: absolute;
}

.map {
    position: relative;
    overflow: hidden;
    width: 100%;
    height: 100%;
}

.alist {
    max-height: 600px;
    overflow: auto;
}

.storelist {
    padding: 20px;
}

.aspecs {
    column-count: 2;
}

#pamount {
    font-size: 2em;
    font-weight: bold;
    margin-top: 20px;
    color: #666;
}

#price-range {    
    width: 80%;
    margin: 10px auto;
}

/* MENU SYSTEM - START */

.mobilemenu { display: none; }

.menu {
	display: block;
	margin: -12px 0px 0px 0px;
	width: 970px;
	height: 42px;
	padding: 0px 14px;
	border-top: #e0e0e0 solid 1px;
	border-bottom: #e0e0e0 solid 1px;
	background-color: #FFF;
	text-align: center;
}

.navcontainer {
	display: block;
	margin: 0px;
	padding: 0px;
	text-align: center;
}

.nav {
	display: inline-block;
	font-size: 23px;
	vertical-align: top;
	margin-left: 3px;
	padding: 5px 10px;
	z-index: 100;
	cursor: pointer;
}

.dropnavcontainer {
	position: absolute;
	display: none;
	margin: 0px 0px 0px -13px;
	padding: 0px;
	left: auto;
	text-align: center;
	z-index: 200;
	list-style: none !important;
	background-color: #FFF;
	box-shadow: 0px 5px 10px 0px #333;
}

.dropnav {
	display: block;
	font-size: 16px;
	padding: 8px;
	border-top: #d2d2d2 dashed 1px;
	cursor: pointer;
}

.dropnav:hover {
	color: #2e3092;
}

.submenu {
	display: block;
	margin: -5px auto 0px auto;
	width: 900px;
	height: 20px;
	padding: 5px;
	background-color: #FFF;
	border: #e0e0e0 solid 1px;
}

.subnavcontainer {
	display: inline-block;
	margin: 0px;
	padding: 0px;
	width: 60%;
	text-align: left;
}

.subnavcontainer2 {
	display: inline-block;
	margin: 0px;
	padding: 0px;
	width: 39%;
	text-align: right;
}

.searchmobile {
	display: none;
}

.subnav {
	display: inline-block;
	font-size: 14px;
	vertical-align: top;
	margin-left: 15px;
	cursor: pointer;
}

.subnav a:hover {
	color: #2e3092;
}

#nameper {
    max-height: 125px;
    overflow: auto;
}

/* MENU SYSTEM - FINISH */


.div3 {
    display: inline-block;
    width: 28%;
    padding: 40px 2%;
    height: 110px;
    vertical-align: top
}

.left3 {
    width: 30% !important;
    padding-right: 2% !important;
    padding-left: 0px !important;
}

.right3 {
    width: 30% !important;
    padding-right: 0px !important;
    padding-left: 2% !important;
}

.brokenleft {
    border-left: 1px #999 dotted;
}

.solidbottom {
    border-bottom: 1px #CCC solid;
}

.dottedbottom {
    border-bottom: 1px #999 dotted;
}

.logcontainer {
	display: block;
	margin: 0px;
	width: 1000px;
	height: auto;
	padding: 0px;
	border-top: #03295A 2px solid;
}

.logbox {
	display: inline-block;
	margin: 0px 0px 0px auto;
	height: auto;
	padding: 5px 10px 5px 20px;
    background-color: #E3E3E3;
    color: #333;
    border-radius: 0px 0px 0px 10px;
    -moz-border-radius: 0px 0px 0px 10px;
    -webkit-border-radius: 0px 0px 0px 10px;
}

.subcontainer {
	display: block;
	margin: 0px;
	width: 100%;
	height: auto;
	padding: 0px;
}

.menusub {
	display: inline-block;
	margin: 0px;
	width: 993px;
	height: 45px;
	padding: 0px;
	vertical-align: top;
	float: left;
}
.cursornone { cursor: auto !important; }



/* COMMENT */

.comments {    
    border-top: 1px #666 dashed;
    margin: 10px auto 0px auto;
}

.commentdiv {
    display: block;
    padding: 10px 0px;
}

.commentpic {
    width: 50px;
}

.dashcommentballoon {
    padding: 3%;
    width: 72%;
    height: auto;
    background: #DDD;
    border: 2px #DDD solid;
    -moz-border-radius: 10px;
    -webkit-border-radius: 10px;
    border-radius: 10px;
    margin-bottom: 10px;
}

.comment_message {
    width: 100%;
    background: #DDD !important;
    border: none !important;
}

/* FLOAT DIV - START */

.floatdiv {
    position: fixed;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 20;
    left: 0;
    top: 0;
}

.mfloatdiv {
    position: fixed;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 20;
    left: 0;
    top: 0;
}

.fview2 {
	position: relative;
	width: 620px;
	height: auto;
	background-color: #FFF;
	z-index: 10;
	margin: 60px auto;
	padding: 20px;
	border: #999 1px solid;
	border-radius: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-webkit-box-shadow: 10px 10px 5px -6px rgba(0,0,0,0.75);
	-moz-box-shadow: 10px 10px 5px -6px rgba(0,0,0,0.75);
	box-shadow: 10px 10px 5px -6px rgba(0,0,0,0.75);
}

.forder, .flog, .freg, .fforgot, .fview, .fcart, .fwish, .fadd, .fdel, .fedit {
	position: relative;
	width: 500px;
	height: auto;
    max-height: 350px;
	background-color: #FFF;
	z-index: 10;
	margin: 60px auto;
	padding: 20px;
	border: #999 1px solid;
	border-radius: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	-webkit-box-shadow: 10px 10px 5px -6px rgba(0,0,0,0.75);
	-moz-box-shadow: 10px 10px 5px -6px rgba(0,0,0,0.75);
	box-shadow: 10px 10px 5px -6px rgba(0,0,0,0.75);
}

.fdata {
    display: block;
    margin: 12px 0px;
    text-align: center;
}

.fdataleft {
    display: inline-block;
    width: 66%;
    text-align: left;
}

.fdataright {
    display: inline-block;
    width: 30%;
    text-align: right;
}

.formdataleft {
    display: inline-block;
    width: 35%;
    text-align: left;
}

.formdataright {
    display: inline-block;
    width: 61%;
    text-align: left;
}

.fdata16 {
    display: inline-block;
    width: 16%;
}

.fdata20 {
    display: inline-block;
    width: 20%;
}

.fdata21 {
    display: inline-block;
    width: 21%;
}

.fdata25 {
    display: inline-block;
    width: 25%;
}

.commentlist {
    display: block;
    height: 160px;
    overflow: auto;
    clear: both;
}

.closebutton, .mclosebutton {
    margin-left: 495px;
    margin-top: -26px;
}

.closebutton2 {
    margin-left: 615px;
    margin-top: -26px;
}

.viewscroll {
    display: block;
    overflow: auto;
    width: 100%;
    height: 450px;
    margin-top: 10px;
}

.viewscroll2 {
    display: block;
    overflow: auto;
    width: 100%;
    height: 250px;
    margin-top: 10px;
}

.statbar {
    display: inline-block;
    padding: 5px;
    color: #FFF;
    text-transform: uppercase;
    font-size: 9px;
}

.statbarbig {
    display: block;
    padding: 5px;
    color: #FFF;
    text-transform: uppercase;
    font-size: 12px;
    font-weight: bold;
    margin-top: 25px;
}

/* FLOAT DIV - END */

.btn {
	font-family: "Verdana";
	font-size: 12px;
	margin: 0px auto;
	padding: 3px 8px;
	color: #FFF;
	background-color: #77A800;
	border: #666 1px solid;
	border-radius: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	text-align: center;
    cursor: pointer;
}

.redbtn {
    font-family: "Verdana";
    margin: 0px auto;
    padding: 3px 8px;
    color: #FFF;
    background-color: #2e3092;
    border: #2e3092 1px solid;
    border-radius: 5px;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
    text-align: center;
    cursor: pointer;
    padding: 10px;
    min-width: 150px;
    font-size: 1.2em;
}

.redbtn:hover {
    background-color: #050751;
    border: #050751 1px solid;
}

.smlbtn {
    font-family: "Verdana";
    font-size: 12px !important;
    margin: 0px auto;
    padding: 3px 8px;
    color: #FFF;
    background-color: #2e3092;
    border: #2e3092 1px solid;
    border-radius: 5px;
    -moz-border-radius: 5px;
    -webkit-border-radius: 3px;
    text-align: center;
    cursor: pointer;
    padding: 4px;
}

.bigbtn {
	font-family: "Verdana";
	font-size: 16px;
	margin: 10px auto;
	padding: 8px 15px;
	color: #FFF;
	background-color: #77A800;
	border: #DDD 2px solid;
	border-radius: 10px;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	text-align: center;
    cursor: pointer;
}

.purplebtn {    
	font-family: "Verdana";
	font-size: 12px;
	margin: 0px auto;
	padding: 3px 8px;
	color: #FFF;
	background-color: #4400A3;
	border: #666 1px solid;
	border-radius: 5px;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	text-align: center;
    cursor: pointer;

}

.btnphone {
    display: none;
}

.txtbox {
    border: 1px solid #999; 
    -webkit-border-radius: 2px; 
    -moz-border-radius: 2px; 
    border-radius: 2px; 
    outline: 0; 
    padding: 3px; 
}

.bigtxtbox {
    width: 80%;
    padding: 4%;
    margin: 20px auto;
    border: 1px solid #FFF;
    border-radius: 5px;
}

.txtarea {
    width: 80%;
    border: 1px solid #999; 
    -webkit-border-radius: 2px; 
    -moz-border-radius: 2px; 
    border-radius: 2px; 
    outline: 0; 
    padding: 5px; 
}

.midfooter {
	display: block;
	margin: 0px auto;
	width: 100%;
	height: 300px;
	position: relative;
    /*-webkit-box-shadow: 0px -6px 72px -16px rgba(56,56,56,0.9);
    -moz-box-shadow: 0px -6px 72px -16px rgba(56,56,56,0.9);
    box-shadow: 0px -6px 72px -16px rgba(56,56,56,0.9);*/
}

.footer {
	display: block;
	margin: 0px auto;
	width: 100%;
	height: 50px;
	position: relative;
}

.footercontainer {
	display: inline-block;
	margin: 0px auto;
	width: 1100px;
	height: auto;
    padding: 17px 0px;
}

.footerlcontainer, .footerrcontainer {
	display: inline-block;
	margin: 0px auto;
	width: 49.7%;
	height: auto;
    padding: 0px;
    vertical-align: top;
}

.copyright {
	display: block;
	margin: 0px auto;
	width: 94%;
	height: 70px;
	padding: 0px 3%;
}

.lcopyright {
	display: inline-block;
	margin: 20px auto;
	width: 100%;
	height: 30px;
	text-align: center;
}

.lcopyright ul {
	padding: 0px;
}

.lcopyright li {
	display: inline-block;
	margin-right: 20px;
}

.ccopyright {
	display: inline-block;
	margin-top: 30px;
	width: 130px;
	height: 80px;
}

.rcopyright {
	display: inline-block;
	margin-top: 45px;
	width: 160px;
	height: 80px;
}

/* REGISTRATION */

/* GALLERY */

.album_list {
	display: inline-block;
	width: 194px;
	height: auto;
	margin-bottom: 10px;
    margin-right: 10px; 
}	

.pixlist {
    display: block;
    height: 220px;
    overflow: auto;
}

.pixdiv {
	display: inline-block;
	width: 28%;
	height: 75px;
	clear: both;
	margin-bottom: 10px;
    padding: 2%
}	

.pixdel {
    margin-left: -13px;
    width: 16px;
    height: 16px;
    border-radius: 15px;
    -moz-border-radius: 15px;
    -webkit-border-radius: 15px;
    background-color: #F00;
    padding: 7px;
    text-align: center;
}

.btndelpix {
    margin: 6px -3px 0px -3px;
}

.picture_list {
	display: inline-block;
	width: 194px;
	height: auto;
	margin-bottom: 20px;
    margin-right: 10px; 
}

.porder {
    width: 20px;
    text-align: right;
}

/* VOTE */

.vote_strip {
    background: #F00;
    padding: 5px;
    position: absolute;
    z-index: 10;
}

.vote_pix {
    position: absolute;
    z-index: 10;
    width: 194px;
    height: 90px;
    background: rgba(255, 255, 255, 0.75);
    padding-top: 60px;
}

/* PASSWORD */

.divpass {
    clear: both;
    margin-top: 5px;
}

/* WARNINGS AND ERROR */

.warning {
    border: 1px dashed #FAA;
    background: #FFE;
    padding: 10px;
    margin-top: 10px;
    border-radius: 5px;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
}

/* FAQ */

.faqlist div {
    display: block;
    margin-bottom: 10px;
    margin-top: 10px;
}

/* PAGINATION */

.pagination {
	display: block;
	margin: 20px 0px;
	width: 100%;
	height: auto;
	padding: 5px 0px;
	background-color: #FFF;
	text-align: center; 
}

.artpagination {
	display: block;
	margin: 20px 0px;
	width: 644px;
	height: auto;
	padding: 5px 0px;
	background-color: #FFF;
	text-align: center; 
}

.pagination2 {
	display: none; 
}

.pageactive {
	display: inline-block;
	margin: 0px 3px 5px 3px;
	height: auto;
	padding: 5px;
	background-color: #2e3092;
	text-align: center; 
}

.pagelink {
	display: inline-block;
	margin: 0px 3px 5px 3px;
	height: auto;
	padding: 5px;
	text-align: center;
}

.pagelink:hover {
	display: inline-block;
	margin: 0px 3px;
	height: auto;
	padding: 5px;
	background-color: #2e3092;
	text-align: center;
	color: #CCC !important;
}

#fpass, #forgot {
    display: block;
    margin: 10px auto;
    text-align: center;
    padding: 1% 5%;
}

#divsearch, #divemail {
    display: inline;
    margin: 44px 0px 0px auto;
    float: right;
    background: #ffffff; /* Old browsers */
    background: -moz-linear-gradient(left, #ffffff 0%, #ffffff 89%, #2e3092 89%, #2e3092 89%, #ffffff 89%, #ffffff 89%, #2e3092 89%, #2e3092 100%); /* FF3.6-15 */
    background: -webkit-linear-gradient(left, #ffffff 0%,#ffffff 89%,#2e3092 89%,#2e3092 89%,#ffffff 89%,#ffffff 89%,#2e3092 89%,#2e3092 100%); /* Chrome10-25,Safari5.1-6 */
    background: linear-gradient(to right, #ffffff 0%,#ffffff 89%,#2e3092 89%,#2e3092 89%,#ffffff 89%,#ffffff 89%,#2e3092 89%,#2e3092 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#2e3092',GradientType=1 );
    border: 1px #2e3092 solid;
    border-radius: 5px;
    -moz-border-radius: 5px;
    -webkit-border-radius: 5px;
}

.divvisit {
    display: block;
    clear: both;
    padding-top: 40px;
    font-size: 16px;
}

.btnsearch {
    display: inline-block;
    width: 30px;
    height: 29px;
}

.btnmail {
    display: inline-block;
    width: 41px;
    height: 29px;
    text-align: center;
}

.txtsearch, .txtemail {
    margin: 5px;
    width: 300px;
    border: none;
    font-size: 2em;
    font-weight: bold;
}

#appimg {
    height: 150px; 
    width: 150px
}

#imgbig {
    width: 300px !important;
}

/* MAIL DIV */

.maildiv {
    display: block;
    border: 5px solid #024485;
    padding: 10px;
}

/* TABLE */

.tdata, .tdataform { 
    margin: 0px auto;
}

.tdata {
    background: #333;
}

.tdata tr:hover { background: #DDD !important; -webkit-box-shadow: inset -33px -65px 30px -63px rgba(0,0,0,0.5);
-moz-box-shadow: inset -33px -65px 30px -63px rgba(0,0,0,0.5);
box-shadow: inset -33px -65px 30px -63px rgba(0,0,0,0.5); }

th { background: #022B5D; color: #DDD; }

.fc-content td, .tdata tr, .tdataform tr { background: #FFF; color: #333; }

.tdataform input, .tdataform select, .tdataform2 input, .tdataform2 select { 
    font-size: 11px; 
    font-family: "Verdana"; 
    border: 1px solid #999; 
}

th, td { padding: 5px; }

/* LISTS */

.noliststyle {
    list-style: none;
}

/* JQUERY DATEPICKER */

.ui-datepicker {
    z-index: 40 !important;
}

/* IMAGE SIZES */

.hugeimage {
	width: 642px;
	height: 429px;
}

.largeimage {
	width: 190px;
	height: 127px;
}

.mediumimageover {
	width: 150px;
	height: 100px;
}

.mediumimage {
	width: 150px;
	height: 100px;
}

.mediumimage2 {
	width: 140px;
	height: 93px;
}

.smallimg {
    border-radius: 3px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
}

.leftalign {
	float: left;
	margin-right: 18px;
}

.rightalign {
	float: right;
	margin-left: 18px;
}

.lefttalign {
	text-align: left !important;
}

.centertalign {
	text-align: center !important;
}

.righttalign {
	text-align: right;
}

.centerimage {
	margin: 0px auto;
}

.bottomimage {
	position: absolute;
	bottom: 0px;
}

/* FONTS AND TEXTS */

.arttitle:hover {
	color: #494949 !important;
}

@font-face {
    font-family: 'Roboto';
    src: url('../lib/font/robot.eot');
    src: url('../lib/font/robot.eot?#iefix') format('embedded-opentype'),
         url('../lib/font/robot.woff') format('woff'),
         url('../lib/font/robot.ttf') format('truetype'),
         url('../lib/font/robot.svg#Roboto') format('svg');
    font-weight: normal;
    font-style: normal;
}

.roboto {
	font-family: 'Roboto';
}

.robotobold {
	font-family: 'Roboto';
    font-weight: bold;
}

.whitetext {
	color: #fff;
}

.redtext {
	color: #2e3092 !important;
}
	
.pinktext {
	color: #f0f !important;
}
	
.lgraytext {
	color: #d2d2d2 !important;
}

.lgraytext2 {
	color: #b9b9b9;
}

.mgraytext {
	color: #494949;
}

.mgraytext2 {
	color: #666;
}

.dgraytext {
	color: #1d1d1d;
}

.yellowtext {
	color: #FF0;
}

.greentext {
	color: #093;
}

.dbluetext {
	color: #022B5D;
}

.blacktext {
	color: #000;
}

.orangetext {
    color: #963600;
}

.lorangetext {
    color: #ffb523;
}

.bold {
	font-weight: bold;
}

.italic {
	font-style: italic;
}

.hugetext2 {
	font-size: 36px;
	line-height: 38px;
}

.hugetext {
	font-size: 30px;
	line-height: 31px;
}

.cattext {
	font-size: 22px;
	line-height: 26px;
}

.titletext {
	font-size: 21px;
	line-height: 23px;
}

.titletext2 {
	font-size: 23px;
	line-height: 24px;
}

.cattext2 {
	font-size: 18px;
	line-height: 19px;
}

.cattext3 {
	font-size: 17px;
	line-height: 19px;
}

.mediumtext {
	font-size: 16px;
	line-height: 18px;
}

.mediumtext2 {
	font-size: 14px;
	line-height: 18px;
}

.mediumtext3 {
	font-size: 15px;
	line-height: 20px;
}

.artbodytext {
	font-size: 15px;
	line-height: 24px;
}

.artexcerpttext {
	font-size: 14px;
	line-height: 17px;
}

.smalltext2 {
	font-size: 13px;
	line-height: 14px;
}

.smalltext {
	font-size: 12px;
	line-height: 18px;
}

.vsmalltext {
	font-size: 11px;
}

.letterspace {
	letter-spacing: 1px;
}

.captalize {
	text-transform: capitalize;
}

.nodecor {
	text-decoration: none !important;
}

.antiitaly {
	font-style: normal !important;
}

.cursorpoint {
	cursor: pointer;
}

.blinked {
    text-decoration: blink !important;
}

.underlined {
    text-decoration: underline !important;
}

/* FLOAT */

.clearboth {
	clear: both;
}

.clearright {
	clear: right;
}

.floatleft {
	float: left !important;
}

.floatright {
	float: right !important;
}

/* SHADOW */

.downshadow {
    -webkit-box-shadow: 1px 11px 10px 0px rgba(0,0,0,0.28);
    -moz-box-shadow: 1px 11px 10px 0px rgba(0,0,0,0.28);
    box-shadow: 1px 11px 10px 0px rgba(0,0,0,0.28);
}

.upshadow {
    -webkit-box-shadow: 1px 0px 10px 0px rgba(0,0,0,0.75);
    -moz-box-shadow: 1px 0px 10px 0px rgba(0,0,0,0.75);
    box-shadow: 1px 0px 10px 0px rgba(0,0,0,0.75);
}

.insetupshadow {
    -webkit-box-shadow: inset 1px 4px 10px 0px rgba(0,0,0,0.28);
    -moz-box-shadow: inset 1px 4px 10px 0px rgba(0,0,0,0.28);
    box-shadow: inset 1px 4px 10px 0px rgba(0,0,0,0.28);
}

.txtshadow {
    text-shadow: 2px 2px rgba(0,0,0,0.75);
}

/* COLUMN */

.twocolumn {
    -webkit-column-count: 2;
    -moz-column-count: 2;
    column-count: 2;
    -webkit-column-gap: 20px;
    -moz-column-gap: 20px;
    column-gap: 20px;
}
    
/* MARGIN AND PADDING */

.valigntop {
	vertical-align: top;
}

.centermargin {
	margin: 0px auto;
}

.rightmargin {
	margin: 0px 0px 0px auto;
}

.nomargin {
	margin: 0px !important;
}

.nomargintop {
	margin-top: 0px !important;
}

.nomargintopbot {
	margin-top: 0px !important;
	margin-bottom: 0px !important;
}

.marginlrauto {
    margin: 10px auto;
}

.margin10 {
	margin: 10px !important;
}

.margintopbot20 {
	margin-top: 20px !important;
	margin-bottom: 20px !important;
}

.margintopbot100 {
	margin-top: 100px !important;
	margin-bottom: 100px !important;
}

.nomarginbottom {
	margin-bottom: 0px !important;
}

.marginlr10 {
	margin-left: 10px !important;
	margin-right: 10px !important;
}

.marginlr20 {
	margin-left: 20px !important;
	margin-right: 20px !important;
}

.paddingtop10 {
	padding-top: 10px !important;
}

.paddingtop45 {
	padding-top: 45px !important;
}

.paddingtop55 {
	padding-top: 55px !important;
}

.paddingright10 {
	padding-right: 10px !important;
}

.marginleft20 {
    margin-left: 20px;
}

.margintop5 {
	margin-top: 5px;
}

.margintop10 {
	margin-top: 10px;
}

.margintop15 {
	margin-top: 15px;
}

.margintop20 {
	margin-top: 20px;
}

.margintop25 {
	margin-top: 25px;
}

.margintop30 {
	margin-top: 30px;
}

.margintop45 {
	margin-top: 45px;
}

.margintop50 {
	margin-top: 50px;
}

.margintop3 {
	margin-top: 3px;
}

.margintop100 {
	margin-top: 100px;
}

.margintop30per {
	margin-top: 30%;
}

.margintop49per {
	margin-top: 49%;
}

.marginbottom2 {
	margin-bottom: 2px;
}

.marginbottom3 {
	margin-bottom: 3px;
}

.marginbottom5 {
	margin-bottom: 5px;
}

.marginbottom12 {
	margin-bottom: 12px;
}

.marginbottom15 {
	margin-bottom: 15px;
}

.marginbottom10 {
	margin-bottom: 10px;
}

.marginbottom20 {
	margin-bottom: 20px;
}

.marginbottom25 {
	margin-bottom: 25px;
}

.marginbottom30 {
	margin-bottom: 30px;
}

.marginbottom45 {
	margin-bottom: 45px;
}

.marginright5 {
	margin-right: 5px;
}

.marginright10 {
	margin-right: 10px;
}

.marginright15 {
	margin-right: 15px;
}

.marginright20 {
	margin-right: 20px;
}

.marginright30 {
	margin-right: 30px;
}

.inlinefirst {
	margin-left: 0px !important;
}

.topfirst {
	margin-top: 0px !important;
	border-top: none !important;
}

/* BG AND BORDER */

.blkbg {
	background-color: #000 !important;
	color: #FFF;
}

.dredbg {
	background-color: #050751 !important;
}

.redbg {
	background-color: #2e3092 !important;
}

.lredbg {
	background-color: #3f41be !important;
}

.redbgarrow {
	background: url(../images/arrowup.png) bottom center no-repeat #2e3092 !important;
}

.tealbg {
	background-color: #9C9 !important;
}

.whitebg {
	background-color: #FFF !important;
}

.dwhitebg {
	background-color: #EEE !important;
}

.lbluebg {
	background-color: #3f41be !important;
}

.bluebg {
	background-color: #2e3092 !important;
}

.dbluebg {
	background-color: #050751 !important;
}

.blkbg2 {
	background-color: #000;
}

.blkbg3 {
	background-color: #1c1610;
}

.yellowbg {
	background-color: #FF0;
}

.greenbg {
    background-color: #060;
}

.orangebg {
    background-color: #d39000;
}
	
.dgraybg {
	background-color: #3f3f3f !important;
}
	
.lgraybg {
	background-color: #f9f9f9 !important;
}
	
.lgraybg2 {
	background-color: #efefef !important;
}

.redborder {
	background-color: #2e3092 !important;
	height: 4px;
	width: 314px;
}

.twoborder {
	border: 2px dotted #000 !important;
}

.dropshadow {
	-webkit-box-shadow: 10px 10px 5px -6px rgba(255,255,255,0.75);
	-moz-box-shadow: 10px 10px 5px -6px rgba(255,255,255,0.75);
	box-shadow: 10px 10px 5px -6px rgba(255,255,255,0.75);
}

/* DIV PROPERTY */

.topbotborder {
	border: 1px solid #e0e0e0;
	border-left: none;
	border-right: none;
}

.underborder {
	border: 1px solid #aaa;
	border-top: none;
	border-left: none;
	border-right: none;
    background: none;
}

.nobg {
	background: none !important;
}

.topborder1 {
    border-top: 1px solid #999;
    padding-top: 10px;
}

.bottomborder1 {
    border-bottom: 1px solid #999;
    padding-bottom: 10px;
}

.bordered {
	border: 1px solid #333 !important;
}

.noborder {
	border: none !important;
}

.nobordertop {
	border-top: none !important;
}

.invisible {
	display: none !important;
}

.visible {
	display: block !important;
}

.width100per {
	width: 100%;
}

.width98per {
	width: 98%;
}

.width70per {
	width: 70%;
}

.width60per {
	width: 60%;
}

.width28 {
	width: 28px;
}

.width30 {
	width: 30px;
}

.width55 {
	width: 55px;
}

.width75 {
	width: 75px;
}

.width85 {
	width: 75px;
}

.width95 {
	width: 95px;
}

.width135 {
	width: 135px;
}

.width160 {
	width: 160px;
}

.width200 {
	width: 200px;
}

.width250 {
	width: 250px;
}

.width300 {
	width: 300px;
}

.width430 {
	width: 430px;
}

.width500 {
	width: 500px;
}

.minheight100 {
    min-height: 100px;
}

.minheight150 {
    min-height: 150px;
}

.minheight350 {
    min-height: 350px;
}

.minheight400 {
    min-height: 400px;
}

.width90per {
	width: 90%;
}

.nopadding {
	padding: 0px;
}

.padding3 {
	padding: 3px;
}

.padding7 {
	padding: 7px;
}

.padding10 {
	padding: 10px;
}

.padding20 {
	padding: 20px;
}

.padding510 {
	padding: 5px 10px;
}

.tbpadding10 {
	padding: 10px 0px !important;
}

.block {
	display: block;
    clear: both;
}

.inline {
    display: inline;
}

.inlineblock {
	display: inline-block;
	vertical-align: bottom;
	margin-left: 90px;
}

.inlineblock2 {
	display: inline-block;
	vertical-align: middle;
}

.circlediv {
	display: inline-block;
	height: 16px;
	width: 18px;
	-webkit-border-radius: 16px;
	-moz-border-radius: 16px;
	border-radius: 16px;
	background: #1d1d1d;
	margin-right: 5px;
	vertical-align: top;
	text-align: center;
	padding: 8px;
}

.circlediv2 {
	display: inline-block;
	height: 24px;
	width: 24px;
	-webkit-border-radius: 24px;
	-moz-border-radius: 24px;
	border-radius: 24px;
	background: #d2d2d2;
	margin: 15px 5px;
	vertical-align: top;
	text-align: center;
	padding: 8px;
}

.sqrdiv {
	display: inline-block;
	height: 25px;
	background: #1d1d1d;
	margin-right: 5px;
	vertical-align: top;
	text-align: center;
	padding: 8px 8px 0px 8px;1
}

.balloonholder, .balloonholderrev {	
	margin: 10px 6px 0px 6px;
	display: inline-block;
	min-height: 55px;
	height: auto;
	text-align: center;
	vertical-align: top;
	cursor: pointer;
}

.balloonholder {
	background: url(../images/redbtip.png) bottom center no-repeat;
}	

.balloonholderrev {
	background: url(../images/redbtip2.png) bottom center no-repeat;
}	

.wballoonholder {
	margin: 10px 10px 0px 10px;
	display: inline-block;
	min-height: 55px;
	height: auto;
	text-align: center;
	vertical-align: top;
	cursor: pointer;
}	

.tballoonholder {
	display: block;
	height: auto;
	background: url(../images/redbtip.png) top center no-repeat;
	cursor: pointer;
}	

.balloonholder2 {
	background: url(../images/blkbtip.png) bottom center no-repeat !important;
}	

.tballoonholder2 {
	background: url(../images/blkbtip.png) top center no-repeat !important;
}	

.balloontop {
	display: block;
	min-height: 18px;
	height: auto;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	background: #2e3092;
	text-align: center;
	margin: 0px auto;
	padding: 14px;
}

.balloontop2 {
	background: #000 !important;
}

.paddright7 {	
	padding-right: 7px !important;
}

.paddright10 {	
	padding-right: 10px !important;
}

#star-rating {
    margin-bottom: 10px;
}

input:focus,
select:focus,
textarea:focus,
button:focus {
    outline: none;
}
/*  ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    MEDIA QUERIES (RESPONSIVE WEB DESIGN)
    ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ */


/* @media Rule */
@media all and (max-width: 1100px)  /* PHONE LANDSCAPE */
{
    #slider {
        max-width: 100%; 
    }
    .header, .titlecontainer, .cmaincontainer, .bodycontainer {
        max-width: 100%;
    }
    .headertop ul, .footercontainer {
        width: 94%;
    }
    .headerbot ul {
        width: 94%;
        margin-left: -10px;
    }
    .headertop li {
        width: 94%;
        margin: 0px 2%;
    }
    .headerbot li {
        width: 94%;
        margin: 0px 4%;
    }
    .mainsplash img {
        width: 100%;
    }
    .lmaincontainer {
        max-width: 29%;
    }

    .rmaincontainer {
        max-width: 70%;
    }

    .colmaincontainer {
        max-width: 39%;
    }

    .cormaincontainer {
        max-width: 60%;
    }
    
    #divsearch {
        margin-right: 10px;
    }
}

@media all and (max-width: 948px)  /* PHONE LANDSCAPE */
{
    
    .headerbot li {
        margin: 0px 3%;
    }
    
    .midfooter {
        height: auto;
    }
    
    
}

@media all and (max-width: 830px)  /* PHONE LANDSCAPE */
{
    
    
    .lmaincontainer {
        max-width: 100%;
        width: 100%;
        min-height: 100px;
    }

    .rmaincontainer {
        max-width: 100%;
        width: 100%;
        min-height: 450px;
    }

    .colmaincontainer {
        max-width: 100%;
        width: 100%;
        min-height: 100px;
    }

    .cormaincontainer {
        max-width: 100%;
        width: 100%;
        min-height: 100px;
    }
    .amap {
        width: 94%;
        height: 56%;
    }
    
    .filter {
        width: 100%;
    }
    
    .fitem, .aitem, .pitem, .jitem {
        display: inline-block;
        width: 30%;
        margin: 0px 1% 20px 1%;
    }
    
    #prange {
        display: none;
    }
    
    
}

@media all and (max-width: 775px)  /* PHONE LANDSCAPE */
{
    .headercon {
        height: auto;
    }
    .headertop, .headerbot {
        display: none;
    }
    
    .mheadertop {
        display: block;
        height: 26px;
        width: 100%;
        padding: 12px 0px;
    }
    
    .mheadertop .mmenu {
        width: 14%;
        margin: -8px 0px 0px 0px;
        display: inline-block;
        font-size: 24px;
        color: #FFF;
        vertical-align: middle;
    }

    .mheadertop ul {
        list-style: none;
        margin: 0px 3% 0px auto;
        width: 75%;
        display: inline-block;
        text-align: right;
    }

    .mheadertop li {
        display: inline;
        cursor: pointer;
        padding-left: 0px;
        width: 100%;
        list-style-position: inside;
        color: #FFF;
        margin: 0px 0px 0px 10%;
        font-size: 1.8em;
    }
    
    .yellowbubble {
        font-size: 11px;
    }

    .floatmenu {
        display: block;
        width: 250px;
        height: 100vh;
        background: #2e3092;
        z-index: 3;
        -webkit-box-shadow: 8px -1px 25px -1px rgba(0,0,0,0.66);
        -moz-box-shadow: 8px -1px 25px -1px rgba(0,0,0,0.66);
        box-shadow: 8px -1px 25px -1px rgba(0,0,0,0.66);
    }
    
    .profilediv {
        border-bottom: 1px dashed #666;
        padding: 20px 10px;
    }

    .mainmenu div {  
        width: 90%;
        padding: 5%;
        border-bottom: 1px dashed #666;
    }

    .mainmenu div a:hover {
        color: #ffb523 !important;
    }
    
    .divwording img {
        float: none;
        width: 95%;
        margin: 10px 0px;
    }
    
    .footerlcontainer, .footerrcontainer {
        width: 100%;
    }
    .footercontainer .righttalign {
        text-align: center;
    }
    .footerrcontainer .margintop100 {
        margin-top: 40px;
    } 
    .mainsplash {
        min-height: 10px;
        padding: 0px;
    }
    .fitem, .aitem, .pitem, .jitem {
        display: inline-block;
        width: 47%;
        margin: 0px 1% 20px 1%;
    }
    .bitem {
        width: 20%;
        margin: 0px 1% 10px 1%;
    }
    .bitem .marginlr20 {
        margin-left: 2% !important;
        margin-right: 2% !important;
    }
    #divemail {
        margin: 5px auto 0px auto;
        width: 89%;
        float: none;
        display: block;
        text-align: left;
    }
    .txtemail {
        margin: 2% 3%;
        width: 85%;
    }
    .btnmail {
        width: 5%;
    }

    .fview2 {
        position: relative;
        width: 91%;
        height: auto;
        background-color: #FFF;
        z-index: 10;
        margin: 60px auto;
        padding: 15px 3%;
        border: #999 1px solid;
        border-radius: 5px;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        -webkit-box-shadow: 10px 10px 5px -6px rgba(0,0,0,0.75);
        -moz-box-shadow: 10px 10px 5px -6px rgba(0,0,0,0.75);
        box-shadow: 10px 10px 5px -6px rgba(0,0,0,0.75);
    }

    .forder, .flog, .freg, .fforgot, .fview, .fcart, .fwish, .fadd, .fdel, .fedit {
        position: relative;
        width: 91%;
        height: auto;
        max-height: 350px;
        background-color: #FFF;
        z-index: 10;
        margin: 60px auto;
        padding: 15px 3%;
        border: #999 1px solid;
        border-radius: 5px;
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        -webkit-box-shadow: 10px 10px 5px -6px rgba(0,0,0,0.75);
        -moz-box-shadow: 10px 10px 5px -6px rgba(0,0,0,0.75);
        box-shadow: 10px 10px 5px -6px rgba(0,0,0,0.75);
    }
    
    .closebutton, .mclosebutton {
        margin-left: 97%;
        margin-top: -23px;
    }

    .closebutton2 {
        margin-left: 97%;
        margin-top: -23px;
    }
    
    #aproduct #imgbig {
        width: 85% !important;
    }
    
    #aproduct #ainfo {
        width: 95% !important;
    }
    
    #ainfo .redbtn {
        display: inline-block;
        clear: both;
        margin: 25px auto 0px;
    } 
    
    #ainfoadd .aspecs {
        column-count: 1;
    }
    
    .prodcontainer, .promcontainer {
        min-height: 100px;
    }
    
}

@media all and (max-width: 500px)  /* PHONE PORTRAIT */
{

    .mheadertop ul {
        width: 64%;
    }
    
    .header {
        height: 135px;
    }
    .header img {
        display: block;
        margin: 5px auto !important;
        width: 100px;
    }
    #divsearch {
        margin: 5px auto 0px auto;
        width: 89%;
        float: none;
        display: block;
        text-align: left;
    }
    .txtsearch {
        margin: 2% 3%;
        width: 84%;
    }
    .txtemail {
        margin: 2% 3%;
        width: 83%;
    }
    .btnsearch {
        width: 5%;
    }
    .fdata20 {
        width: 19%;
    }
    .fitem, .aitem, .pitem, .jitem {
        display: block;
        width: 70%;
        margin: 0px auto 40px auto;
    }
    
    .bitem {
        width: 45%;
    }
    .ainfo .width500 {
        width: 100%;
    }
    
    .closebutton, .mclosebutton {
        margin-left: 95%;
        margin-top: -23px;
    }

    .closebutton2 {
        margin-left: 95%;
        margin-top: -23px;
    }
    
}
	

/* ==========================================================================
   Helper classes
   ========================================================================== */

/*
 * Image replacement
 */

.ir {
    background-color: transparent;
    border: 0;
    overflow: hidden;
    /* IE 6/7 fallback */
    *text-indent: -9999px;
}

.ir:before {
    content: "";
    display: block;
    width: 0;
    height: 150%;
}

/*
 * Hide from both screenreaders and browsers: h5bp.com/u
 */

.hidden {
    display: none !important;
    visibility: hidden;
}

/*
 * Hide only visually, but have it available for screenreaders: h5bp.com/v
 */

.visuallyhidden {
    border: 0;
    clip: rect(0 0 0 0);
    height: 1px;
    margin: -1px;
    overflow: hidden;
    padding: 0;
    position: absolute;
    width: 1px;
}

/*
 * Extends the .visuallyhidden class to allow the element to be focusable
 * when navigated to via the keyboard: h5bp.com/p
 */

.visuallyhidden.focusable:active,
.visuallyhidden.focusable:focus {
    clip: auto;
    height: auto;
    margin: 0;
    overflow: visible;
    position: static;
    width: auto;
}

/*
 * Clearfix: contain floats
 *
 * For modern browsers
 * 1. The space content is one way to avoid an Opera bug when the
 *    `contenteditable` attribute is included anywhere else in the document.
 *    Otherwise it causes space to appear at the top and bottom of elements
 *    that receive the `clearfix` class.
 * 2. The use of `table` rather than `block` is only necessary if using
 *    `:before` to contain the top-margins of child elements.
 */

.clearfix:before,
.clearfix:after {
    content: " "; /* 1 */
    display: table; /* 2 */
}

.clearfix:after {
    clear: both;
}

/*
 * For IE 6/7 only
 * Include this rule to trigger hasLayout and contain floats.
 */

.clearfix {
    *zoom: 1;
}

@media print,
       (-o-min-device-pixel-ratio: 5/4),
       (-webkit-min-device-pixel-ratio: 1.25),
       (min-resolution: 120dpi) {
    /* Style adjustments for high resolution devices */
}

/* ==========================================================================
   Print styles.
   Inlined to avoid required HTTP connection: h5bp.com/r
   ========================================================================== */

@media print {
    * {
        background: transparent !important;
        color: #000 !important; /* Black prints faster: h5bp.com/s */
        box-shadow: none !important;
        text-shadow: none !important;
    }

    a,
    a:visited {
        text-decoration: underline;
    }

    a[href]:after {
        content: " (" attr(href) ")";
    }

    abbr[title]:after {
        content: " (" attr(title) ")";
    }

    /*
     * Don't show links for images, or javascript/internal links
     */

    .ir a:after,
    a[href^="javascript:"]:after,
    a[href^="#"]:after {
        content: "";
    }

    pre,
    blockquote {
        border: 1px solid #999;
        page-break-inside: avoid;
    }

    thead {
        display: table-header-group; /* h5bp.com/t */
    }

    tr,
    img {
        page-break-inside: avoid;
    }

    img {
        max-width: 100% !important;
    }

    @page {
        margin: 0.5cm;
    }

    p,
    h2,
    h3 {
        orphans: 3;
        widows: 3;
    }

    h2,
    h3 {
        page-break-after: avoid;
    }
}
