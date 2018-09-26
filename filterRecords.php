<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="author" content="Harshit Tomar" />
    <meta charset="utf-8" />
    <title>People Health Pharmacy Records Management System</title>
    <!-- Reference to Bootstrap CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
    <form action="filterRecordProcess.php" method="get">


        <div class="form-group">
            <label for="ID">ID</label>
            <input type="text" name="ID" id="ID"  maxlength="30"/>
        </div>

        <div class="form-group">
            <label for="name">name</label>
            <input type="text" name="name" id="name"  maxlength="30"/>
        </div>


        <div class="form-group">
            <input type="radio" name="searchBy" id="id" value="id" required="required"/>
            <label for="id">ID</label>
            <input type="radio" name="searchBy" id="name" value="name" required="required"/>
            <label for="name">Name</label>
        </div>


        <div class="form-group">
            <label>Table</label>
            <select name="table" id="table">
                <option value="">---</option>
                <option value="inventory">inventory</option>
                <option value="purchase">purchase</option>
                <option value="sales">sales</option>
                <option value="product">product</option>
            </select>
        </div>

        <input type="submit" value="search" class="btn btn-success"">
    </form>

</body>
</html>