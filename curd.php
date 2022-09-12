
    <?php
    $username="root";
    $password="";
    $conn =new PDO("mysql:host=localhost; dbname=test;",$username,$password);
   if($_POST){
    $id=$_POST['id'];
    $name=$_POST['name'];
    $password=$_POST['password'];
    $email=$_POST['email'];}
    

        //       استعلام ادخال البيانات 
        if(isset($_POST['insert']))
        {
        $addData=$conn->prepare("INSERT INTO users(id,name,password,email) VALUES('$id','$name','$password','$email')");
            if($addData->execute())
            {
            echo"<p class='bg-primary'> yes insurt </p>";
            header("curd.php",true);
            }
        }

            //    استعلام البحث 
    if(isset($_POST['search']))
    {
        $valueToSearch = $_POST['search'];
        
        $query = "SELECT * FROM `users` WHERE CONCAT(`id`, `name`, `password`, `email`) LIKE '%".$valueToSearch."%'";
        $search_result = filterTable($query);
    }
    else {
        $query = "SELECT * FROM `users`";
        $search_result = filterTable($query);
    }

    function filterTable($query)
    { $conn = mysqli_connect("localhost","root","","test");
        $filter_Result = mysqli_query($conn, $query);
        return $filter_Result;
    }


        // استعلام تعديل البيانات
        if(isset($_POST['edit']))
        {
        $editData=$conn->prepare("UPDATE users SET id=$id,name='$name',password='$password',email='$email' WHERE id='$id'");
            if($editData->execute())
            {
         
            header("curd.php",true);
            echo"<p class='bg-secondary'>yes  edit</p>";
            }
        }

        // استعلام حذف البيانات
        if(isset($_POST['delete']))
        {
        $deleteData=$conn->prepare("DELETE FROM users WHERE id='$id' ");
             if($deleteData->execute())
            {
             echo"<p class='bg-danger'>yes  delete</p>";
             header("curd.php",true);
            }
        }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>
<body>
    
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="card mt-4">
                  <div class="card-header">
                      <P class="h3 text-center">USEING CURD IN PHP</P>
                  </div>
                  <div class="card-body">
                      <div class="row">
                          <div class="col-md-12">
                          <form action="" method="POST">
                              <div class="input-group ">
                    <button type="submit" name="insert" class="btn btn-primary m-4 mt-0 ">insurt</button>
                    <button type="submit" name="edit" class="btn btn-secondary m-4 mt-0 ">Edit_</button>
                    <button type="submit" name="delete" class="btn btn-danger m-4 mt-0 ">Delete</button>
                    <button type="submit" class="btn btn-primary mb-4 mt-0 ">Search</button>
                    <input type="text" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search']; } ?>" class="form-control mb-4 mt-0" placeholder="Search data">
                   
                 
                    <div class="col-md-12">
                    <label for="">ID</label>       <input type="" value="" name="id" id="id" class="input-group">
                    <label for="">name</label>     <input type="" value=""  name="name" id="name"  class="input-group mb-1 mt-0">
                    <label for="">password</label> <input type="" value=""  name="password" id="password" class="input-group mb-1 mt-0">
                    <label for="">Email</label>    <input type="email" value=""  name="email" id="email" class="input-group  mt-0">
                             </div>
                            </form>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-body">
                        <table class="table table-bordered table-hover" id="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Password</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                     
                    //  $con = mysqli_connect("epiz_32570108_team","sql113.epizy.com","fE1FCHLjzWpGU","epiz_32570108_team");
                   // $query = "SELECT * FROM users WHERE CONCAT(name,password,email) LIKE '%$filtervalues%' ";
                 //  $query_run = mysqli_query($con, $query);

//$con = mysqli_connect("localhost","root","","test");

//استعلام البحث
 while($row = mysqli_fetch_array($search_result)):?>
    <tr>
        <td><?php echo $row['id'];?></td>
        <td><?php echo $row['name'];?></td>
        <td><?php echo $row['password'];?></td>
        <td><?php echo $row['email'];?></td>
    </tr>
    <?php endwhile;?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
   //  هذا السكربت عمله عند الضغط علي احد الصفوف في الجدول ينقل القيم الي صناديق النص لتسهيل تعديل البيانات
    var table = document.getElementById('table');
    
    for(var i = 1; i < table.rows.length; i++)
    {
        table.rows[i].onclick = function()
        {
             //  تحديد الصفوف في الجدول
             document.getElementById("id").value = this.cells[0].innerHTML;
             document.getElementById("name").value = this.cells[1].innerHTML;
             document.getElementById("password").value = this.cells[2].innerHTML;
             document.getElementById("email").value = this.cells[3].innerHTML;
        };
    }
</script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
