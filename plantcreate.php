<?php
     require_once 'plantdatabase.php';
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

     ?>