<link rel="stylesheet" type="text/css" href="../styles/home.css">
<div class="dropdown">
  <button class="dropbtn">Linnaosa</button>
  <div class="dropdown-content">
    <a href="#">Kesklinn</a>
    <a href="#">Pirita</a>
    <a href="#">Kristiine</a>
  </div>
</div>

CSS:
.dropbtn {
    background-color: #4CAF50;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
    width: 100%; 
    margin-top:10px; 
    margin-bottom: 0;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdown:hover .dropbtn {
    background-color: #3e8e41;
}