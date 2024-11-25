<!-- resources/views/audit_logs.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audit Logs</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Include your CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container">
        <h1>Audit Logs</h1>
        <table class="table table-striped" id="table_data">
            <thead>
                <tr>
                    <th scope="col">Audit ID</th>
                  
                    <th scope="col">User type</th>
                    <th scope="col">Login Date</th>
                    <th scope="col">Login Time</th>
                    <th scope="col">Logout Time</th>
                </tr>
            </thead>
        </table>
    </div>
   <script>
    var t_data = document.getElementById("table_data");
    var req = new XMLHttpRequest();
  

    req.open("GET","/sh",true);
    req.send();

    req.onreadystatechange = function(){
        if(req.readyState==4 && req.status == 200){
            var obj =JSON.parse(req.responseText)

            for(i=0;i<obj.data.length;i++){
                t_data.innerHTML += "<tr><td>"+obj.data[i]['auditid']+"</td><td>"+obj.data[i]['usertype']+"</td><td>"+obj.data[i]['logindate']+"</td><td>"+obj.data[i]['logintime']+"</td><td>"+obj.data[i]['logouttime']+"</td></tr>";
               // console.log(obj.data[i]['id']);
                //console.log(obj.data[i]['usertype']);

            }
        }
    }
   </script>
    <div class="d-flex justify-content-center">
        <a class="btn btn-primary" href="/logout">Logout</a>
        <a class="btn btn-primary" href="/admindash">Back</a>


    </div>
    

     
</body>
</html>
