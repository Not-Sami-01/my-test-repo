<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <link rel="shortcut icon" href="https://img.icons8.com/?size=100&id=9ZUExtqRFzfM&format=png&color=000000"
        type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iNotes - Notes taking made easy</title>
</head>

<body>
    <div class="container">
        <!-- Modal -->
        <div class="modal fade" id="delModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Entry</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Do you really want to delete this entry?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form action="iNotes.php" method="post">
                            <input type="hidden" name="snoDel" id="snoDel">
                            <button type="submit" class="btn btn-danger">Confirm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit note</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="iNotes.php" method="post">
                        <h2>Add a note</h2>
                        <div class="mb-3">
                            <input type="hidden" name="snoEdited" id="snoEdit">
                            <label for="title" class="form-label">Note title</label>
                            <input type="text" class="form-control" id="titleEdit" name="titleEdit"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleCheck1">Note description</label>
                            <textarea type="text-area" id="descEdit" name="descEdit" class="form-control"
                                rows="3"></textarea>
                        </div>
                        <button type="submit" class="ml-3 btn btn-primary">Update note</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Navbar -->
    <nav class="navbar bg-dark navbar-dark navbar-expand-lg ">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">iNotes</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" aria-disabled="true">Contact Us</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <!-- Form -->
    <div class="container mt-3">
        <form action="iNotes.php" method="post">
            <h2>Add a note</h2>
            <div class="mb-3">
                <label for="title" class="form-label">Note title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleCheck1">Note description</label>
                <textarea type="text-area" id="desc" name="desc" class="form-control" id="exampleCheck1"
                    rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add note</button>
        </form>
        <?php
        include 'connfile.php';
        if(isset($_POST['snoDel'])){
            $snoDel = $_POST['snoDel'];
            $delSql = "DELETE FROM `notes` WHERE `sno` = '$snoDel' ; ";
            $delRes= mysqli_query($conn, $delSql);
            if($delRes){
                echo $successMsg;
            }else{
                echo $Technicalerror;
            }

        }else if (isset($_POST['snoEdited'])) {
            // Update the record 
            $newSno = $_POST['snoEdited'];
            $newTitle = $_POST['titleEdit'];
            $newDesc = $_POST['descEdit'];
            $newsql = "UPDATE `notes` SET `title` = '$newTitle',`description`='$newDesc' WHERE `notes`.`sno` = $newSno;";
            $newRes = mysqli_query($conn, $newsql);
            if ($newRes) {
                echo $successMsg;
            } else {
                echo $Technicalerror;
            }
        } else {
            // Insert the record 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (isset($_POST['title'], $_POST['desc'])) {
                    $title = $_POST['title'];
                    $desc = $_POST['desc'];
                    $insertSql = "INSERT INTO `notes` (`title`, `description`,`datetime`) VALUES ( '$title', '$desc', current_timestamp());";
                    $result = mysqli_query($conn, $insertSql);
                    if ($result) {
                        echo $successMsg;
                    } else {
                        echo $Technicalerror;
                    }
                }
            }
        }
        ?>
    </div>
    <!-- Data-Fetching from table  -->
    <div class="container">
        <table class="table my-4" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = 'SELECT * FROM `notes`';
                $data = mysqli_query($conn, $sql);
                $num = mysqli_num_rows($data);
                if ($num > 0) {
                    for ($i = 1; $i <= $num; $i++) {
                        $row = mysqli_fetch_assoc($data);
                        echo '<tr>
                       <td scope="row">' . $i . '</td>
                       <td>' . $row['title'] . '</td>
                       <td>' . $row['description'] . '</td>
                       <td><button class="btn-sm btn btn-primary edit" id="this' . $row['sno'] . '">Edit</button> <button class="btn-sm btn btn-primary del" id="thiss' . $row['sno'] . '">Delete</button></td>
                   </tr>';
                        // echo $successMsg;
                    }
                } else {
                    echo '<div class="alert mt-2 alert-warning alert-dismissible fade show" role="alert">
                <strong>Not Found!</strong> Note list is empty.</div>';
                }

                ?>

            </tbody>
        </table>
    </div>
    <hr>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
<script>
    let table = new DataTable('#myTable');
    let edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((elem) => {
        elem.addEventListener('click', (e) => {

            let tr = e.target.parentNode.parentNode;
            let title = tr.getElementsByTagName('td')[1].innerHTML;
            let desc = tr.getElementsByTagName('td')[2].innerHTML;
            let targetId = e.target.id.substring(4);
            snoEdit.value = targetId;
            console.log(snoEdit.value);
            titleEdit.value = title;
            descEdit.value = desc;
            console.log(title, desc);
            $('#editModal').modal('toggle');
        })
    })
    let deletes = document.getElementsByClassName('del');
    Array.from(deletes).forEach((elem) => {
        elem.addEventListener('click', (e) => {
            let targetId = e.target.id.substring(5);
            snoDel.value = targetId;
            console.log(snoDel.value);
            $('#delModal').modal('toggle');
        })
    })
</script>

</html>