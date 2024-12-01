<?php
     require_once 'treedatabase.php';
     require_once 'plantcrud.php';

     if ($_SERVER["REQUEST_METHOD"] == "POST") {
         $database = new Database();
         $db = $database->getConnect();

         $plant = new Plant($db);
         $plant->name = htmlspecialchars(trim($_POST['name']));
         $plant->scientific_name = htmlspecialchars(trim($_POST['scientific_name']));
         $plant->region = htmlspecialchars(trim($_POST['region']));
         $plant->type = isset($_POST['type']) ? htmlspecialchars(trim($_POST['type'])) : '';
         $plant->description = htmlspecialchars(trim($_POST['description']));

         if ($plant->create()) {
             echo "
             <!DOCTYPE html>
             <html lang='en'>
             <head>
                 <meta charset='UTF-8'>
                 <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                 <title>SweetAlert</title>
                 <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
             </head>
             <body>
             <script>

             Swal.fire({
                 title: 'Success!',
                 text: 'Plant was successfully created!',
                 icon: 'success'
             }).then((result) => {
                 if (result.isConfirmed) {
                     window.location.href = 'landsection.php';
                 }
             });
             </script>
                 
             </body>
             </html>";
         } else {
             echo "Error creating plant.";
         }
     }

     if (isset($_GET['delete_id'])) {
         $database = new Database();
         $db = $database->getConnect();

         $plant = new Plant($db);
         $plant->id = htmlspecialchars(trim($_GET['delete_id']));

         if ($plant->delete()) {
             echo "
             <!DOCTYPE html>
             <html lang='en'>
             <head>
                 <meta charset='UTF-8'>
                 <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                 <title>SweetAlert</title>
                 <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
             </head>
             <body>
             <script>

             Swal.fire({
                 title: 'Deleted!',
                 text: 'Plant was successfully deleted!',
                 icon: 'success'
             }).then((result) => {
                 if (result.isConfirmed) {
                     window.location.href = 'landsection.php';
                 }
             });
             </script>
                 
             </body>
             </html>";
         } else {
             echo "Error deleting plant.";
         }
     }

     $database = new Database();
     $db = $database->getConnect();
     $plant = new Plant($db);

     $stmt = $plant->read();
     $num = $stmt->rowCount();

     if ($num > 0) {
         while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
             echo "<tr>";
             echo "<td>" . htmlspecialchars($row['id']) . "</td>";
             echo "<td>" . htmlspecialchars($row['name']) . "</td>";
             echo "<td>" . htmlspecialchars($row['scientific_name']) . "</td>";
             echo "<td>" . htmlspecialchars($row['region']) . "</td>";
             echo "<td>" . htmlspecialchars($row['description']) . "</td>";
             echo "<td><a href='?delete_id=" . $row['id'] . "' onclick='return confirm(\"Are you sure you want to delete?\");'>Delete</a></td>";
             echo "</tr>";
         }
     }
?>
