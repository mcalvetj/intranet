<?php
	include('../assets/php/db.php');
	include('../assets/php/selects.php');
	include('../assets/php/functions.php');
	$fecha_inicio = $_POST['fecha_1'];
	$fecha_final = $_POST['fecha_2'];

    // Creamos un instancia de la clase ZipArchive
	 $zip = new ZipArchive();
	// Creamos y abrimos un archivo zip temporal
	 $zip->open("facturas.zip",ZipArchive::CREATE);
	 // Añadimos un directorio
	 //$dir = 'miDirectorio';
	 //$zip->addEmptyDir($dir);
	 
	 $facturas = select_facturas_fechas($fecha_inicio,$fecha_final);
	 if ($facturas->num_rows > 0) {
    	$facturasString = "facturas,";
        // output data of each row
        while ($row = $facturas->fetch_assoc()) {
            $facturasString = $facturasString.$row['ID_FACTURA'].",";
        }
    }

    $id_array = explode(',', $facturasString);
	 
    for ($i=0;$i<count($id_array);$i++){
    	echo $id_array[$i+1];

    	$fechaFactura = select_fecha_factura($id_array[$i+1]);
    	$anyo=substr( $fechaFactura, 0, 4 );
    	$mes=substr( $fechaFactura, 5, 2 );
    	$dia=substr( $fechaFactura, 8, 2 );

    	$dir = ''.$anyo.'/'.$mes;
    	if(!file_exists($dir)){
	 		$zip->addEmptyDir($dir);
	 	}

    	// Añadimos un archivo en la raid del zip.
		 $zip->addFile("../factura_pdf/".$anyo."/".$mes."/".$id_array[$i+1].".pdf",$dir."/".$id_array[$i+1]."_".$dia."_".$mes."_".$anyo.".pdf");
		 //Añadimos un archivo dentro del directorio que hemos creado
		 //$zip->addFile("../factura_pdf/2018/01/180001.pdf",$dir."/180001.pdf");

    }

    // Una vez añadido los archivos deseados cerramos el zip.
	 $zip->close();

    // Creamos las cabezeras que forzaran la descarga del archivo como archivo zip.
	 header("Content-type: application/octet-stream");
	 header("Content-disposition: attachment; filename=facturas.zip");
	 // leemos el archivo creado
	 readfile('facturas.zip');
	 // Por último eliminamos el archivo temporal creado
	 unlink('facturas.zip');//Destruye el archivo temporal
    
?>