<!--- HEADER --->
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://bootswatch.com/yeti/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.css">
    <style>


		body{
			position: relative !important;
		}

        .redtext{
            color: red;
        }

        .jumbotron{
            background-color: darkolivegreen;
            color:white;
        }

        .jumbotron-loginpage{
            padding: 80px 50px;
        }

        .jumbotron-indexpage{
            padding-top: 50px;
            padding-bottom: 100px;

        }
        .navbarlogo .navbar-brand{
            background: url(../img/logo.png) center / contain no-repeat;
            width: 200px;
        }

        .navbar {
            margin-bottom: 0;
            background-color: darkolivegreen;
            z-index: 9999;
            border: 0;
            font-size: 12px !important;
            line-height: 1.42857143 !important;
            border-radius: 0;
        }

        .navbar li a, .navbar .navbar-brand {
            color: #fff !important;
        }

        .navbar-nav li a:hover, .navbar-nav li.active a {
            color: white !important;
            background-color: #719947 !important;
        }

        .navbar-default .navbar-toggle {
            border-color: transparent;
            color: #719947 !important;
        }


        .typed-cursor {
            opacity: 1;
            padding: 1px 2px;
            background: #ffffff;
            margin: 5px;
            -webkit-animation: blink 0.5s linear infinite;
            -moz-animation: blink 0.5s linear infinite;
            animation: blink 0.5s linear infinite;
        }
        @keyframes blink{
            0% { opacity:1; }
            50% { opacity:0; }
            100% { opacity:1; }
        }
        @-webkit-keyframes blink{
            0% { opacity:1; }
            50% { opacity:0; }
            100% { opacity:1; }
        }
        @-moz-keyframes blink{
            0% { opacity:1; }
            50% { opacity:0; }
            100% { opacity:1; }
        }
        span.typed-cursor {
            position: relative;
        }

        .header-text.btn{
            border: 2px solid #ffffff;
            border-radius: 0;
            padding: 10px 30px;
            height: 60px;
        }
        .header-text.btn:hover{
            color: inherit;
        }
        .header-text.btn:focus,
        .header-text.btn:active:focus,
        .header-text.btn.active:focus,
        .header-text.btn.focus,
        .header-text.btn:active.focus,
        .header-text.btn.active.focus {
            outline: thin dotted transparent;
            outline: none;
            outline-offset: -2px;
        }

        .open .dropdown-toggle {
            color: #fff;
            background-color: #719947 !important;
        }
        .dropdown-menu li a {
            color: #fff !important;
            background-color: #719947 !important;
        }
        .dropdown-menu li a:hover {
            background-color: red !important;
        }

        .carlist-car{
            outline: 1px solid lightgray;
            margin-bottom:50px;
            padding: 50px 50px;
        }

      .imgcol{
        padding-left: 75px;
        padding-top: 65px;
      }
      .bg-grey {
          background-color: #f6f6f6;
      }

    </style>
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">
