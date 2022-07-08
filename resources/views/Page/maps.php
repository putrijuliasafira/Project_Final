<?php
include '../controller/config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("location:page/login.php");
} else {
    $kode = $_SESSION['id'];


    $sql = mysqli_query($conn, "SELECT a.Kode_petugas, a.Username, a.Email, a.Password, a.Old_password, a.Last_login, a.Status, a.Created_at, a.Updated_at, b.Nama, b.NIK, b.Alamat, b.Foto, b.NoHP, b.Tanggal_lahir, b.Tempat_lahir, c.Jabatan, c.Id_jabatan FROM auth a, petugas b, jabatan c WHERE a.Kode_petugas=b.Kode_petugas AND b.Jabatan=c.Id_jabatan AND a.Kode_petugas='$kode' ORDER BY c.Id_jabatan");

    $result1 = mysqli_fetch_assoc($sql);

?>
    <html>

    <head>
        <title>Maps - GeoBase</title>

        <style>
            #viewDiv {
                padding: 0;
                margin: 0;
                position: absolute;
                bottom: 0;
                height: 94%;
                width: 100%;
            }

            body {
                margin: 0;
                padding: 0;
            }

            .row {
                margin-top: 10 !important;
            }

            /* 
        .esriSimpleSliderDisabledButton {
            background-color: #FFF !important;
            color: #57585A !important;
        }

        .esriSimpleSliderDisabledButton:hover {
            cursor: pointer !important;
            color: #57585A !important;
        } */
        </style>

        <?php include 'Meta.php'; ?>

        <link rel="stylesheet" href="https://js.arcgis.com/4.24/esri/themes/light/main.css">
        <script src="https://js.arcgis.com/4.24/"></script>

        <script>

        </script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>

    <body>

        <header>
            <div class="container">
                <div class="row">
                    <div class="col-2">
                        <a href="../index.php" class="btn btn-danger fw-semibold"><i class="mdi mdi-home-outline"></i> Home</a>
                    </div>
                    <div class="col-2">
                        <a href="profile.php?id=<?= $result1['Kode_petugas']; ?>&pesan=''" class="btn btn-danger fw-semibold"><i class="mdi mdi-account-network"></i> Profile</a>
                    </div>
                    <?php if ($result1['Id_jabatan'] == 1 || $result1['Id_jabatan'] == 2) {  ?>
                        <div class="col-2">
                            <a href="user.php?id=<?= $result1['Kode_petugas']; ?>&page=1" class="btn btn-danger fw-semibold"><i class="mdi mdi-account-edit"></i> User</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </header>














        <div id="viewDiv"></div>

        <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script> -->
        <script>
            require(["esri/config", "esri/Map", "esri/widgets/Zoom", "esri/views/MapView", "esri/views/SceneView"], function(esriConfig, Map, Zoom, MapView, SceneView) {

                esriConfig.apiKey = "AAPKadf3d2d353c34b488ab5df85e3024105SuMv6Ms1rClP2-c1unmHjTAfEoG385a64pLehMYFdpC0xlIypmMJiALKvwe9hH40";

                var map = new Map({
                    basemap: "satellite", // Basemap layer service
                    ground: "world-elevation",
                });

                // const zoom = new Zoom({
                //     zoomOut: 3
                // });

                var view = new MapView({
                    map: map,
                    center: [123.3999085, 1.4520586], // Longitude, latitude
                    zoom: 5, // Zoom level
                    container: "viewDiv" // Div element
                });

                // const view = new SceneView({
                //     container: "viewDiv", // Reference to the scene div created in step 5
                //     map: map, // Reference to the map object created before the scene
                //     scale: 50000000, // Sets the initial scale to 1:50,000,000
                //     // zoom: ,
                //     center: [123.3999085, 1.4520586] // Sets the center point of view with lon/lat
                // });

            });
        </script>

        <!-- <script src="../public/assets/libs/jquery/dist/jquery.min.js"></script> -->
        <!-- Bootstrap tether Core JavaScript -->
        <!-- <script src="../public/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script> -->
        <!-- <script src="../public/js/app-style-switcher.js"></script> -->
        <!--Wave Effects -->
        <!-- <script src="../public/js/waves.js"></script> -->
        <!--Menu sidebar -->
        <!-- <script src="../public/js/sidebarmenu.js"></script> -->
        <!--Custom JavaScript -->
        <!-- <script src="../public/js/custom.js"></script> -->
        <!--This page JavaScript -->
        <!--chartis chart-->
        <!-- <script src="../public/assets/libs/chartist/dist/chartist.min.js"></script> -->
        <!-- <script src="../public/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script> -->
        <!-- <script src="../public/js/pages/dashboards/dashboard1.js"></script> -->
    </body>

    </html>

<?php
} ?>