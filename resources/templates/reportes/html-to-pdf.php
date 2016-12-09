<html>
    <head>
        <style>
            table {
                border-spacing: 0.1rem;
                width: 100%;
            }

            th, td {
                text-align: left;
                padding: 7px;
            }

            td:nth-child(even){background-color: #f2f2f2}

            th {
                background-color: #00AAFF;
                color: white;
            }
        </style>
    </head>
    <body>
        <div>

            <?php
                setlocale(LC_TIME,"es_ES");
                echo "<h2>" . $get('name') . "</h2>";
                echo "<p>" . date('l jS \of F Y h:i:s A') . "</p>";
            ?>
            <table>
                <thead>
                <tr>
                    <?php
                    $porcentaje = 100 / count($get('headers'));

                    echo "<style>td, th {width: " . $porcentaje . "%}</style>";

                    foreach ($get('headers') as $header) {
                        echo "<th>{$header}</th>";
                    }
                    ?>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($get('rows') as $row) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo '<td>';
                        if (is_array($value)) {
                            foreach ($value as $name => $val) {
                                echo <<<TAG
                        <strong>{$name}:</strong>
                        <span>{$val}</span>
                        <br> 
TAG;
                            }
                        } else {
                            echo $value;
                        }
                        echo '</td>';
                    }
                    echo '</tr> <br><hr>';
                }
                ?>
                </tbody>
            </table>
            <br><br><br><br>

            <p><b>Observaciones:</b></p>
            <p align="center">____________________________________________________________________________________________</p>
            <p align="center">____________________________________________________________________________________________</p>
            <p align="center">____________________________________________________________________________________________</p>
            <p align="center">____________________________________________________________________________________________</p>
            <p align="center">____________________________________________________________________________________________</p>

            <br><br><br><br>
            <p align="center">_____________________________</p>
            <?php
                echo "<p  align=\"center\"> <b>" . $get('name_admin') . "</b></p>"

            ?>

        </div>
    </body>

</html>

