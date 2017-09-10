<?php
session_start();
include "models/subjectController.php";
include "models/connect.php";
if(isset($_SESSION['username'])) {
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Adaptive Scheduling</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <?php include 'template\navigation.php';?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Subjects <small>Statistics Overview</small>
                    </h1>

                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <?php
                    if(isset($_GET["msg"])){ ?>
                    <div class="alert alert-success alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php $msg = $_GET['msg'];
                        echo $msg;

                        }
                        ?>
                    </div>



                </div>
            </div>

            <!-- /.row -->

            <div class="row">
                <div class="col-lg-1">
                </div>
                <div class="col-lg-10">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> Add Subject</h3>
                        </div>
                        <div class="panel-body">
                            <?php
                            if(isset($_GET["update"])){
                                $id = $_GET["id"];
                                $where = array("s_id"=>$id);
                                $row = $obj->select_record("subject",$where);

                                ?>
                                <form method="post" action="models/subjectController.php">
                                    <table class="table table-hover">

                                        <input type="hidden"  name="id" value="<?php echo $row["s_id"];?>">

                                        <tr>
                                            <td> Subject Code</td>
                                            <td><input type="text" class="form-control" name="code" value="<?php echo $row["s_code"];?>"> </td>
                                        </tr>

                                        <tr>
                                            <td> Subject Name</td>
                                            <td><input type="text" class="form-control" name="sname" value="<?php echo $row["s_name"];?>"> </td>
                                        </tr>

                                        <tr>
                                            <td> Lectures per Week</td>
                                            <td><input type="number" class="form-control" name="nu_lec" value="<?php echo $row["nu_lectures"];?>"> </td>
                                        </tr>

                                        <tr>
                                            <td> LAB or Classroom</td>
                                            <td>
                                                <select class="form-control" id="ac" name="lab">
                                                    <option value="true" selected>LAB</option>
                                                    <option value="false">Classroom</option>
                                                </select>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td> Number of Students</td>
                                            <td><input type="text" class="form-control" name="nu_std" value="<?php echo $row["nu_std"];?>"> </td>
                                        </tr>

                                        <tr>
                                            <td> Department</td>
                                            <td>
                                                <select class="form-control" id="dpt" name="dpt">
                                                    <?php
                                                    $row2 = $obj->view_record("department");
                                                    foreach ($row2 as $row) {
                                                        ?>
                                                        <option value="<?php echo $row["dept_id"]; ?>" selected><?php echo $row["dept_name"]; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td> Lecturer</td>
                                            <td>
                                                <select class="form-control" id="dpt" name="lec">
                                                    <?php
                                                    $row2 = $obj->view_record("user");
                                                    foreach ($row2 as $row) {
                                                        ?>
                                                        <option value="<?php echo $row["username"]; ?>" selected><?php echo $row["fullName"]; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td> Student Group</td>
                                            <td>
                                                <select class="form-control" id="dpt" name="grp">
                                                    <?php
                                                    $row2 = $obj->view_record("std_group");
                                                    foreach ($row2 as $row) {
                                                        ?>
                                                        <option value="<?php echo $row["std_group"]; ?>" selected><?php echo $row["semester"]; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td> </td>
                                            <td ><input type="submit" class="btn btn-success btn-block" name="edit" value="Update"></td>
                                        </tr>
                                    </table>
                                </form>
                                <?php
                            }

                            else{
                            ?>
                            <form method="post" action="models/subjectController.php">
                                <table class="table table-hover">
                                    <tr>
                                        <td> Subject Code</td>
                                        <td><input type="text" class="form-control" name="code" placeholder="Enter Subject Code"> </td>
                                    </tr>

                                    <tr>
                                        <td> Subject Name</td>
                                        <td><input type="text" class="form-control" name="sname" placeholder="Enter Subject Name"> </td>
                                    </tr>

                                    <tr>
                                        <td> Lectures per Week</td>
                                        <td><input type="number" class="form-control" name="nu_lec" placeholder="Enter Lectures pre Week"> </td>
                                    </tr>

                                    <tr>
                                        <td> LAB or Classroom</td>
                                        <td>
                                            <select class="form-control" id="ac" name="lab">
                                                <option value="true" selected>LAB</option>
                                                <option value="false">Classroom</option>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td> Number of Students</td>
                                        <td><input type="text" class="form-control" name="nu_std" placeholder="Enter Registered Students"> </td>
                                    </tr>

                                    <tr>
                                        <td> Department</td>
                                        <td>
                                            <select class="form-control" id="dpt" name="dpt">
                                                <?php
                                                $row2 = $obj->view_record("department");
                                                foreach ($row2 as $row) {
                                                    ?>
                                                    <option value="<?php echo $row["dept_id"]; ?>" selected><?php echo $row["dept_name"]; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td> Lecturer</td>
                                        <td>
                                            <select class="form-control" id="dpt" name="lec">
                                                <?php
                                                $row2 = $obj->view_record("user");
                                                foreach ($row2 as $row) {
                                                    ?>
                                                    <option value="<?php echo $row["username"]; ?>" selected><?php echo $row["fullName"]; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td> Student Group</td>
                                        <td>
                                            <select class="form-control" id="dpt" name="grp">
                                                <?php
                                                $row2 = $obj->view_record("std_group");
                                                foreach ($row2 as $row) {
                                                    ?>
                                                    <option value="<?php echo $row["std_group"]; ?>" selected><?php echo $row["semester"]; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td  align="center"><input type="reset" class="btn btn-danger btn-block" name="reset" value="Clear"></td>
                                        <td  align="center"><input type="submit" class="btn btn-primary btn-block" name="addSub" value="Add Subject"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <?php
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </table>

                            </form>


                        </div>

                    </div>

                </div>
                <div class="col-lg-1">
                </div>
            </div>
            <!-- /.row -->
            <hr>
            <div class="row">
                <div class="col-lg-1">
                </div>
                <div class="col-lg-10">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> View Subjects</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-bordered table-hover">

                                <tr>
                                    <th>#</th>
                                    <th>Subject Code</th>
                                    <th>Subject Name</th>
                                    <th>Lectures per Week</th>
                                    <th>Room Type</th>
                                    <th>Department</th>
                                    <th>Lecturer</th>
                                    <th>Semester</th>
                                    <th>&nbsp;</th>
                                    <th>&nbsp;</th>
                                </tr>
                                <?php
                                $myrow = $obj->view_record("subject");
                                foreach ($myrow as $row) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row["s_id"]; ?></td>
                                        <td><?php echo $row["s_code"]; ?></td>
                                        <td><?php echo $row["s_name"]; ?></td>
                                        <td><?php echo $row["nu_lectures"]; ?></td>
                                        <td><?php if ($row["LAB"]=="true") { echo "LAB";}
                                            else if ($row["LAB"]=="false") { echo "Classroom";}

                                            ?></td>

                                        <td><?php $dept =  $row["dept_id"];


                                            $sql2 = "SELECT * FROM department WHERE dept_id = $dept";
                                            $result2 = mysqli_query($con, $sql2) or die("View erorr!!");

                                            if ($num1 = mysqli_num_rows($result2) > 0) {
                                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                                    echo $row2["dept_name"];
                                                }
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $row["u_id"]; ?></td>
                                        <td><?php
                                            $grp =  $row["std_group"];


                                            $sql2 = "SELECT * FROM std_group WHERE 	std_group = $grp";
                                            $result2 = mysqli_query($con, $sql2) or die("View erorr!!");

                                            if ($num1 = mysqli_num_rows($result2) > 0) {
                                                while ($row2 = mysqli_fetch_assoc($result2)) {
                                                    echo $row2["semester"];
                                                }
                                            }?></td>
                                        <th><a href="subject.php?update=1&id=<?php echo $row["s_id"]; ?>" class="btn btn-info">Edit</a></th>
                                        <th><a href="models/subjectController.php?delete=1&id=<?php echo $row["s_id"]; ?>" class="btn btn-danger">Delete</a></th>
                                    </tr>

                                    <?php
                                }
                                ?>



                            </table>

                        </div>
                    </div>
                </div>
                <div class="col-lg-1">
                </div>

            </div>

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- Morris Charts JavaScript -->
<script src="js/plugins/morris/raphael.min.js"></script>
<script src="js/plugins/morris/morris.min.js"></script>
<script src="js/plugins/morris/morris-data.js"></script>

</body>

</html>
    <?php
}

else{
    $_SESSION['msg'] = "Login to continue";
    header('location:login.php');
    echo $_SESSION['msg'];
}
?>