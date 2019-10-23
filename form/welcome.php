<html>

<head>
    <title>Welcome Page</title>
    <style type="text/css">
    @font-face
    {
    font-family: Arial, Helvetica, sans-serif; 
    font-style: italic;
    }
    body 
    {
    background-color: aliceblue;
    margin : auto;
    font-family: Arial, Helvetica, sans-serif;
    font-style: italic;
    }
    h1,h2,h3
    {
        position: relative;
        top:20%;
        left:40%;
    }
</style>
    <meta charset="UTF-8">
    <meta name="description" content="Welcome Page">
    <meta name="author" content="Anwar Rezk">
    <meta name="keywords" content="HTML,CSS,JavaScript,PHP,Database">   
</head>

<script src="script.js"></script>

<body>
    <h1><?php include("serverend.php");echo $_SESSION['success'];?></h1>
    <h2>Welcome <?php echo $_SESSION['username'];?>!</h2>
    <h3><a href="login.html">Logout.</a></h3>
</body>



</html>