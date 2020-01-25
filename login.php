<?php
	include_once 'session.php';
	include_once 'auth.php';

	if(isset($_SESSION['user'])){
		header("location: index.php");
	}

	if(isset($_POST['login'])){
		$user_check = authenticateUMA($_POST['user'], $_POST['pass']);

		if($user_check['nombre'] == NULL){
			echo 'Error';
		}else{
			$_SESSION['user'] = $user_check;
			
			if(isFirstLogin($user_check)){
				firstLoginUMA($user_check);
				header('location: perfil.php?first=1');
			}else{
				header("location: perfil.php");
			}
		}
	}

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
          <link rel="stylesheet" href="assetsIndex/bootstrap/css/bootstrap.min.css">
          <link rel="stylesheet" href="assetsIndex/css/Navegacin-APS.css">
          <link rel="stylesheet" href="assetsIndex/css/styles.css">
          <!--Head iDuma------------------------------------------------------------------------->
          <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
        	<style type="text/css" nonce="5b9f51b1b69b0f20b961db76394a99b1">
            html, body, address, blockquote, div, dl, form, h1, h2, h3, h4, h5, h6, ol, p, pre, table, ul, dd, dt, li, tbody, td, tfoot, th, thead, tr, button,   map, a, abbr, acronym, b, bdo, big, br, cite, code, dfn, em, i, img, kbd, q, samp, small, span, strong, sub, sup, tt, var, legend, fieldset {
                margin: 0;
                padding: 0;
            }

            body {
                background-color: #FFFFFF;
                font: 14px arial,helvetica,verdana,sans-serif;
                text-align: center;
                width: 100%;
            }

            #main {
                margin-left: auto;
                margin-right: auto;
                margin-top: -23px;
                text-align: left;
                width: 893px;
            }

            #adas_logo{
                margin-left: 72px;
                margin-top: 20px;
                padding-left: 0px;
                /* position: relative; */
                /* width: 893px; */
                z-index: 182;
            }

            #theme_error_authr_title{
              padding-top: 40px;
            }

            #contenedor_titulillo {
                float: left;
                margin-top: 54px;
            }

            #logo_img{
                /* height: 61px; */
                margin-top: 24px;
                float: left;
            }

            #debug{
                padding-top:40px;
            }

            #header {
                margin-bottom: 10px;
                margin-top: 10px;
                padding: 5px;
            }

            #content h1 {
                color:  #002B5E;
                font: 18pt arial,helvetica,verdana,sans-serif;
                margin: 7px 20px 2px;
                padding-bottom: 2px;
                border-bottom: dotted 1px #003366;
                text-align:center;
            }

            #content h5 {
                margin-bottom: 0.4em;
                margin-left:70px;
                margin-right:70px;
                padding-top:5px;
                border-top: #002B5E;
                color:#888;
                font-size:16px;
                text-align:center;
            }

            #content .bloque{
                margin-left:70px;
                margin-right:70px;
                margin-top:0px;
            }

            #content_debug{
                margin-top:30px;
            }

            #debug h2, #debug p {
                margin-bottom: 0.4em;
                line-height: 150%;
            }

            #debug h3 {
                border-top: 1px solid #E0E0E0;
                margin-bottom: 0.4em;
                margin-top: 1em;
                padding-top: 1em;
            }

            a {
                color: #002B5E;
                text-decoration: none;
            }

            .notes_texts {
                display: none;
                margin-left: auto;
                margin-right: auto;
                margin-top: 14px;
                text-align: center;
                width: 740px;
            }

            .disabled_button{
                background: none repeat scroll 0 0 #DDDDDD;
                height: 62px;
                margin-top: -62px;
                opacity: 0.6;
                position: absolute;
                width: 92px;
                -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=60)";
                filter: alpha(opacity = 60);
                -moz-opacity:0.6;
                -khtml-opacity: 0.6;
                z-index: 140;
                cursor: default;
            }

            .disabled_login{
                background: none repeat scroll 0 0 #DDDDDD;
                height: 26px;
                margin-top: -46px;
                opacity: 0.6;
                position: absolute;
                width: 328px;
                -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=60)";
                filter: alpha(opacity = 60);
                -moz-opacity:0.6;
                -khtml-opacity: 0.6;
                z-index: 140;
                cursor: default;
            }

            .disabled_submit{
                opacity: 0.6;
                -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=60)";
                filter: alpha(opacity = 60);
                -moz-opacity:0.6;
                -khtml-opacity: 0.6;
                cursor: default;
            }

            #identificacion{
                width:100%;
            }

            #identificacion td{
                width:350px;
            }

            #par {
                border-right: dotted 1px #003366;
                padding-top: 10px;
                padding-right: 20px;
                width:350px;
            }

            #auten_delegadas{
                padding-left: 20px;
                padding-top: 10px;
            }

            td#auten_delegadas h2 {
                margin-left: 20px;
                text-align: left;
            }

            /* Para el signo de interrogacion */
            #question1 {
                margin: -25px 0 0 300px;
                position: absolute;
            }

            #question_right {
                margin: -25px 0 0 300px;
                position: absolute;
            }

            .footer {
                float: right;
                margin-top: 14px;
                text-align: center;
                width: 420px;
            }

            #copyright{
                color: #002B5E;
                font-size: 9pt;
                margin-top: 30px;
            }

            h1 {
                color: #002B5E;
                font-size: 24px;
            }

            h2 {
                color: #002B5E;
                font-size: 15px;
                text-transform: uppercase;
                text-align: center;
            }

            h3 {
                color: #666;
                font-size: 13px;
            }

            .text-question, p {
                color: #555;
                font-size: 10pt;
                margin-bottom: .3em;
            }

            .text-field {
                border-radius: 7px;
                -moz-border-radius: 7px;
                -webkit-border-radius: 7px;
                -ms-border-radius: 7px;
                -khtml-border-radius: 7px;
                line-height: 20px;
                height: 20px;
                border: 1px solid #002b5e;
                float: right;
                margin-right: 55px;
                margin-top: -48px;
                width: 200px;
            }

            .form-item {
                margin-bottom: 20px;
            }

            .form-col1{
                background: #003366;
                background: -moz-linear-gradient(top, #003366 50%, #002B5E 100%);
                background: -webkit-gradient(linear, left top, left bottom, color-stop(50%,#003366), color-stop(100%,#002B5E)); /* Chrome,Safari4+ */
                background: -webkit-linear-gradient(top,  #003366 50%,#002B5E 100%); /* Chrome10+,Safari5.1+ */
                background: -o-linear-gradient(top,  #003366 50%,#002B5E 100%); /* Opera 11.10+ */
                background: -ms-linear-gradient(top,  #003366 50%,#002B5E 100%); /* IE10+ */
                background: linear-gradient(top,  #003366 50%,#002B5E 100%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#003366', endColorstr='#002B5E',GradientType=0 ); /* IE6-8 */
                border-radius: 7px;
                -moz-border-radius: 7px;
                -webkit-border-radius: 7px;
                -ms-border-radius: 7px;
                -khtml-border-radius: 7px;
                -moz-box-shadow:    3px 3px 0px 0px #ddd;
                -webkit-box-shadow: 3px 3px 0px 0px #ddd;
                box-shadow:         3px 3px 0px 0px #ddd;
                color:#fff;
                line-height: 22px;
                padding: 2px 2px 2px 10px;
                width:90%;
                -webkit-text-size-adjust: 100%;

            }

            .form-col2{
                margin-right: -11px;
                margin-top:20px;
            }

              #edit-name-wrapper, #edit-pass-wrapper{
                  margin-top:0px;
              }

              /*
              #auten_delegadas{
                  padding-top:10px;
              }
              */

              #submit_ok, #status_close_session, .button_class{
                  color:#fff;
                  background: #003366; /* Old browsers */
                  background: -moz-linear-gradient(top, #003366 50%, #002B5E 100%);
                  background: -webkit-gradient(linear, left top, left bottom, color-stop(50%,#003366), color-stop(100%,#002B5E)); /* Chrome,Safari4+ */
                  background: -webkit-linear-gradient(top,  #003366 50%,#002B5E 100%); /* Chrome10+,Safari5.1+ */
                  background: -o-linear-gradient(top,  #003366 50%,#002B5E 100%); /* Opera 11.10+ */
                  background: -ms-linear-gradient(top,  #003366 50%,#002B5E 100%); /* IE10+ */
                  background: linear-gradient(top,  #003366 50%,#002B5E 100%); /* W3C */
                  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#003366', endColorstr='#002B5E',GradientType=0 ); /* IE6-8 */
                  line-height: 22px;
                  text-transform: uppercase;
                  padding:2px;
                  text-align: center;
                  font-size: 12px;
                  border-radius: 7px;
                  -moz-border-radius: 7px;
                  -webkit-border-radius: 7px;
                  -ms-border-radius: 7px;
                  -khtml-border-radius: 7px;
                  border: 1px solid #003366;
                  /* margin-top:10px; */
                  margin-top: 0px;
              }

              .own-button{
                  background: #003366; /* Old browsers */
                  background: -moz-linear-gradient(top, #003366 50%, #002B5E 100%);
                  background: -webkit-gradient(linear, left top, left bottom, color-stop(50%,#003366), color-stop(100%,#002B5E)); /* Chrome,Safari4+ */
                  background: -webkit-linear-gradient(top,  #003366 50%,#002B5E 100%); /* Chrome10+,Safari5.1+ */
                  background: -o-linear-gradient(top,  #003366 50%,#002B5E 100%); /* Opera 11.10+ */
                  background: -ms-linear-gradient(top,  #003366 50%,#002B5E 100%); /* IE10+ */
                  background: linear-gradient(top,  #003366 50%,#002B5E 100%); /* W3C */
                  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#003366', endColorstr='#002B5E',GradientType=0 ); /* IE6-8 */
              }

              .button-cont{
                  line-height: 22px;
                  z-index: 101;
                  text-transform: uppercase;
              }

              .button-icon {
                  width: 85px;
                  height: 56px;
                  position: absolute;
                  top: 0;
              }

              .button-text {
                  text-transform: none;
                  position: absolute;
                  bottom: 0px;
                  width: 85px;
                  line-height: 14px;
                  font-size: 12px;
              }

              .button-layout{
                  text-align: center;
                  /*background-image: -moz-linear-gradient(0% 65% 90deg, rgb(26, 112, 32), rgb(34, 148, 43));
                  background-image: -webkit-gradient(linear, 0% 0%, 0% 68%, from(#003366), to(#002B5E));*/
                  background: #003366; /* Old browsers */
                  background: -moz-linear-gradient(top, #003366 50%, #002B5E 100%);
                  background: -webkit-gradient(linear, left top, left bottom, color-stop(50%,#003366), color-stop(100%,#002B5E)); /* Chrome,Safari4+ */
                  /* IE9 SVG, needs conditional override of 'filter' to 'none' */
                  background: -webkit-linear-gradient(top,  #003366 50%,#002B5E 100%); /* Chrome10+,Safari5.1+ */
                  background: -o-linear-gradient(top,  #003366 50%,#002B5E 100%); /* Opera 11.10+ */
                  background: -ms-linear-gradient(top,  #003366 50%,#002B5E 100%); /* IE10+ */
                  background: linear-gradient(top,  #003366 50%,#002B5E 100%); /* W3C */
                  filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#003366', endColorstr='#002B5E',GradientType=0 ); /* IE6-8 */
                  width:85px;
                  height: 13px;
                  padding:2px;
                  font-size: 12px;
                  border-radius: 7px;
                  -moz-border-radius: 7px;
                  -webkit-border-radius: 7px;
                  -ms-border-radius: 7px;
                  -khtml-border-radius: 7px;
                  border: 1px solid #003366;
                  color:#fff;
                  vertical-align:bottom;
                  padding-top:45px;
                  position: relative;
              }

              #multiple_id .form-item{
                  width:430px;
              }

              #multipleid_button{
                  margin-top: 30px;
                  position: absolute;
              }

              #edit-name-wrapper .form-col2 select{
                  margin-right:43px;
                  border: 4px solid #fff;
                  height: 24px;
              }

              .login-box{
                  display:block;
                  *padding-top:0px;
                  height: auto;
              }

              .wayf_button_cl{
                  position:relative;
              }

              .remember_button_cl{
                  margin-top: -10px;
                  position:relative;
              }

              .more_info_button_cl a{
                  font-size: 11px;
                  color:#1A7020
              }

              #userpass {
                  margin-top:20px;
              }

              #userpass div{
                  margin-bottom:20px;
              }

              #enlaces_UMA, #enlaces_wayf{
                  clear: both;
                  font-size: 12px;
                  /* padding: 40px 0 0 20px; */
                  padding: 6px 0 0 20px;
              }

              #enlaces_UMA ul, #enlaces_wayf ul {
                  list-style-type: none;
              }

              #enlaces_UMA li, #enlaces_wayf li {
                  line-height: 2.5em;
              }

              #icon_nopuedoentrar, #icon_nuevoenuma, #icon_pinuma, #icon_otraorganizacion {
                  vertical-align: middle;
              }

              #ayuda_usuario, #soy_nuevo, #pedir_pin, #wayf_button {
                  margin-left: 4px;
              }

              #otherlogin {
                  /* height: 170px; */
                  height: 124px;
                  margin-left: auto;
                  margin-right: auto;
                  margin-top: 1em;
                  overflow: hidden;
                  text-align: center;
                  width: 281px;
              }

              #holder {
                  height: 150px;
                  overflow: hidden;
                  position: relative;
                  text-align: center;
              }

              #holder li {
                  float: left;
                  list-style: none outside none;
                  margin-bottom: 9%;
                  margin-left: 8%;
                  margin-right: 8%;
              }

              button {
                  width: 160px;
                  margin-bottom: 7px;
              }

              #number-links {
                  text-align: right;
                  margin-right: 16px;
                  margin-top: 4px;
                  color: #555;
              }

              #number-links .active {
                  color: #555;
              }

              .error_msg {
                  padding: 4px;
                  margin-bottom: 0em;
              }

              .error_subtitle{
                  margin-right:40px;
                  margin-left:40px;
              }

              .list-slo-sps {
                  color: #000;
                  font-size: 10pt;
                  line-height: 150%;
                  margin-bottom: .3em;
                  padding-left: 1em;
              }

              .list-slo-sps li {
                  margin-bottom: .3em;
                  list-style: none;
                  text-decoration: none;
              }

              .sp-nologout {
                  color: #AF1111;
              }

              #sp-logout-request {
                  font-weight: bold;
                  border-bottom: 1px solid #E0E0E0;
              }

              #notlogout {
                  color: #002B5E;
                  display: none;
              }

              .highlight_lang{
                  color: #fff;
                  font-weight: bold;
              }
              #langs{
                  float:right;
                  margin-bottom:2px;
                  color:#fff;
                  cursor:pointer;
                  margin-right: 20px;
                  margin-top: 10px;
              }
              #wayf_button{
                  text-align:left;
                  font-size: 12px;
              }
              #remember_button{
                  font-size: 11px;
                  color:#003366    }
              #wayf_button_close, #wayf_button_close2{
                  font-size: 14px;
                  color: #002B5E;
                  cursor:pointer;
              }
              #wayf_button_close_div{
                  position: absolute;
                  text-align: right;
                  width: 90%;
              }
              #wayf_button_close:hover {
                  cursor: pointer;
              }
              #wayfholder{
                  margin-top: 30px;
                  margin-bottom: 20px;
                  text-align:center;
                  padding-left:10%;
                  padding-right:10%;
              }
              #wayfholder ul{
                  margin-bottom: 10px;
                  text-align:center;
              }
              #wayfholder li{
                  float: left;
                  list-style: none outside none;
                  margin-bottom: 5%;
                  margin-left: 8%;
              }
              #wayfholder li .own-button {
                  width: 390px;
              }
              #wayfotherlogin{
                  text-align: center;
                  background-color: #F7F4F0;
                  padding:20px;
                  position: absolute;
                  margin: auto;
                  left: 45%;
                  top: 20%;
                  margin-left: -200px;
                  width: 500px;
                  min-height: 300px;
                  border: 1px solid #E0E0E0;
                  border-radius: 7px;
                  -moz-border-radius: 7px;
                  -webkit-border-radius: 7px;
                  -ms-border-radius: 7px;
                  -khtml-border-radius: 7px;
                  z-index: 999;
              }
              #background_wayf{
                  background: #000000 no-repeat center center fixed;
                  position: absolute;
                  left: 0;
                  top: 0;
                  margin: 0;
                  padding: 0;
                  width: 100%;
                  height: 100%;
                  z-index: 990;
                  filter:alpha(opacity=60); /*IE*/
                  -moz-opacity:.60;/*Firef*/
                  opacity:.60 /*Safari*/
              }
              /*
               * Error page
              */

              #tech_error_info{
                  padding-left:20px;
                  padding-bottom: 10px;
                  border:solid 1px #C7C7C7;
              }
              .exception_trace{
                  font-size: 12px;
                  padding: 10px;
                  margin: 0;
                  background: #f0f0f0;
                  border-left: 1px solid #ccc;
                  border-bottom: 1px solid #ccc;
                  line-height: 14px; /*--Height of each line of code--*/
                  width: 700px;
                  overflow: auto;
                  overflow-Y: hidden;  /*--Hides vertical scroll created by IE--*/
              }
              .exception_params_list li{
                  margin-bottom: .3em;
                  margin-left:10px;
                  text-decoration: none;
              }
              .exception_params_list{
                  color: #454C50;
                  font-size: 10pt;
                  line-height: 150%;
                  margin-bottom: .3em;
                  padding-left: 1em;
              }
              .exception_subtitle{
                  font-weight: bold;
                  margin-top:20px;
                  color: #002B5E;
              }
              .exception_title{
                  margin-top:20px;
              }
              #error_text2_button{
                  margin-top:20px;
                  margin-bottom:10px;
                  font:13px arial,helvetica,verdana,sans-serif;
                  text-align: center;
              }
              #footer_error{
                  position:absolute;
              }

              #cream_bar{
                  background-color: #FFFFFF;
                  width:100%;
                  height: 60px;
                  border-top:2px solid #fff;
                  border-bottom:2px solid #fff;
                  z-index:2;
                  position:relative;
                  text-align:left;
              }
              #content {
                  /* background-image: url("https://idp.uma.es/adas/themes/uma-1.7.0/img/tab_login_top_no_shadow.png"), url("https://idp.uma.es/adas/themes/uma-1.7.0/img/tab_login_middle.png"); */
                  background-image: url("https://idp.uma.es/adas/themes/uma-1.7.0/img/tab_login_uma.png");
                  background-position: 18px 4px, center 0;
                  background-repeat: no-repeat;
                  /* padding: 2px; */
                  min-height: 520px;
              }
              #content_bottom{
                  /* background: url("https://idp.uma.es/adas/themes/uma-1.7.0/img/tab_login_bottom.png") no-repeat scroll center center rgba(0, 0, 0, 0); */
                  height:53px;
                  margin-top:-52px;
              }
              #content_middle{
                  /* background: url("https://idp.uma.es/adas/themes/uma-1.7.0/img/tab_login_middle.png") repeat-y scroll center center rgba(0, 0, 0, 0); */
                  height: 10px;
                  margin-top:0px;
                  padding-top: 0px;
              }
              .texttoolong{
                  overflow-x:auto;
                  overflow-y: hidden;
              }

              /* JAAD-2018.04.30 */
              #informacion_seguridad{
                  margin-top: 4px;
                  margin-right: 50px;
                  float: left;
                  margin-left: 10px;
              }
              .footer img {
                  float: left;
                  margin-left: 40px;
              }

              @media all and (max-width: 810px) and (min-width: 771px){ //tope mínimo sin ajustes: 890px
                  body { -webkit-text-size-adjust: 100%; }
                  body{
                      min-width:230px;
                      height:auto;
                  }

                  div{
                      height:auto;
                  }

                  body, #no_scroll {
                      overflow-x:hidden;
                      //position: fixed;
                  }
                  #main{
                      width: 850px;
                  }
                  #content{
                      width: 800px;
                      background-position: 0px 0px, center 0px;
                      padding-right: 500px;
                  }

                  #identificacion{
                      margin-left: 0px;
                  }

                  #par {

                      border-right: 1px dotted #22942B;
                      padding-right: 15px;
                      padding-left: 10px;

                  }
                  #auten_delegadas {
                      padding-left: 15px;
                  }
                  #nota1, #nota2 {
                      font-size: 10pt;
                  }


                  .form-col1{
                      width: 280px;
                  }
                  .text-field{
                      margin-right: 30px;
                      width: 170px;
                      height: 20px;
                  }

                  #content_bottom {
                      margin-left: 0px;
                  }

                  #wayfotherlogin{
                      min-height: 100px;
                  }

                  .exception_trace{
                      width: 600px;
                  }

          	/*Añadido por PRiSE 20180205*/
           	#contenedor_titulillo {
                          margin-left: 127px;
                          margin-top: -36px;
              	}
           	/*Fin 20180205*/

              }

              @media all and (max-width: 770px) and (min-width: 681px){ //para 720px, 736px y 768px
                  body { -webkit-text-size-adjust: 100%; }
                  div{
                      height:auto;
                  }

                  body, #no_scroll {
                      overflow-x:hidden;
                      //position: fixed;
                  }
                  #main{
                      width: 800px;
                  }
                  #content{
                      width: 720px;
                      background-position: 0px 0px, center 0px;
                      padding-right: 500px;
                  }
                  #langs{
                      font-size: 13px;
                  }


                  #identificacion{
                      margin-left: 0px;
                  }

                  #par {

                      border-right: 1px dotted #22942B;
                      padding-right: 35px;

                  }
                  #auten_delegadas {
                      padding-left: 35px;
                  }
                  #nota1, #nota2 {
                      font-size: 13px;
                  }

                 .form-col1{
                      width: 280px;
                      -webkit-text-size-adjust: 100%;
                  }
                  .text-field{
                      margin-right: 12px;
                      width: 170px;
                      height: 20px;
                  }

                  #content_bottom {
                      margin-left: 0px;
                  }

                  #wayfotherlogin{
                      padding: 20px 0px;
                      left: 300px;
                      min-height: 100px;
                  }

                  #content .bloque {
                      margin-left:40px;
                      margin-right: 40px;
                      max-width: 670px;
                  }
                  .exception_trace{
                      width: 575px;
                  }
                  textarea{
                      width: 480px;
                      margin-left: -10px;
                  }
          	/*Añadido por PRiSE 20180205*/
                  #contenedor_titulillo {
                          margin-left: 127px;
                          margin-top: -36px;
                  }
                  /*Fin 20180205*/

              }

              @media all and (max-width: 680px) and (min-width: 621px){ //para 640px y 667px
                  body { -webkit-text-size-adjust: 100%; }
                  body{
                      min-width:230px;
                      height:auto;
                  }
                  div{
                      height: auto;
                  }
                  body, #no_scroll {
                      overflow-x:hidden;
                      //position: fixed;
                  }
                  #main{
                      width: 700px;
                  }
                  #content{
                      background-image: url("https://idp.uma.es/adas/themes/uma-1.7.0/img/tab_login_top_no_shadow.png");
                      width: 620px;
                      background-position: 0px 0px, center 0px;
                      padding-right: 500px;
                  }
                  #langs{
                      font-size: 13px;
                  }

                  #identificacion{
                      margin-left: 0px;
                  }

                  #par {
                      border-right: none;
                      padding-right: 0px;
                      border-bottom: 1px dotted #22942B;
                      padding-bottom: 0px;
                      position: absolute;
                      margin-left: 90px;
                      margin-right: 90px;
                  }
                  #auten_delegadas {
                      float: left;
                      padding: 280px 0px 0px;
                      margin-left: 90px;
                      margin-right: 90px;
                  }

                  .notes_texts{
                      width: 600px;
                      margin-top: 20px;
                  }
                  #nota1, #nota2 {
                      font-size: 13px;
                  }

                  #content_bottom {
                      margin-left: -100px;
                  }

                  #wayfotherlogin{
                      padding: 20px 0px;
                      left: 255px;
                      min-height: 100px;
                  }

                  #content .bloque {
                      margin-left:40px;
                      margin-right: 40px;
                      max-width: 580px;
                  }
                  .exception_trace{
                      width: 475px;
                  }
                  .form-col1{
                      height: 24px;
                      -webkit-text-size-adjust: 100%;
                  }

                  textarea{
                      width: 420px;
                      margin-left: -30px;
                  }
                  /*Añadido por PRiSE 20180205*/
                  #contenedor_titulillo {
                          margin-left: 127px;
                          margin-top: -70px;
                  }
          	/*Fin 20180205*/

                  /* JAAD-2018.04.30 */
                  #informacion_seguridad{
                      margin-top: 4px;
                      margin-right: 50px;
                      float: left;
                      margin-left: 10px;
                  }
                  .footer img {
                      float: left;
                      margin-left: 40px;
                  }
              }

              @media all and (max-width: 620px){
                  body { -webkit-text-size-adjust: 100%; }
                  body{
                      min-width:230px;
                      height:auto;
                  }
                  div{
                      height: auto;
                  }
                  body, #no_scroll {
                      overflow-x:hidden;
                      //position: fixed;
                  }
                  #main{
                      width: 670px;
                  }
                  #content{
                      background-image: url("https://idp.uma.es/adas/themes/uma-1.7.0/img/tab_login_top_no_shadow.png");
                      width: 620px;
                      background-position: 0px 0px, center 0px;
                      padding-right: 500px;
                  }
                  #langs{
                      font-size: 13px;
                  }

                  #identificacion{
                      margin-left: 0px;
                  }

                  #par {
                      border-right: none;
                      padding-right: 0px;
                      border-bottom: 1px dotted #22942B;
                      padding-bottom: 0px;
                      position: absolute;
                      margin-left: 70px;
                      margin-right: 70px;
                  }
                  #auten_delegadas {
                      float: left;
                      padding: 280px 0px 0px;
                      margin-left: 70px;
                      margin-right: 70px;
                  }

                  .notes_texts{
                      width: 520px;
                      margin-top: 20px;
                  }
                  #nota1, #nota2 {
                      font-size: 13px;
                  }

                  #content_bottom {
                      margin-left: -100px;
                  }

                  #wayfotherlogin{
                      padding: 20px 0px;
                      left: 255px;
                      min-height: 100px;
                  }

                  #content .bloque {
                      margin-left:40px;
                      margin-right: 40px;
                      max-width: 580px;
                  }
                  .exception_trace{
                      width: 475px;
                  }
                  .form-col1{
                      height: 22px;
                      -webkit-text-size-adjust: 100%;
                  }
                  textarea{
                      width: 380px;
                      margin-left: -50px;
                      font-size: 12px;
                  }
                  /*Añadido por PRiSE 20180205*/
                  #contenedor_titulillo {
                          margin-left: 127px;
                          margin-top: -70px;
                  }
          	/*Fin 20180205*/

                  /* JAAD-2018.04.30 */
                  #informacion_seguridad{
                      margin-top: 4px;
                      margin-right: 50px;
                      float: left;
                      margin-left: 10px;
                  }
                  .footer img {
                      float: left;
                      margin-left: 40px;
                  }
              }

              @media all and (max-width: 570px){ //para 533px, 540 px y 568px

                  div{
                      height:auto;
          	}
                  body, #no_scroll {
                      overflow-x:hidden;
                      //position: fixed;
                  }
                  #main{
                      width: 595px;
                  }
                  #content{
                      width: 515px;
                      background-position: 0px 0px, center 0px;
                      padding-right: 500px;
                  }
                  #langs{
                      font-size: 13px;
                  }
                  #adas_logo{
                      margin: 15px auto -30px;
                      padding-left: 39px;
                  }
                  #logo_img{
                   /*   margin-top: auto;*//* Comentado por PRiSE 20180205 */
                   /*   width: 260px;*//* Comentado por PRiSE 20180205 */
                 height: auto;
                  }
                  #cream_bar{
                      height: 80px;
                  }

                  #identificacion{
                      margin-left: 0px;
                  }

                  #par {
                      border-right: none;
                      padding-right: 0px;
                      border-bottom: 1px dotted #22942B;
                      padding-bottom: 30px;
                      position: absolute;
                      margin-left: 30px;
                      margin-right: 30px;
                  }
                  #auten_delegadas {
                      float: left;
                      padding: 280px 0px 0px;
                      margin-left: 25px;
                      margin-right: 25px;
                  }

                  .login-box{
                      padding-top: 0px;
                      margin-bottom: 10px;
                  }
                  #submit_ok.gradient{
                      margin-top: 0px;
                  }

                  .notes_texts{
                      width: 480px;
                      margin-top: 20px;
                  }

                  #content_bottom {
                      margin-left: -180px;
                  }

                  #wayfotherlogin{
                      width: 400px;
                      padding: 20px 0px;
                      left: 255px;
                      min-height: 100px;
                  }

                  #wayfholder li {
                      margin-bottom: 4%;
                      margin-left: 6%;
                  }


                  #wayf_button{
                      font-size: 16px;
                  }
                  #remember_button{
                      font-size: 13px;
                  }


                  ul#wayfholder{
                      padding-left: 5%;
                      padding-right: 5%;
                  }
                  #number-links{
                      font-size: 18px;
                  }

                  #content .bloque {
                      margin-left:40px;
                      margin-right: 40px;
                      max-width: 430px;
                  }
                  .exception_trace{
                      width: 365px;
                  }
                  .form-col1{
                      height: 22px;
                      -webkit-text-size-adjust: 100%;
                  }
                  textarea{
                      width: 350px;
                      margin-left: -70px;
                      font-size: 12px;
                  }
                  /*Añadido por PRiSE 20180205*/
                  #contenedor_titulillo {
          		margin-left: 100px;
          		margin-top: -70px;
                  }
                  /*Fin 20180205*/

                  /* JAAD-2018.04.30 */
                  #informacion_seguridad{
                      margin-top: 4px;
                      margin-right: 50px;
                      float: left;
                      margin-left: 10px;
                  }
                  .footer img {
                      float: left;
                      margin-left: 40px;
                  }
              }

              @media all and (max-width: 490px){ //para 480px
          	body { -webkit-text-size-adjust: 100%; }
                  div{
                      height:auto;
          	}
                  body, #no_scroll {
                      overflow-x:hidden;
                      //position: fixed;
                  }
                  #main{
                      margin-left: -10px;
                      margin-right: auto;
                      margin-top: -30px;
                      text-align: left;
                      width: 560px;
                  }
                  #content{
                      width: 500px;
                      background-position: 0px 0px, center 0px;
                      padding-right: 500px;
                  }
                  #langs{
                      font-size: 12px;
                      margin-right: 10px;
                  }
                  #adas_logo{
                      margin: 15px auto -30px;
                      padding-left: 39px;
                  }
                  #logo_img{
                   /*   margin-top: auto;*//* Comentado por PRiSE 20180205 */
                   /*   width: 260px;*//* Comentado por PRiSE 20180205 */
                      height: auto;
                  }
                  #cream_bar{
                      height: 80px;
                  }

                  #identificacion{
                      margin-left: 0px;
                  }

                  #par {
                      border-right: none;
                      padding-right: 0px;
                      border-bottom: 1px dotted #22942B;
                      padding-bottom: 0px;
                      position: absolute;
                      margin-left: 30px;
                      margin-right: 30px;
                  }
                  #auten_delegadas {
                      float: left;
                      padding: 280px 0px 0px;
                      margin-left: 25px;
                      margin-right: 25px;
                  }

                  .login-box{
                      padding-top: 0px;
                      margin-bottom: 10px;
                  }
                  #submit_ok.gradient{
                      margin-top: 0px;
                  }
                  .form-col1{
                      font-size: 12px;
                      -webkit-text-size-adjust: 100%;
                      //width: XXpx; // Disminuye barra verde
                  }
                  .text-field{
                      height: 20px;
                  }

                  .notes_texts{
                      width: 430px;
                      margin-top: 20px;
                  }

                  #content_bottom {
                      margin-left: -200px;
                  }

                  #wayfotherlogin{
                      width: 350px;
                      padding: 20px 0px;
                      left: 255px;
                      min-height: 100px;
                  }

                  #wayfholder li {
                      margin-bottom: 3%;
                      margin-left: 4%;
                  }
                  #holder li {
                      margin-bottom: 7%;
                      margin-left: 5%;
                      margin-right: 5%;
                  }
                  h1#wayf_title{
                      font-size: 20px;
                  }

                  #wayf_button{
                      font-size: 18px;
                  }
                  #remember_button{
                      font-size: 15px;
                  }

                  #otherlogin {
                      margin-left: 60px;
                  }

                  ul#wayfholder{
                      padding-left: 5%;
                      padding-right: 5%;
                  }
                  #number-links{
                      font-size: 20px;
                  }

                  #content .bloque {
                      margin-left:40px;
                      margin-right: 40px;
                      max-width: 400px;
                  }
                  .exception_trace{
                      width: 340px;
                  }
                  .form-col1{
                      height: 22px;
                      -webkit-text-size-adjust: 100%;
                  }

                  textarea{
                      width: 320px;
                      margin-left: -90px;
                      font-size: 12px;
                  }
                  /*Añadido por PRiSE 20180205*/
                  #contenedor_titulillo {
          		margin-left: 100px;
          		margin-top: -70px;
                  }
                  /*Fin 20180205*/

                  /* JAAD-2018.04.30 */
                  #informacion_seguridad{
                      margin-top: 4px;
                      margin-right: 50px;
                      float: left;
                      margin-left: 10px;
                  }
                  .footer img {
                      float: left;
                      margin-left: 40px;
                  }
              }

              @media all and (max-width: 450px){ // para 420px
          	body { -webkit-text-size-adjust: 100%; }

                  div{
                      height:auto;
          	}
                  body, #no_scroll {
                      overflow-x:hidden;
                      //position: fixed;
                  }
                  #main{
                      margin-left: -10px;
                      margin-right: auto;
                      margin-top: -30px;
                      text-align: left;
                      width: 500px;
                  }
                  #content{
                      width: 425px;
                      background-position: 0px 0px, center 0px;
                      padding-right: 500px;
                  }
                  #langs{
                      font-size: 12px;
                      margin-right: 10px;
                  }
                  #adas_logo{
                      margin: 15px auto -30px;
                      padding-left: 39px;
                  }
                  #logo_img{
                   /*   margin-top: auto;*//* Comentado por PRiSE 20180205 */
                   /*   width: 260px;*//* Comentado por PRiSE 20180205 */
                      height: auto;
                  }
                  #cream_bar{
                      height: 80px;
                  }

                  #identificacion{
                      margin-left: -25px;
                  }

                  #par {
                      border-right: none;
                      padding-right: 0px;
                      border-bottom: 1px dotted #22942B;
                      padding-bottom: 0px;
                      position: absolute;
                      margin-left: 30px;
                      margin-right: 30px;
                  }
                  #auten_delegadas {
                      float: left;
                      padding: 260px 0px 0px;
                      margin-left: 15px;
                      margin-right: 15px;
                              margin-top: 30px; /*Añadido por PRiSE 20180320*/
          	}

                  .login-box{
                      padding-top: 0px;
                      margin-bottom: 10px;
                  }
                  #submit_ok.gradient{
                      margin-top: 0px;
                  }
                  .form-col1{
                      font-size: 12px;
                      -webkit-text-size-adjust: 100%;
                      //width: XXpx; // Disminuye barra verde
                  }conte
                  .text-field{
                      height: 20px;
                  }

                  .notes_texts{
                      width: 380px;
                      margin-top: 20px;
                  }

                  #content_bottom {
                      margin-left: -250px;
                  }

                  #wayfotherlogin{
                      width: 350px;
                      padding: 20px 0px;
                      left: 255px;
                      min-height: 100px;
                  }

                  #wayfholder li {
                      margin-bottom: 3%;
                      margin-left: 4%;
                  }
                  #holder li {
                      margin-bottom: 7%;
                      margin-left: 5%;
                      margin-right: 5%;
                  }
                  h1#wayf_title{
                      font-size: 20px;
                  }

                  #wayf_button{
                      font-size: 18px;
                  }
                  #remember_button{
                      font-size: 15px;
                  }

                  #otherlogin {
                      margin-left: 60px;
                  }

                  ul#wayfholder{
                      padding-left: 5%;
                      padding-right: 5%;
                  }
                  #number-links{
                      font-size: 20px;
                  }

                  #content .bloque {
                      margin-left:40px;
                      margin-right: 40px;
                      max-width: 400px;
                  }
                  .exception_trace{
                      width: 280px;
                  }
                  #tech_error_info p{
                      width: 300px;
                  }
                  .form-col1{
                      height: 22px;
                      -webkit-text-size-adjust: 100%;
                  }
                  textarea{
                      width: 280px;
                      margin-left: -100px;
                      font-size: 11px;
                  }
                  /*Añadido por PRiSE 20180205*/
                  #contenedor_titulillo {
                          margin-left: 100px;
                          margin-top: -70px;
                  }
                  /*Fin 20180205*/

                  /* JAAD-2018.04.30 */
                  #informacion_seguridad{
                      margin-top: 4px;
                      margin-right: 50px;
                      float: left;
                      margin-left: 10px;
                  }
                  .footer img {
                      float: left;
                      margin-left: 40px;
                  }
              }

              @media all and (max-width: 390px){ // para 360px y 380px
          		body { -webkit-text-size-adjust: 100%; }

                  div{
                      height:auto;
          	}
                  body, #no_scroll {
                      overflow-x:hidden;
                      //position: fixed;
                  }
                  #main{
                      margin-left: -20px;
                      margin-right: auto;
                      margin-top: -20px;
                      text-align: left;
                      width: 440px;
                  }
                  #content{
                      width: 385px;
                      background-position: 0px 0px, center 0px;
                      padding-right: 500px;
                  }
                  #langs{
                      font-size: 11px;
                      margin-right: 10px;
                  }
                  #adas_logo{
                      margin: 10px auto -30px;
                      padding-left: 26px;
                  }
                  #logo_img{
                   /*   margin-top: auto;*//* Comentado por PRiSE 20180205 */
                   /*   width: 225px;*//* Comentado por PRiSE 20180205 */
                      height: auto;
                  }
                  #cream_bar{
                      height: 60px;
                  }

                  #texto_titulo, #error_title, #status_title{
                      font-size:20px;
                  }
                  #texto_subtitulo.subtitle{
                      font-size: 14px;
                  }

                  #identificacion{
                      margin-left: 0px;
                  }
                  #identificacion td{
                      width: 245px;
                  }
                  #par {
                      border-right: none;
                      padding-right: 0px;
                      border-bottom: 1px dotted #22942B;
                      padding-bottom: 30px;
                      position: absolute;
                      margin-left: 15px;
                      margin-right: 15px;
                  }
                    /*Añadido por PRiSE 20180320*/
                   td#par #question1 {
                          margin: -25px 0 0 255px;
                          position: absolute;
                  }
                  /*Añadido por PRiSE 20180320*/
                  td#auten_delegadas img {
                          margin: -25px 0 0 275px;
                           position: absolute;
                  }
          	 #auten_delegadas {
                      float: left;
                      padding: 300px 0px 0px;
                      margin-left: -10px;
                      margin-right: 0px;
                      margin-top: 30px; /*Añadido por PRiSE 20180320*/
          	 }

                  .login-box{
                      padding-top: 0px;
                      margin-bottom: 10px;
                  }
                  #submit_ok.gradient{
                      margin-top: 0px;
                  }
                  .form-col1{
                      font-size: 11px;
                      width: 235px;
                      -webkit-text-size-adjust: 100%;
                  }
                  .text-field{
                      margin-right: 10px;
                      width: 150px;
                      height: 20px;
                  }

                  .notes_texts{
                      width: 290px;
                      margin-top: 15px;
                  }

                  #content_bottom {
                      margin-left: -215px;
                  }

                  #wayfotherlogin{
                      width: 225px;
                      padding: 20px 0px;
                      left: 260px;
                      min-height: 100px;
                  }

                  #wayfholder li {
                      margin-bottom: 3%;
                      margin-left: 4%;
                  }
                  #holder li {
                      margin-bottom: 5%;
                      margin-left: 3%;
                      margin-right: 3%;
                  }
                  h1#wayf_title{
                      font-size: 16px;
                  }

                  #wayf_button{
                      font-size: 16px;
                  }
                  #remember_button{
                      font-size: 13px;
                  }

                  #otherlogin {
                      margin-left: 40px;
                  }

                  ul#wayfholder{
                      padding-left: 5%;
                      padding-right: 5%;
                  }
                  #number-links{
                      font-size: 18px;
                      padding-left: 30px;
                      width: 250px;
                  }
                  #titulo_3col{
                      font-size: 12px;
                      padding-left: 20px;
                      width: 250px;
                  }
                  #nota1, #nota2 {
                      font-size: 12px;
                  }

                  #copyright{
                      font-size: 10px;
                      padding-left:60px;
                  }


                  #content .bloque {
                      margin-left:55px;
                      margin-right: 55px;
                      max-width: 280px;
                  }
                  .bloque p{
                      font-size: 12px;
                  }
                  .list-slo-sps{
                      font-size: 12px;
                  }
                  .exception_trace{
                      width: 210px;
                      font-size: 10px;
                  }
                  #tech_error_info p{
                      width: 250px;
                  }
                  .error_subtitle {
                      font-size: 12px;
                  }
                  .form-col1{
                      height: 22px;
                      -webkit-text-size-adjust: 100%;
                  }
                  textarea{
                      width: 240px;
                      margin-left: -110px;
                      font-size: 11px;
                  }
                  /*Añadido por PRiSE 20180205*/
                  #contenedor_titulillo {
                          margin-left: 100px;
                          margin-top: -70px;
                  }
                  /*Fin 20180205*/

                  /* JAAD-2018.04.30 */
                  #informacion_seguridad{
                      margin-top: 4px;
                      margin-right: 50px;
                      float: left;
                      margin-left: 10px;
                  }
                  .footer img {
                      float: left;
                      margin-left: 40px;
                  }
          }
          				@media all and (max-width: 340px){ // para 320px y 340px
                  body { -webkit-text-size-adjust: 100%; }

                  div{
                      height:auto;
                  }
                  body, #no_scroll {
                      overflow-x:hidden;
                      //position: fixed;
                  }
                  #main{
                      margin-left: -20px;
                      margin-right: auto;
                      margin-top: -20px;
                      text-align: left;
                      width: 440px;
                  }
                  #content{
                      width: 385px;
                      background-position: 0px 0px, center 0px;
                      padding-right: 500px;
                  }
                  #langs{
                      font-size: 11px;
                      margin-right: 10px;
                  }
                  #adas_logo{
                      margin: 10px auto -30px;
                      padding-left: 26px;
                  }
                  #logo_img{
                      margin-top: 10px;/* PRiSE 20180205 */
                   /*   width: 225px;*//* Comentado por PRiSE 20180205 */
                      height: auto;
                  }
                  #cream_bar{
                      height: 60px;
                  }

                  #texto_titulo, #error_title, #status_title{
                      font-size:20px;
                  }
                  #texto_subtitulo.subtitle{
                      font-size: 14px;
                  }

                  #identificacion{
                      margin-left: 0px;
                  }
                  #identificacion td{
                      width: 245px;
                  }
                  #par {
                      border-right: none;
                      padding-right: 0px;
                     border-bottom: 1px dotted #22942B;
                      padding-bottom: 0px;
                      position: absolute;
                      margin-left: 15px;
                      margin-right: 15px;
                  }
          	 /*Añadido por PRiSE 20180320*/
                   td#par #question1 {
                          margin: -25px 0 0 255px;
                          position: absolute;
                  }
                  /*Añadido por PRiSE 20180320*/
                  td#auten_delegadas img {
                          margin: -25px 0 0 275px;
                           position: absolute;
                  }

                  #auten_delegadas {
                      float: left;
                      padding: 250px 0px 0px;
                      margin-left: -10px;
                      margin-right: 0px;
                      margin-top: 30px; /*Añadido por PRiSE 20180320*/
          	}

                  .login-box{
                      padding-top: 0px;
                      margin-bottom: 10px;
                  }
                  #submit_ok.gradient{
                      margin-top: 0px;
                  }
                  .form-col1{
                      font-size: 11px;
                      width: 235px;
                      -webkit-text-size-adjust: 100%;
                  }
                  .text-field{
                      margin-right: 10px;
                      width: 150px;
                      height: 20px;
                  }

                  .notes_texts{
                      width: 290px;
                      margin-top: 15px;
                  }

                  #content_bottom {
                      margin-left: -215px;
                  }

                  #wayfotherlogin{
                      width: 225px;
                      padding: 20px 0px;
                      left: 260px;
                      min-height: 100px;
                  }

                  #wayfholder li {
                      margin-bottom: 3%;
                      margin-left: 4%;
                  }
                  #holder li {
                      margin-bottom: 5%;
                      margin-left: 3%;
                      margin-right: 3%;
                  }
                  h1#wayf_title{
                      font-size: 16px;
                  }

                  #wayf_button{
                      font-size: 16px;
                  }
                 #otherlogin {
                      margin-left: 40px;
                  }

                  ul#wayfholder{
                      padding-left: 5%;
                      padding-right: 5%;
                  }
                  #number-links{
                      font-size: 18px;
                      padding-left: 30px;
                      width: 250px;
                  }
                  #titulo_3col{
                      font-size: 12px;
                      padding-left: 20px;
                      width: 250px;
                  }
                  #nota1, #nota2 {
                      font-size: 12px;
                  }

                  #copyright{
                      font-size: 10px;
                      padding-left:60px;
                  }


                  #content .bloque {
                      margin-left:55px;
                      margin-right: 55px;
                      max-width: 280px;
                  }
                  .bloque p{
                      font-size: 12px;
                  }
                  .list-slo-sps{
                      font-size: 12px;
                  }
                  .exception_trace{
                      width: 210px;
                      font-size: 10px;
                  }
                  #tech_error_info p{
                      width: 250px;
                  }
                  .error_subtitle {
                      font-size: 12px;
                  }
                  .form-col1{
                      height: 22px;
                      -webkit-text-size-adjust: 100%;
                  }
                  textarea{
                      width: 240px;
                      margin-left: -110px;
                      font-size: 11px;
                  }
                  /*Añadido por PRiSE 20180205*/
                  #contenedor_titulillo {
                          margin-left: 24px;
                          margin-top: -30px;
                  }
                  /*Fin 20180205*/

                  /* JAAD-2018.04.30 */
                  #informacion_seguridad{
                      margin-top: 4px;
                      margin-right: 50px;
                      float: left;
                      margin-left: 10px;
                  }
                  .footer img {
                      float: left;
                      margin-left: 40px;
                  }
          }

              .notification{
                  margin:20px;
                  padding:20px;
              }
              .notification .order{
                  color: #002B5E;
                  font-size: 10pt;
                  margin: 5px;
                  font-weight: bold;
              }
              .notification h2{
                  margin-bottom: 20px;
              }
              .notification p{
                  margin-bottom: 15px;
              }
              .notification .button_class{
                  padding: 5px;
                  margin:5px;
                  margin-top:20px;
              }
              .notification ul{
                  margin-left:30px;
                  margin-bottom:10px;
              }
              .notification li{
                  color:#555;
              }

              @media all and (max-width: 339px){ // para 320px
                  body { -webkit-text-size-adjust: 100%; }
                  div{
                      height:auto;
          	}
                  body, #no_scroll {
                      overflow-x:hidden;
                      //position: fixed;
                  }
                  #main{
                      margin-left: -40px;
                      margin-right: auto;
                      margin-top: -40px;
                      text-align: left;
                      width: 420px;
                  }
                  #content{
                      width: 385px;
                      background-position: 0px 0px, center 0px;
                      padding-right: 500px;
                  }
                  #langs{
                      font-size: 11px;
                      margin-right: 10px;
                  }
                  #adas_logo{
                      margin: 10px auto -30px;
                      padding-left: 26px;
                  }
                  #logo_img{
                     margin-top: 20px;/*Añadido por PRiSE 20180320*/
          	   margin-left: 20px;/*Añadido por PRiSE 20180320*/
          	   margin-bottom: 40px;/*Añadido por PRiSE 20180320*/
                   /*   width: 225px;*//* Comentado por PRiSE 20180205 */
                      height: auto;
                  }
          	/*Añadido por PRiSE 20180320*/
          	 td#par #question1 {
                  	margin: -25px 0 0 255px;
                  	position: absolute;
          	}
          	/*Añadido por PRiSE 20180320*/
          	td#auten_delegadas img {
              		margin: -25px 0 0 275px;
             		 position: absolute;
          	}
                  #cream_bar{
                     display:none;/*Añadido por PRiSE 20180320*/
          	    height: 60px;
                  }

                  #texto_titulo, #error_title, #status_title{
                      font-size:20px;
                  }
                  #texto_subtitulo.subtitle{
                      font-size: 14px;
                  }

                  #identificacion{
                      margin-left: 0px;
                  }
                  #identificacion td{
                      width: 260px;
                  }
                  #par {
                      border-right: none;
                      padding-right: 0px;
                      border-bottom: 1px dotted #22942B;
                      padding-bottom:30px;
                      position: absolute;
                      margin-left: 0px;
                      margin-right: 15px;
                  }
                  #auten_delegadas {
                      float: left;
                      padding: 300px 0px 0px;
                      margin-left: -10px;
                      margin-right: 0px;
                      margin-top: 30px; /*Añadido por PRiSE 20180320*/
          	}

                  .login-box{
                      padding-top: 0px;
                      margin-bottom: 10px;
                  }
                  #submit_ok.gradient{
                      margin-top: 0px;
                  }
                  .form-col1{
                      font-size: 11px;
                      margin-top: 2p
                      width: 250px;
                      height: 22px;
                      -webkit-text-size-adjust: 100%;
                  }
                  label{
                      margin-left: -5px;
                  }
                  .text-field{
                      margin-right: 10px;
                      width: 150px;
                      height: 20px;
                  }

                  .notes_texts{
                      width: 290px;
                      margin-top: 15px;
                  }

                  #content_bottom {
                      margin-left: -225px;
                  }

                  #wayfotherlogin{
                      width: 225px;
                      padding: 20px 0px;
                      left: 240px;
                      min-height: 100px;
                  }

                  #wayfholder li {
                      margin-bottom: 3%;
                      margin-left: 4%;
                  }
                  #holder li {
                      margin-bottom: 5%;
                      margin-left: 3%;
                      margin-right: 3%;
                  }
                  h1#wayf_title{
                      font-size: 16px;
                  }

                  #wayf_button{
                      font-size: 20px;
											color: red;
                  }
                  #remember_button{
                      font-size: 13px;
                  }

                  #otherlogin {
                      margin-left: 40px;
                  }

                  ul#wayfholder{
                      padding-left: 5%;
                      padding-right: 5%;
                  }
                  #number-links{
                      font-size: 18px;
                      padding-left: 30px;
                      width: 250px;
                  }
                  #titulo_3col{
                      font-size: 12px;
                      padding-left: 20px;
                      width: 250px;
                  }
                  #nota1, #nota2 {
                      font-size: 12px;
                  }

                  #copyright{
                      font-size: 10px;
                      padding-left:60px;
                  }

                  #content .bloque {
                      margin-left:55px;
                      margin-right: 55px;
                      max-width: 280px;
                  }
                  .bloque p{
                      font-size: 12px;
                  }
                  .list-slo-sps{
                      font-size: 12px;
                  }
                  .exception_trace{
                      width: 210px;
                      font-size: 10px;
                  }
                  #tech_error_info p{
                      width: 250px;
                  }
                  .error_subtitle {
                      font-size: 12px;
                  }

                  textarea{
                      width: 200px;
                      margin-left: -110px;
                      font-size: 11px;
                  }

              }

          </style>
          <link href="https://idp.uma.es/adas/themes/uma-1.7.0/css/jquery-ui-1.8.12.custom.css" rel="stylesheet" type="text/css" media="screen">
          <title>iDUMA - Servicio de Identidad de la Universidad de Málaga</title>

					<!-- PedroArenas -->
					<style media="screen">
						.selfOng{
							text-decoration: underline;
							font-size: 17px;
							font-weight: bold;
							font-style: oblique;
						}
					</style>
  </head>

  <body>
	  
	  
     <?php include "_navbar.php"; ?>

    <div id="main">
        <div id="content">
            <div id="adas_logo">
                <a href="https://www.uma.es/" title="UMA">
                    <img id="logo_img" src="https://idp.uma.es/adas/imgs/uma-logo-header.png">
                </a>
            </div>

            <div id="contenedor_titulillo">
               <h1 id="texto_titulo">iDUMA - Servicio de Identidad de la Universidad de Málaga</h1>
            </div>

            <div style="clear:both;"></div>

            <div>
                <h5 class="subtitle" id="texto_subtitulo">Autenticación centralizada</h5>
            </div>

            <div class="bloque">
                  <div>

                    <table border="0" id="identificacion">
                        <tbody>
                          <tr>
                            <td valign="top" id="par">
                                    <h2 id="titulo_1col">Identificación de usuario</h2>
                                    <!-- Signo de interrogacion -->

                                    <a href="/">
                                      <img id="question1" src="https://idp.uma.es/adas/themes/uma-1.7.0/img/question-24px.png">
                                    </a>

                                    <form method="post" name="formulario1" id="formulario1">
                                        <div id="userpass" style="position:relative;">
                                            <div class="form-item" id="edit-name-wrapper">
                                                <div class="form-col1">
                                                  <label>Identificación</label>
                                                </div>

                                                <div class="form-col2">
                                                  <input class="text-field" type="text" name="user" id="edit-name">
                                                </div>

                                              </div>

                                            <div class="form-item" id="edit-pass-wrapper">
                                                <div class="form-col1 text-question">
                                                  <label>Contraseña</label>
                                                </div>

                                                <div class="form-col2">
                                                  <input class="text-field" type="password" name="pass" id="edit-pass">
                                                </div>
                                            </div>

                                            <div class="login-box">
                                                <input id="submit_ok" class="gradient " type="submit" value="Entrar" name="login">&nbsp;
                                            </div>

                                        </div>
                                    </form>

                                    <div id="enlaces_UMA">
                                        <ul>
                                            <li>
                                                <img id="icon_nopuedoentrar" src="https://idp.uma.es/adas/themes/uma-1.7.0/img/nopuedoentrar.png">
                                                <a id="ayuda_usuario" href="">Soy usuario pero no puedo entrar</a>
                                            </li>

                                        </ul>
                                    </div>

                                </td>

                                <td valign="top" id="auten_delegadas">
                                    <h2 id="titulo_3col">otros medios de autenticación</h2>
                                    <!-- Signo de interrogacion -->
                                    <a href="https://duma.uma.es/directorio/ayuda/otros-identificacion/">
                                      <img id="question_right" src="https://idp.uma.es/adas/themes/uma-1.7.0/img/question-24px.png">
                                    </a>

                                    <div id="enlaces_wayf">
																		<div>
                                        <ul>
                                          <li>
                                            <!--<img id="icon_otraorganizacion" src="https://idp.uma.es/adas/themes/uma-1.7.0/img/otraorganizacion.png">-->
                                              <a class="selfOng" href="login_ong.php">Quiero autenticarme como organización</a>
                                          </li>
                                        </ul>
                                    </div>

                                </td>
                          </tr>
                        </tbody>
                    </table>

                  </div>
            </div>

            <div class="notes_texts" style="display: block;">
                <p id="nota1">Una vez que se haya autenticado no será necesario identificarse de nuevo para acceder a otros recursos.</p>
                <p><strong><span id="nota2">Para desconectarse, recomendamos que cierre su navegador (cerrando todas las ventanas).</span></strong></p>
            </div>

        </div>

        <div id="content_bottom">
            <div class="footer">
                <img id="icon_seguridad" src="https://idp.uma.es/adas/themes/uma-1.7.0/img/seguridad.png">
                <a href="https://duma.uma.es/seguridad/"><div id="informacion_seguridad">Ver información importante de SEGURIDAD</div></a>
            </div>

        </div>
    </div>
  </body>

</html>
