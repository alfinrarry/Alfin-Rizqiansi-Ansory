<html>
<head>
</head>


<title>
</title>
<style>
.body{
    background-color:red;
    color:white;
}
.kolom1{
    width:50%;
}
.box1{
    background-color:white;
   border: 5px solid black;
   color:black;
   text-align:center;
   height:50%;
   width:70%;
   padding:2%;
   float:right;
}
.box2{
    background-color:grey;
   border: 5px solid black;
   color:black;
   text-align:center;
   height:100%;
   width:20%;
   padding:5px;
   float:left;  
}
</style>
<body>
<div class="kolom1">
<div class="box1">

</div>
</div>

<div class="kolom1">
    <div class="box2">
@include('layouts.sidebar')
</div>
</div>
</body>