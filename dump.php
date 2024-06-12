<?php
/*---------------------------------------------------------------*/
/*
    Titre : Dump (sauvegarde) avec PHP d'une base de donnée MySQL                                                        
                                                                                                                          
    URL   : https://phpsources.net/code_s.php?id=612
    Auteur           : miragoo                                                                                            
    Date édition     : 28 Oct 2010                                                                                        
    Date mise à jour : 13 Sept 2019                                                                                      
    Rapport de la maj:                                                                                                    
    - fonctionnement du code vérifié                                                                                    
*/
/*---------------------------------------------------------------*/
    include_once("config.php");


    $entete  = "-- ----------------------\n";
    $entete .= "-- dump de la base ".$dbname." au ".date("d-M-Y")."\n";
    $entete .= "-- ----------------------\n\n\n";
    $creations = "";
    $insertions = "\n\n";

    $result = $conn->query("SHOW TABLES");
    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    while ($row = $result->fetch_array()) {
        $table = $row[0];

        // Structure de la table
        $creations .= "-- -----------------------------\n";
        $creations .= "-- Structure de la table ".$table."\n";
        $creations .= "-- -----------------------------\n";
        $result2 = $conn->query("SHOW CREATE TABLE " . $table);
        if (!$result2) {
            die("Query failed: " . $conn->error);
        }
        $row2 = $result2->fetch_array();
        $creations .= $row2[1] . ";\n\n";

        // Données de la table
        $insertions .= "-- -----------------------------\n";
        $insertions .= "-- Contenu de la table ".$table."\n";
        $insertions .= "-- -----------------------------\n";
        $result3 = $conn->query("SELECT * FROM " . $table);
        if (!$result3) {
            die("Query failed: " . $conn->error);
        }
        while ($row3 = $result3->fetch_assoc()) {
            $insertions .= "INSERT INTO ".$table." VALUES(";
            $values = array();
            foreach ($row3 as $value) {
                if (is_null($value)) {
                    $values[] = "NULL";
                } else {
                    $values[] = "'" . $conn->real_escape_string($value) . "'";
                }
            }
            $insertions .= implode(", ", $values) . ");\n";
        }
        $insertions .= "\n";
    }

    $conn->close();

    $fichierDump = fopen("sauvegarde.sql", "wb");
    fwrite($fichierDump, $entete);
    fwrite($fichierDump, $creations);
    fwrite($fichierDump, $insertions);
    fclose($fichierDump);

    echo "Sauvegarde terminée";
?>
